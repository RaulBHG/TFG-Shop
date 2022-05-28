$(document).ready(function(){

    $(".inputCant").focusout(function(){
        let rowElem = $(this).parents(".rowProduct");
        let elem = $(this);
        if($(this).val() == 0 || $(this).val() < 0){
            removeElement(rowElem);
            return false;
        }
        $.ajax({
            type: "POST",
            url: baseUrl + "/cestController/updateCant",
            data: "cantProd="+$(this).val()+"&idProd="+rowElem.attr("productId"),
            success: function (respuesta) {
                let result = JSON.parse(respuesta);
                if(result["result"] == "nok"){
                    return false;
                }else{
                    calcPrice();                                      
                }
            }
        });
    });

    $(".removeFrom").on("click", function(){
        let rowElem = $(this).parent();
        removeElement(rowElem);
    });

    function calcPrice(){
        let precio = 0;
        $(".rowProduct").each(function(){
            precio += $(this).find(".priceProd").html().split("€")[0] * $(this).find(".inputCant").val();            
        });      
        $(".total .numPrice").html(precio);  
    }
    function removeElement(rowElem){
        rowElem.addClass("remove");          
        window.setTimeout(function(){
            rowElem.remove();
            calcPrice();
        },900);
        $.ajax({
            type: "POST",
            url: baseUrl + "/cestController/removeFromCest",
            data: "idProd="+rowElem.attr("productId"),
            success: function (respuesta) {
                let result = JSON.parse(respuesta);
                if(result["result"] == "nok"){
                    $(".inputCant").addClass("incorrect");
                    return false;
                }
            }
        });        
    }

    $(".payButton").on("click", function(){
        let btn = $(this);
        $(".paySection").addClass("show");
        btn.html("PAGAR");        
        window.setTimeout(function(){
            btn.addClass("payStripe");
        },200);        
    });

    $(document).on("click", ".payStripe", function(){
        $(".falseComplet").hide();
        $("#formLocate input:required").each(function(){
            if($(this).val() == ""){
                $(this).after("<p class='falseComplet'>Este campo es obligatorio.</p>");
                return false;
            }
        });
        $.ajax({
            type: "POST",
            url: baseUrl + "/cestController/addOrder",
            data: $("#formLocate").serialize(),
            success: function (respuesta) {
                let result = JSON.parse(respuesta);
                $("input.locateId").val(result["locateId"]);
                pay(result["price"], result["locateId"]);
            }
        });        

    });

 
    function pay(amount, locateId) {
        var handler = StripeCheckout.configure({
        key: 'pk_test_51Kyf0aLIP7gnkeacpG7gFDGURthcoFrHmuzdmSUAPSMAjJboUjNXm6hawyWWmJheEc3F2fKPrMXOStV4aY3uOQ6A00m0DuMLnH', // your publisher key id
        locale: 'auto',
        token: function (token) {
            // You can access the token ID with `token.id`.
            // Get the token ID to your server-side code for use.
            console.log('Token Created!!');
            console.log(token)
            $('#token_response').html(JSON.stringify(token));
    
            $.ajax({
                url:baseUrl+"/payment",
                method: 'post',
                data: { tokenId: token.id, amount: amount * 100, locateId: locateId },
                dataType: "json",
                success: function( response ) {
                    console.log(response.data);
                    
                    $(".paySection").fadeOut();
                    $(".total").empty();
                    $(".total").html("<h3 class='successCompra'>Compra finalizada. ID DE LOCALIZACIÓN DEL PEDIDO: "+$("input.locateId").val()+"</h3>");
                }
            })
        }
        });
    
        handler.open({
            name: 'Pagar',
            description: 'Rellene los datos para pagar',
            amount: amount * 100,
            currency: 'eur'
        });
    }

});
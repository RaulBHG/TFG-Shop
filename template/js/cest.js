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

});
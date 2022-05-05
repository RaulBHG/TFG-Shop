$(document).ready(function(){

    $(".buyProduct").on("click", function(){
        $(".inputCant").removeClass("incorrect");
        let cant = $(".inputCant").val();
        let productToBuy = $(this).attr("productToBuy");
        $.ajax({
            type: "POST",
            url: baseUrl + "/cestController/addToCest",
            data: "cantProd="+cant+"&idProd="+productToBuy,
            success: function (respuesta) {
                let result = JSON.parse(respuesta);
                if(result["result"] == "nok"){
                    $(".inputCant").addClass("incorrect");
                    return false;
                }
            }
        });
    });

});
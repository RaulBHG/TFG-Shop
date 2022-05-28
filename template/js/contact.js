$(document).ready(function(){

    $("#formContact").on("submit", function(e){
        e.preventDefault();
        const form = $(this);
        $.ajax({
            type: "POST",
            url: baseUrl + "/contactController/sendMessage",
            data: form.serialize(),
            success: function (respuesta) {
                //let result = JSON.parse(respuesta);
                $("h1").html("Mensaje enviado.");
                form.find("input").val("");
                form.find("textarea").val("");
            }
        });
    });

});
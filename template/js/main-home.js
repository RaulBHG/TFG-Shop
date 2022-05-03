$(document).ready(function(){

    // CAROUSEL
    window.setInterval(function(){
        addOneCarrousel();
    },10000);

    $(".cardsSection .point").on("click", function(){
        $(".cardsSection .point").removeClass("active");
        $(this).addClass("active");
        let newPos = $(this).attr("position");
        $(".cardsSection .container.carouselContainer .row").css("--element-position", newPos);
    });

    document.getElementById("carousel").addEventListener('touchstart', handleTouchStart, false);   
    document.getElementById("carousel").addEventListener('touchmove', handleTouchMove, false);     
    
    // FIN CAROUSEL

});
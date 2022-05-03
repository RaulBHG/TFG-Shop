// CAROUSEL SLIDE FUNCTIONS

var xDown = null;                                                        
var yDown = null;

function getTouches(evt) {
  return evt.touches ||             // browser API
         evt.originalEvent.touches; // jQuery
}                                                     

function handleTouchStart(evt) {
    const firstTouch = getTouches(evt)[0];                                      
    xDown = firstTouch.clientX;                                      
    yDown = firstTouch.clientY;                                      
};                                                

function handleTouchMove(evt) {
    if ( ! xDown || ! yDown ) {
        return;
    }

    var xUp = evt.touches[0].clientX;                                    
    var yUp = evt.touches[0].clientY;

    var xDiff = xDown - xUp;
    var yDiff = yDown - yUp;

    if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*most significant*/
        if ( xDiff > 0 ) {
            addOneCarrousel();
        } else {
            lessOneCarrousel();
        }                       
    } else {
        if ( yDiff > 0 ) {
            /* up swipe */ 
        } else { 
            /* down swipe */
        }                                                                 
    }
    /* reset values */
    xDown = null;
    yDown = null;                                             
};

function addOneCarrousel(){
    const element = $(".cardsSection .container.carouselContainer .row");
    let maxNum = element.css("--number-of-elements");
    let newPos = (Number(element.css("--element-position"))+1);
    
    if(newPos == maxNum){
        newPos = 0;
    } 
    
    element.css("--element-position", newPos);
    $(".cardsSection .point").removeClass("active");
    $(".cardsSection .point[position='"+newPos+"']").addClass("active");
}
function lessOneCarrousel(){
    const element = $(".cardsSection .container.carouselContainer .row");
    let maxNum = element.css("--number-of-elements");
    let newPos = (Number(element.css("--element-position"))-1);
    
    if(newPos == -1){newPos = maxNum-1;} 
    
    element.css("--element-position", newPos);
    $(".cardsSection .point").removeClass("active");
    $(".cardsSection .point[position='"+newPos+"']").addClass("active");
}

// CAROUSEL SLIDE FUNCTIONS
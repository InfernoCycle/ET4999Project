let slideIndex = 0;
showSlides()
function showSlides(){
    let i;
    let slides = document.getElementsByClassName("slide_img");
    
    //iterate through all divs and set display to none
    //causing each one to not appear on screen
    for (i = 0; i < slides.length; i++){
        slides[i].style.display = "none";
    }

    //add 1 to slideIndex to indicate next slide
    //will be shown
    slideIndex++;

    //Reset the slideIndex back to 1 so it doesn't exceed length
    //which would cause an error
    if(slideIndex > slides.length){
        slideIndex = 1;
    }

    //style each image div to appear
    //slideIndex is always one extra of length so subtract 1 in
    //the index of slides to prevent errors.
    slides[slideIndex-1].style.display = "inline-flex";
    
    //key function used to call this function(or any other one)
    //every ms indicated in second parameter. 4000 ms is 4 seconds
    //setTimeout(showSlides, 4000);
}

function showDate(){
    var test = document.getElementById("testrun");
    const date = new Date();
    //Date.getDay().toString();
    test.innerHTML = date.getDay();
}

showDate()
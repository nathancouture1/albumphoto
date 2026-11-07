let backlightimg =  document.getElementById("backlight-img");
let backlight =  document.getElementById("backlight");
let image = document.getElementById("image");

function ouvrir(img){
    backlightimg.src= img.src;
    backlight.classList.add('ouverte');
}

function fermer(){
    backlight.classList.remove('ouverte');
}

image.addEventListener('click', ouvrir);
backlight.addEventListener('click', fermer);

document.addEventListener('keydown', function(e){
    if (e.key == 'Escape'){
        backlight.classList.remove('ouverte');
    }
});



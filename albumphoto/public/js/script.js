    let backlight = document.getElementById("backlight");
    let backlightimg = document.getElementById("backlight-img");
    let images = document.querySelectorAll(".image");

    for (let i = 0; i < images.length; i++) {
        images[i].addEventListener("click", function () {
            backlightimg.src = images[i].src;
            backlight.classList.add("ouverte");
        });
    }

    backlight.addEventListener("click", function () {
        backlight.classList.remove("ouverte");
    });

    document.addEventListener("keydown", function (e) {
        if (e.key == "Escape") {
            backlight.classList.remove("ouverte");
        }
    });
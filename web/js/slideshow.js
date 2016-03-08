var oldData;
var slider = $('#slideshow');
var sliderOptions = {
    arrows: false,
    nav: false,
    autoplay: true,
    delay: delayBetweenSlides
};

$(document).ready(function ($) {
    getNewEntries().done(function (data) {
        oldData = data;

        slider.html(data);
        slider.unslider(sliderOptions).removeClass('hidden');
    });

    setInterval(updateSlideShow, delayBetweenAjaxCallsForNewEntries)
});

function getNewEntries() {
    return $.get("/entries");
}

function updateSlideShow() {
    getNewEntries().done(function (data) {
        if (data != oldData) {
            console.log('added new data to the slideshow');
            $('#slideshow-wrapper').html(slider);
            slider.html(data);
            slider.unslider(sliderOptions);
        } else {
            console.log('no change in entries');
            //TODO: after several times with no changes do something (show presentations for example)
        }
        oldData = data;
    });
}
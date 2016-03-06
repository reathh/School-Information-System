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

        $('#slideshow>ul').html(data);
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
            $('#slideshow>ul').html(data);
            slider.init(sliderOptions);
        } else {
            console.log('no change in entries');
            //TODO: after several times with no changes do something (show presentations for example)
        }
        oldData = data;
    });
}
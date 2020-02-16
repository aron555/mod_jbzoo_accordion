jQuery(function ($) {
    let containerWidth = $('.container').width(); // Ширина контейнера для дропдауна
    $('.zoo-list').css("width", containerWidth); // Задаем ширину списку равной ширине родительского контейнера (не всей ширине экрана)
    let windowHeight = $(window).height(); // Задаем высоту экрана
    $('.zoo-list').css("height", (windowHeight/100*90)).css("overflow-y", "auto"); // И возможность прокручивать список
});
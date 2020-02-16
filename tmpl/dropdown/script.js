jQuery(function($){

    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');

        $(this).parents('.show').on('hidden.bs.dropdown', function(e) {
            $('.zoo-list .dropdown-menu .show').removeClass("show");
        });

    });


    //let list = $('.zoo-list'); // Класс оболочки списка категории (в шаблоне модуля)
    //let containerWidth = $('.container').width(); // Ширина контейнера для дропдауна
    //$(list).css("width", containerWidth); // Задаем ширину списку равной ширине родительского контейнера (не всей ширине экрана)


});
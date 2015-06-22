/**
 Main functions file.

 @since 1.0.0
 @package KidNiche
 */
(function ($) {
    'use strict';

    $(function () {

        $('#mobile-nav').find('.menu-toggle').click(function () {

            var $menu = $(this).closest('#mobile-nav').find('.menu'),
                action = $menu.is(':visible') ? 'hide' : 'show';

            switch (action) {
                case 'hide':

                    $(this).find('[class*="icon"]').removeClass('icon-cross').addClass('icon-menu');
                    $menu.hide();
                    break;

                case 'show':

                    $(this).find('[class*="icon"]').addClass('icon-cross').removeClass('icon-menu');
                    $menu.show();
                    break;
            }
        });
    });
})(jQuery);
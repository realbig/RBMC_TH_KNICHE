/**
 Main functions file.

 @since 1.0.0
 @package KidNiche
 */
(function ($) {
    'use strict';

    $(document).foundation({
        abide: {
            validate_on_blur: false,
            focus_on_invalid: false
        },
        equalizer : {
            equalize_on_stack: true
        }
    });

    // Vertical alignment
    $(function () {
        $('[data-vertical-align]').each(function () {

            var alignment = $(this).data('vertical-align');

            switch (alignment) {
                case 'middle':
                    $(this).css('margin-top', ($(this).parent().height() / 2) - ($(this).height() / 2));
                    break;
            }
        });
    });

})(jQuery);
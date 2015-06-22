/**
 Widgets functionality file.

 @since 1.0.0

 @global KidNicheData

 @package KidNiche
 */
(function ($) {
    'use strict';

    var data = window['KidNicheData'];

    // Testimonials
    $(function () {

        var $containers = $('.testimonials-container'),
            interval = typeof data != 'undefined' && typeof data['slider_interval'] != 'undefined' ?
                parseInt(data['slider_interval']) * 1000 : 5000,
            slideInterval;

        // Cycle through each possible slider
        $containers.each(function () {

            var $container = $(this),
                $testimonial_container = $container.find('.testimonials');

            $testimonial_container.addClass('js');

            var $testimonials = $testimonial_container.find('.testimonial'),
                $prev = $container.find('.testimonials-prev'),
                $next = $container.find('.testimonials-next'),
                offset = $container.width(),
                min = 0,
                max = $testimonials.length - 1;


            // Reveal and hide initial
            $testimonial_container.width(offset * $testimonials.length);
            $testimonials.width(offset);
            $prev.show();
            $next.show();

            $next.click(function () {

                var current_index = $testimonial_container.find('.testimonial.active').index(),
                    new_index = current_index + 1;

                $testimonials.removeClass('active');

                if (new_index <= max) {
                    $testimonials.eq(new_index).addClass('active');
                    $testimonial_container.css('left', new_index * offset * -1);
                } else {
                    $testimonials.eq(min).addClass('active');
                    $testimonial_container.css('left', min * offset * -1);
                }
                // Reset auto cycle
                clearInterval(slideInterval);
                slideInterval = setInterval(next_slide, interval);
            });

            $prev.click(function () {

                var current_index = $testimonial_container.find('.testimonial.active').index(),
                    new_index = current_index - 1;

                $testimonials.removeClass('active');

                if (new_index >= min) {
                    $testimonials.eq(new_index).addClass('active');
                    $testimonial_container.css('left', new_index * offset * -1);
                } else {
                    $testimonials.eq(max).addClass('active');
                    $testimonial_container.css('left', max * offset * -1);
                }

                // Reset auto cycle
                clearInterval(slideInterval);
                slideInterval = setInterval(next_slide, interval);
            });

            // Start auto cycle
            slideInterval = setInterval(next_slide, interval);

            /**
             * Transitions to next slide by clicking the "next" button.
             */
            function next_slide() {
                $next.click();
            }
        });
    });

})(jQuery);
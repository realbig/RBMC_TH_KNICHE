/**
 Main functions file.

 @since 1.0.0
 @package KidNiche
 */
(function ($) {
    'use strict';

    $(function () {

        // Load in more posts
        $('#load-more').click(function (e) {

            e.preventDefault();

            var $post_list = $('.post-list'),
                $this = $(this),
                settings = {
                    numberposts: 5,
                    post_type: 'post',
                    offset: $post_list.find('article').length
                },
                new_settings = $(this).data(),
                data;

            // Override defaults
            if (new_settings) {
                $.each(new_settings, function (name, value) {
                    settings[name] = value;
                });
            }

            data = {
                action: 'kniche_load_posts',
                settings: settings
            };

            $.post(
                knicheData.ajaxurl,
                data,
                function (response) {

                    if (response['status'] == 'no_posts') {

                        $post_list.append('<p>No More Posts</p>');
                        $this.remove();
                        return;
                    }

                    $.each(response['posts'], function (i, post) {

                        var $template = $post_list.find('article').first().clone();

                        $template.find('.post-title a').html(post['title']);
                        $template.find('.post-excerpt').html(post['excerpt']);
                        $template.find('a').attr('href', post['link']);
                        $template.find('.post-image img').attr('src', post['image']);

                        $post_list.append($template);
                    });
                }
            );

            return false;
        })
    });

})(jQuery);
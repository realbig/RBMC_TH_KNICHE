/**
 Allows media uploader to be used in the backend.

 @since 1.0.0
 @package KidNiche
 */
(function ($) {
    'use strict';

    $(function () {

        // Instantiates the variable that holds the media library frame.
        var meta_image_frame;

        // Runs when the image button is clicked.
        $('.image-button').click(function (e) {

            var $button = $(this);

            // Prevents the default action from occurring.
            e.preventDefault();

            // If the frame already exists, re-open it.
            if (meta_image_frame) {
                meta_image_frame.open();
                return;
            }

            // Sets up the media library frame
            meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                title: 'Select Author Image',
                button: {text: 'Use Image'},
                library: {type: 'image'}
            });

            // Runs when an image is selected.
            meta_image_frame.on('select', function () {

                // Grabs the attachment selection and creates a JSON representation of the model.
                var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

                console.log(media_attachment);

                // Sends the attachment URL to our custom image input field.
                $button.siblings('.image-id').val(media_attachment.id);

                $button.siblings('.image-preview').attr('src', media_attachment.url);
            });

            // Opens the media library frame.
            meta_image_frame.open();
        });
    });
})(jQuery);
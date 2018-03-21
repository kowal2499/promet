"use strict";

var uploader = {

    init: function() {
        jQuery(document).on('click', '.uploaderLauncher', function() {
            var formfield = jQuery(this).siblings('.upload');
            var preview = jQuery(this).siblings('.preview');


            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = $(this);
            wp.media.editor.send.attachment = function(props, attachment) {
                preview.attr('src', attachment.url);
                formfield.val(attachment.id);
                wp.media.editor.send.attachment = send_attachment_bkp;
            }
            wp.media.editor.open(button);
            return false;

        });
    }
}

uploader.init();
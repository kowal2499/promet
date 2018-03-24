"use strict";

var uploader = {

    init: function() {
        // dodaj obrazek
        jQuery(document).on('click', '.uploaderLauncher', function() {
            var formfield = jQuery(this).closest('.img-upload').find('.img-data');
            var preview = jQuery(this).closest('.img-upload').find('.img-preview');
            var btnDel = jQuery(this).siblings('.deleteImage');

            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = $(this);
            wp.media.editor.send.attachment = function(props, attachment) {
                preview.attr('src', attachment.sizes.thumbnail.url);
                formfield.val(attachment.id);
                btnDel.show();
                wp.media.editor.send.attachment = send_attachment_bkp;
            }
            wp.media.editor.open(button);
            return false;
        });

        // usuń obrazek
        jQuery(document).on('click', '.deleteImage', function() {
            var formfield = jQuery(this).closest('.img-upload').find('.img-data');
            var preview = jQuery(this).closest('.img-upload').find('.img-preview');

            formfield.val('');
            preview.attr('src', preview.data('noimagesrc'));
            jQuery(this).hide();
        });
    }
}

uploader.init();

var repeatable = {
    init: function() {
        jQuery(document).on('click', '.addRow', function() {
            var template = jQuery(this).closest('.rptContainer').find('.rowTemplate');
            var rowsDiv = jQuery(this).closest('.rptContainer').find('.rows');
            var quantity = parseInt(jQuery(this).data('qty'));

            console.log(quantity)
            rowsDiv.html(rowsDiv.html() + template.val().replace(/%index%/g, quantity));
            jQuery(this).data('qty', quantity+1);
        });
    }
}

repeatable.init();
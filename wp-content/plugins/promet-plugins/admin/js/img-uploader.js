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
        jQuery(document).on('click', '.addRow', this.onAddRow.bind(this));
        jQuery(document).on('click', '.deleteRow', this.onDelRow.bind(this));
    },

    onAddRow: function(e) {
        console.log(this)
        var template = jQuery(e.srcElement).closest('.rptContainer').find('.rowTemplate');
        var records = jQuery(e.srcElement).closest('.rptContainer').find('table.form-table');
        var qty = this.getQuantity(e.srcElement);
        records.append(template.val().replace(/%index%/g, qty));
    },

    onDelRow: function(e) {
        // znajdź najbliższy <tr>
        var myRow = jQuery(e.srcElement).closest('tr');
        var self = this;
        myRow.fadeOut(500, function(self) {
            var parent = myRow.closest('.rptContainer');
            // usuń rząd
            myRow.remove();
            self.updateIds(parent);
        }.bind(myRow, this));
    },

    getQuantity: function(obj) {
        var parent = jQuery(obj).closest('.rptContainer');
        var rows = parent.find('table.form-table tr')
        return rows.length;
    },

    updateIds: function(parent) {
        console.log(parent);
    }

}

repeatable.init();
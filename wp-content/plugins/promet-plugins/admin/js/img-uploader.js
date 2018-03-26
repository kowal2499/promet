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
        
        var template = jQuery(e.srcElement).closest('.rptContainer').find('.rowTemplate');
        var records = jQuery(e.srcElement).closest('.rptContainer').find('table.form-table');
        var qty = this.getQuantity(e.srcElement);
        records.append(template.val().replace(/%index%/g, qty));
    },

    onDelRow: function(e) {
        // znajdź najbliższy <tr>
        var myRow = jQuery(e.srcElement).closest('tr');
        
        myRow.fadeOut(500, function() {
            var parent = myRow.closest('table.form-table');
            // usuń rząd
            myRow.remove();
            this.updateIds(parent);
        }.bind(this));
    },

    getQuantity: function(obj) {
        var parent = jQuery(obj).closest('.rptContainer');
        var rows = parent.find('table.form-table tr')
        return rows.length;
    },

    updateIds: function(parent) {
        console.log('doing update')
        var repeatableName = parent.data('inner-id');
        // get all first level tr-s. There may be some nested repeatable structures, we do not want to loop through them
        var rows = parent.find('tr').first().parent().children();
        for (var rowNumber=0; rowNumber < rows.length; rowNumber++) {
            // prepare regex
            var replaceRegex = "\\[" + repeatableName + "\\]\\[\\d\\]";
            var re = new RegExp(replaceRegex, "g");

            var allInputs = jQuery(rows[rowNumber]).find('[name*="[' + repeatableName + ']"]');

            for (var input=0; input<allInputs.length; input++) {
                var oldName = jQuery(allInputs[input]).attr('name');

                var newName = oldName.replace(re, "[" + repeatableName + "][" + rowNumber + "]"); // <-- fun part
                jQuery(allInputs[input]).attr('name', newName);
                jQuery(allInputs[input]).attr('id', newName);
            }
        }   
    }
}

repeatable.init();
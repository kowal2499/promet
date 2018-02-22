"use strict";

jQuery(function(jQuery) {

    jQuery('.repeatable-add').click(function() {
        var field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true);
        var fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
        var oldName = jQuery('input', field).attr('name');
        var oldNumber = /\[(\d+)\]$/.exec(oldName);

        if (oldNumber) {
            jQuery('input', field).val('');
            oldNumber = parseInt(oldNumber[1]);
            var newName = oldName.replace(/\[(\d+)\]$/, '[' + parseInt(oldNumber + 1) + ']');
            jQuery('input', field).attr('name', newName);
            jQuery('input', field).attr('id', newName);
            field.insertAfter(fieldLocation, jQuery(this).closest('td'))
        }
        return false;
    });

    jQuery('.repeatable-remove').click(function(){
        jQuery(this).parent().remove();
        return false;
    });

  /*  jQuery('.custom_repeatable').sortable({
        opacity: 0.6,
        revert: true,
        cursor: 'move',
        handle: '.sort'
    });
    */
})
"use strict";

jQuery(function(jQuery) {

        /**
         * Stores all repeatable elements
         */
        var repeatables = [];

        /**
         * onClick event
         */
        jQuery('.repeatable-add-new').on('click', function(event) {
            var related = jQuery(this).data('related');

            // add new empty values
            var singleRecord = {};
            repeatables[related].recordDefinition.forEach(function(element, index, array) {
                switch (element.type) {
                    default:
                        singleRecord[element.name] = '';
                }
            });
            repeatables[related].value.push(singleRecord);
            drawNewRow(related, repeatables[related].value.length-1);
        });

        /**
         * onChange event
         */
        jQuery('.repeatable-body').on('change', function(event) {
            var target = jQuery(event.target);
            var parent = target.closest('.repeatable-row');
            var related = parent.data('related');
            var position = parent.data('position');
            var name = target.attr('name');
            repeatables[related].value[position][name] = target.val();            
            updateValueHolder(related);
        });

        // refresh value holder element
        var updateValueHolder = function(related) {
            repeatables[related].valueElement.val(encodeURI(JSON.stringify(repeatables[related].value)));
        };

        // draws new row and updates holder
        var drawNewRow = function(related, pos) {
            var rowElement = document.createElement('div');
            jQuery(rowElement).addClass('repeatable-row').attr('data-related', related).attr('data-position', pos);

            repeatables[related].recordDefinition.forEach(function(element, index, array) {
                switch (element.type) {
                    case 'text':
                        var newElement = document.createElement('input')
                        newElement.type = 'text';
                        newElement.name = element.name;
                        newElement.value = repeatables[related].value[pos][element.name];
                        if ('attr' in element) {
                            var size = element.attr.size || 30;
                            newElement.setAttribute("size", size);
                        }
                        break;
                
                    default:
                        break;
                }
                rowElement.append(newElement);
            });
            repeatables[related].bodyElement.append(rowElement);
            updateValueHolder(related);
        };

        /** 
         * Initialize variables
         */
        var init = function() {
            const repeatableElements = jQuery('.repeatable');
            repeatableElements.each(function() {
                var related = jQuery(this).data('related');
                repeatables[related] = {};
                repeatables[related].parentElement = jQuery(this);
                repeatables[related].valueElement = jQuery(this).find('.repeatable-value');
                repeatables[related].recordDefinitionElement = jQuery(this).find('.repeatable-row-def');
                repeatables[related].bodyElement = jQuery(this).find('.repeatable-body');

                repeatables[related].recordDefinition = repeatables[related].recordDefinitionElement.val() ? JSON.parse(repeatables[related].recordDefinitionElement.val()) : undefined;
                repeatables[related].value = repeatables[related].valueElement.val() ? JSON.parse(decodeURI(repeatables[related].valueElement.val())) : [];

                // draw exisiting elements
                var pos = 0;
                repeatables[related].value.forEach(function() {
                    drawNewRow(related, pos++);
                });
            });
        }

        init();
});
(function ($) {
    'use strict'

    //----------------------------------------------------/
    // CONTACT FORM SUBMIT
    //----------------------------------------------------/

    PROMET.beforeSent = function() {
        var notify = PROMET.globals.$document.find('.notify-area').html('<div class="alert alert-info" role="alert"><i class="fas fa-cog fa-spin"></i>&nbsp;&nbsp;' + app04.sendingMessage + '</div>');
    }
    PROMET.afterSent = function(type, message) {
        var notify = PROMET.globals.$document.find('.notify-area').html('<div class="alert ' + type + '" role="alert">' + message + '</div>');
    }

    PROMET.contactFormSubmit = function() {
        var doc = PROMET.globals.$document;
        var submit = doc.find('button[name=contact\\[submit\\]]').on('click', function(e) {
            e.preventDefault();

            var name = doc.find('input[name=contact\\[name\\]]');
            var email = doc.find('input[name=contact\\[email\\]]');
            var nip = doc.find('input[name=contact\\[nip\\]]');
            var subject = doc.find('input[name=contact\\[subject\\]]');
            var body = doc.find('textarea[name=contact\\[body\\]]');

            var data = {
                'action': 'send_contact_message',
                'fields': {
                    name: name.val(),
                    email: email.val(),
                    nip: nip.val(),
                    subject: subject.val(),
                    body: body.val()
                }
            }

            PROMET.beforeSent();
            var $button = $(this);
            $button.prop('disabled', true);

            $.post(app04.ajaxurl, data, function(response) {
                if (response.data) {
                    PROMET.afterSent('alert-success', app04.successMessage);
                } else {
                    PROMET.afterSent('alert-danger', app04.errorMessage);
                }
                // enable button back
                $button.prop('disabled', false);
            });
            
        });
    }

})(jQuery);
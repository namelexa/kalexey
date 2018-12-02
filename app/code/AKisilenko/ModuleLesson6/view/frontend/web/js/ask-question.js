define([
    'jquery',
    'Magento_Ui/js/modal/alert',
    'mage/cookies',
    'jquery/ui'
], function ($, alert) {
    'use strict';

    $.widget('moduleLesson6.AskQuestion', {
        options: {
            cookieName:'time_cookie'
        },

        /** @implements*/
        _create: function () {
            $(this.element).submit(this.submitForm.bind(this));
        },

        /**
         * Submit form
         */
        submitForm: function () {

            if (!this.validateForm()) {
                return;
            }


            var formData = new FormData($(this.element).get(0));

            formData.append('form_key', $.mage.cookies.get('form_key'));
            formData.append('time_cookie', $.mage.cookies.get(this.options.cookieName));
            formData.append('isAjax', 1);
            // debugger;
            var self=this;
            $.ajax({
                url: $(this.element).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                type: 'post',
                dataType: 'json',
                context: this,
            })
            // debugger;
                .done(function (response) {
                    alert({
                        title: $.mage.__(response.status),
                        content: $.mage.__(response.message)
                    });
                    // debugger;
                    if (response.status === 'Success') {
                        var date = new Date(new Date().getTime() + 120 * 1000);
                        $.mage.cookies.set(self.options.cookieName, self.options.cookieName, {expires: date});
                    }
                })
                .fail(function () {
                        alert({
                            title: 'Error',
                            content: 'Your request can not be submitted. Please, contact us directly via email or prone to get your Sample.'
                        });
                });
        },

        /**
         * Form validate
         * @returns {bool}
         */
        validateForm: function () {
            return $(this.element).validate().valid();
        },

        /**
         * Clear cookie
         */
        clearCookie: function () {
            $.mage.cookies.clear(this.options.cookieName);
        },
    });

    return $.moduleLesson6.AskQuestion;
});
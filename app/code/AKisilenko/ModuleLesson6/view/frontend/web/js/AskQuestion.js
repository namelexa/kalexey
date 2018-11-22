define([
    'jquery',
    'jquery/ui',
    'Magento_Ui/js/modal/alert',
    'mage/cookies'
], function ($) {
    'use strict';

    $.widget('moduleLesson6.AskQuestion', {
        options: {
            action:''
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

            $.ajax({
                url: $(this.element).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                type: 'post',
                dataType: 'json',
                context: this,
            })
                .done(function (response) {
                    console.log('okay');
                })
                .fail(function (error) {
                    console.log(JSON.stringify(error));
                    console.log('error');
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
         * Clear that `ask_question_timestamp` cookie
         */
        clearCookie: function () {
            $.mage.cookies.clear(this.options.cookieName);
        }
    });

    return $.moduleLesson6.AskQuestion;
});

define([
    'jquery',
    'jquery/ui'
], function ($) {
    'use strict';

    $.widget('moduleLesson6.AskQuestion', {
        options: {
            action: ''
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
            console.log('Submit');
        },

        /**
         * Form validate
         * @returns {bool}
         */
        validateForm: function () {
            return $(this.element).validate().valid();
        }
    });

    return $.moduleLesson6.AskQuestion;
});

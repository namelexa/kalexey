define([
    'uiComponent',
    'ko'
    ],
    function ( Component, ko) {
        'use strict';

        return Component.extend({

            question: ko.observable(0),


            initialize: function (config) {
                this._super();
                this.question = config.question;
            }
        });
    }
);

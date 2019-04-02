define([
    'underscore',
    'Magento_Ui/js/grid/columns/select'
], function (_, Select) {
    'use strict';

    return Select.extend({
        defaults: {
            additionalCustomClass: '',
            customClasses: {
                pending: 'red',
                processed: 'green',
            },
            bodyTmpl: 'AKisilenko_ModuleLesson6/grid/cells/text'
        },

        getCustomClass: function (row) {
            var customClass = this.customClasses[row.status] || '';
            return customClass + ' ' + this.additionalCustomClass;
        }
    });
});
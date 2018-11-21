define([
    'jquery'
], function ($) {
    'use strict';

    return function () {
        $.validator.addMethod(
            'ukr-phone-rule',
            function (phonePattern) {
                if (phonePattern.match(/^((\3)+([0-9]){12})$/gm)) {
                    return true;
                }

            },
            $.mage.__('Phone pattern is 380778889911')
        );
    };
});

define(
    [
        'jquery',
        'uiComponent'
    ],
    function (component) {
        'use strict';

        return component.extend({
            justText: 'Text in the ask question page',
            defaults: {
                template: 'AKisilenko_UIModuleLesson9/text_template'
            }
        });
    }
);

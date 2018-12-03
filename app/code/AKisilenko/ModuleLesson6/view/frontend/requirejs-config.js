var config = {
    paths: {
        'askQuestion': 'AKisilenko_ModuleLesson6/js/ask-question'
    },

    map: {
        '*': {
            'validation': 'mage/validation/validation'
        }
    },
    config: {
        mixins: {
            'mage/validation': {
                'AKisilenko_ModuleLesson6/js/validation-phone-mixin': true
            }
        }
    }
};
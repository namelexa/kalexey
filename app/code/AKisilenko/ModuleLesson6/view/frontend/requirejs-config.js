var config = {
    paths: {
        'askQuestion': 'AKisilenko_ModuleLesson6/js/AskQuestion'
    },

    map: {
        '*': {
            'validation': 'mage/validation/validation'
        }
    },
    config: {
        mixins: {
            'mage/validation': {
                'AKisilenko_ModuleLesson6/js/validationPhone-mixin': true
            }
        }
    }
};
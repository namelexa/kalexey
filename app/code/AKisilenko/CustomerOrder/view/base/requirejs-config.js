var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/view/shipping': {
                'AKisilenko_CustomerOrder/js/view/shipping-payment-mixin': true
            },
            'Magento_Checkout/js/view/payment': {
                'AKisilenko_CustomerOrder/js/view/shipping-payment-mixin': true
            }
        }
    }
};
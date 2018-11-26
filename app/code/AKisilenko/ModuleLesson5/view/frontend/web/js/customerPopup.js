define([
        'jquery',
        'Magento_Ui/js/modal/modal'
    ],
    function($, modal) {
        var options = {
            responsive: true,
            innerScroll: true,
            title: '',
            buttons: [{
                text: $.mage.__('Close'),
                class: '',
                click: function () {
                    this.closeModal();
                }
            }]
        };

        var popup = modal(options, $('#header-modal'));
        $("#dealer-popup").on('click',function(){
            $("#header-modal").modal("openModal");
            $("#header-modal").trigger('contentUpdated');
        });

    }
);
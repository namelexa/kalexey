<?php
namespace AKisilenko\Kmodule\Block;
class CustomBlock extends \Magento\Framework\View\Element\Template
{
    const MY_CUSTOM_TEMPLATE = "AKisilenko_Kmodule::myhomework/customTemplate.phtml";

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->setTemplate(self::MY_CUSTOM_TEMPLATE);
        return $this;
    }
    public function getDefaultMyRouterLink() {
        return $this->getUrl('home-work/demonstration/jsonresponse');
    }
}
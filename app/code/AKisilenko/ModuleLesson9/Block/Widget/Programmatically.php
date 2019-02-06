<?php

namespace AKisilenko\ModuleLesson9\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Cms\Block\Block;

class Programmatically extends Template implements BlockInterface
{

    /**
     * @var string
     */

    protected $_template = 'widget/homepagebanner.phtml';

    public function getHomeBanner()
    {
        return $this
            ->getLayout()
            ->createBlock('Magento\Cms\Block\Block')
            ->setBlockId($this->getData('select_block'))
            ->toHtml();
    }

    
}
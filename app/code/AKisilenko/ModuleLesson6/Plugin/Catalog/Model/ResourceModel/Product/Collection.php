<?php

namespace AKisilenko\ModuleLesson6\Plugin\Catalog\Model\ResourceModel\Product;

/**
 * Class Collection
 * @package BelodubrovskyiAn\AskQuestion\Plugin\Catalog\Model\ResourceModel\Product
 */
class Collection
{
    /**
     * @param \AKisilenko\ModuleLesson6\Model\ResourceModel\AskQuestion\Collection $subject
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function beforeLoad(\AKisilenko\ModuleLesson6\Model\ResourceModel\AskQuestion\Collection $subject)
    {
        $subject->addStoreFilter();
    }
}

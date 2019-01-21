<?php

namespace AKisilenko\ModuleLesson6\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Store\Model\Store;
use AKisilenko\ModuleLesson6\Model\AskQuestion;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var \AKisilenko\ModuleLesson6\Model\AskQuestionFactory $askQuestionFactory
     */
    private $askQuestionFactory;

    /**
     * UpgradeData constructor.
     * @param \AKisilenko\ModuleLesson6\Model\AskQuestionFactory $askQuestionFactory
     */
    public function __construct(\AKisilenko\ModuleLesson6\Model\AskQuestionFactory $askQuestionFactory)
    {
        $this->askQuestionFactory = $askQuestionFactory;
    }
    /**
     * {@inheritdoc}
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.5', '<')) {
            $statuses = [AskQuestion::STATUS_PENDING, AskQuestion::STATUS_PROCESSED];
            for ($i = 1; $i <= 5; $i++) {
                /** @var AskQuestion $askQuestion */
                $askQuestion = $this->askQuestionFactory->create();
                $askQuestion
                    ->setName("Customer #$i")
                    ->setEmail("test-mail-$i@gmail.com")
                    ->setTelephone("38093-$i$i$i-$i$i-$i$i")
                    ->setComment('Question5')
                    ->setRequest('Just a test request')
                    ->setStatus($statuses[array_rand($statuses)])
                    ->setStoreId(Store::DISTRO_STORE_ID);
                $askQuestion->save();
            }
        }
        if (version_compare($context->getVersion(), '1.0.6', '<')) {
            $statuses = [AskQuestion::STATUS_PENDING, AskQuestion::STATUS_PROCESSED];
            for ($i = 1; $i <= 5; $i++) {
                /** @var AskQuestion $askQuestion */
                $askQuestion = $this->askQuestionFactory->create();
                $askQuestion
                    ->setName("Customer #$i")
                    ->setEmail("test-mail-$i@gmail.com")
                    ->setTelephone("38093-$i$i$i-$i$i-$i$i")
                    ->setComment('Question6')
                    ->setRequest('Just a test request')
                    ->setStatus($statuses[array_rand($statuses)])
                    ->setStoreId(Store::DISTRO_STORE_ID);
                $askQuestion->save();
            }
        }
    }
}

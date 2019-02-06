<?php

namespace AKisilenko\ModuleLesson6\Setup;

use AKisilenko\ModuleLesson6\Model\AskQuestionFactory;
use Magento\Framework\DB\Transaction;
use Magento\Framework\DB\TransactionFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Store\Model\Store;
use AKisilenko\ModuleLesson6\Model\AskQuestion;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var AskQuestionFactory $askQuestionFactory
     */
    private $askQuestionFactory;

    /**
     * @var TransactionFactory
     */
    private $transactionFactory;

    /**
     * UpgradeData constructor.
     * @param AskQuestionFactory $askQuestionFactory
     */
    public function __construct(
        AskQuestionFactory $askQuestionFactory,
        TransactionFactory $transactionFactory
    ) {
        $this->askQuestionFactory = $askQuestionFactory;
        $this->transactionFactory = $transactionFactory;
    }
    /**
     * {@inheritdoc}
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.7', '<')) {
            $statuses = [AskQuestion::STATUS_PENDING, AskQuestion::STATUS_PROCESSED];
            /** @var Transaction $transaction */
            $transaction = $this->transactionFactory->create();
            for ($i = 1; $i <= 5; $i++) {
                /** @var AskQuestion $askQuestion */
                $askQuestion = $this->askQuestionFactory->create();
                $askQuestion
                    ->setName("Customer #$i")
                    ->setEmail("test-mail-$i@gmail.com")
                    ->setTelephone("38093-$i$i$i-$i$i-$i$i")
                    ->setComment('Question5 transaction')
                    ->setRequest('Just a test request')
                    ->setStatus($statuses[array_rand($statuses)])
                    ->setStoreId(Store::DISTRO_STORE_ID);
                $transaction->addObject($askQuestion);
                }
            $transaction->save();
        }
        $setup->endSetup();
    }
}

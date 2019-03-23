<?php

namespace AKisilenko\ModuleLesson6\Setup;

use AKisilenko\ModuleLesson6\Model\AskQuestionFactory;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\DB\Transaction;
use Magento\Framework\DB\TransactionFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Store\Model\Store;
use AKisilenko\ModuleLesson6\Model\AskQuestion;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;

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
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * UpgradeData constructor.
     * @param AskQuestionFactory $askQuestionFactory
     * @param TransactionFactory $transactionFactory
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        AskQuestionFactory $askQuestionFactory,
        TransactionFactory $transactionFactory,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->askQuestionFactory = $askQuestionFactory;
        $this->transactionFactory = $transactionFactory;
        $this->eavSetupFactory = $eavSetupFactory;
    }
    /**
     * {@inheritdoc}
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.9', '<')) {
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
                    ->setComment('Question y/n')
                    ->setRequest('Just a test request')
                    ->setStatus($statuses[array_rand($statuses)])
                    ->setStoreId(Store::DISTRO_STORE_ID);
                $transaction->addObject($askQuestion);
            }
            $transaction->save();

            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'allow_to_ask_questions',
                [
                    'group' => 'General',
                    'sort_order' => 10,
                    'type' => 'int',
                    'backend' => '',
                    'frontend' => '',
                    'label' => 'Allow to ask questions',
                    'input' => 'boolean',
                    'class' => '',
                    'source' => Boolean::class,
                    'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                    'visible' => true,
                    'required' => true,
                    'user_defined' => true,
                    'default' => Boolean::VALUE_YES,
                    'searchable' => false,
                    'filterable' => false,
                    'comparable' => false,
                    'visible_on_front' => false,
                    'used_in_product_listing' => true,
                    'unique' => false,
                    'apply_to' => ''
                ]
            );
        }

        $setup->endSetup();
    }
}

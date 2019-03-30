<?php

namespace AKisilenko\ModuleLesson6\Setup;

use AKisilenko\ModuleLesson6\Model\AskQuestionFactory;
use Exception;
use Magento\Catalog\Model\Product;
use Magento\Customer\Model\Attribute;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\DB\Transaction;
use Magento\Framework\DB\TransactionFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Store\Model\Store;
use AKisilenko\ModuleLesson6\Model\AskQuestion;
use Magento\Eav\Setup\EavSetup;
use Magento\Customer\Model\Customer;
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
     * @var Attribute
     */
    private $customerAttribute;

    /**
     * UpgradeData constructor.
     * @param AskQuestionFactory $askQuestionFactory
     * @param TransactionFactory $transactionFactory
     * @param EavSetupFactory $eavSetupFactory
     * @param Attribute $customerAttribute
     */
    public function __construct(
        AskQuestionFactory $askQuestionFactory,
        TransactionFactory $transactionFactory,
        EavSetupFactory $eavSetupFactory,
        Attribute $customerAttribute
    ) {
        $this->askQuestionFactory = $askQuestionFactory;
        $this->transactionFactory = $transactionFactory;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->customerAttribute = $customerAttribute;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws Exception
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.1.0', '<')) {
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

//            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
//            $eavSetup->addAttribute(
//                Product::ENTITY,
//                'allow_to_ask_questions',
//                [
//                    'group' => 'General',
//                    'sort_order' => 10,
//                    'type' => 'int',
//                    'backend' => '',
//                    'frontend' => '',
//                    'label' => 'Allow to ask questions',
//                    'input' => 'boolean',
//                    'class' => '',
//                    'source' => Boolean::class,
//                    'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
//                    'visible' => true,
//                    'required' => true,
//                    'user_defined' => true,
//                    'default' => Boolean::VALUE_YES,
//                    'searchable' => false,
//                    'filterable' => false,
//                    'comparable' => false,
//                    'visible_on_front' => false,
//                    'used_in_product_listing' => true,
//                    'unique' => false,
//                    'apply_to' => ''
//                ]
//            );

            $code = 'disallow_ask_question';
            /** @var EavSetup $eavSetup */
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            $eavSetup->addAttribute(
                Customer::ENTITY,
                'disallow_ask_question',
                [
                    'type'         => 'int',
                    'label'        => 'Disallow Ask Question',
                    'input'        => 'select',
                    'source'       => Boolean::class,
                    'required'     => false,
                    'visible'      => false,
                    'user_defined' => true,
                    'position'     => 999,
                    'system'       => 0,
                    'default'      => 0,
                    'used_in_forms' => ['adminhtml_customer', 'customer_account_edit'],
                ]
            );
            $attribute = $this->customerAttribute->loadByCode(Customer::ENTITY, $code);
            $attribute->addData([
                'attribute_set_id' => 1,
                'attribute_group_id' => 1,
                'used_in_forms' => ['adminhtml_customer', 'customer_account_edit'],
            ])->save();
        }

        $setup->endSetup();
    }
}

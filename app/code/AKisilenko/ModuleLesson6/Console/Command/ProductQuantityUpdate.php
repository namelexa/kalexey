<?php
namespace AKisilenko\ModuleLesson6\Console\Command;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\CatalogInventory\Api\StockStateInterface;
use Magento\Framework\App\State;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Magento\Framework\App\Area;

class ProductQuantityUpdate extends Command
{
    /**
     * @var State
     */
    private $state;

    /**
     * @var Magento\CatalogInventory\Api\StockStateInterface
     */
    protected $_stockStateInterface;
    /**
     * @var Magento\CatalogInventory\Api\StockRegistryInterface
     */
    protected $_stockRegistry;
    /**
     * CustomQtyUpdate constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param StockStateInterface $stockStateInterface
     * @param StockRegistryInterface $stockRegistry
     * @param State $state
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        StockStateInterface $stockStateInterface,
        StockRegistryInterface $stockRegistry,
        State $state
    ) {
        $this->productRepository = $productRepository;
        $this->_stockStateInterface = $stockStateInterface;
        $this->_stockRegistry = $stockRegistry;
        $this->state = $state;
        parent::__construct();
    }

    /**
     * @param $productId
     * @param $stockData
     * @throws NoSuchEntityException
     */
    public function updateProductStock(
        $productId,
        $stockData
    ) {
        $product = $this->productRepository->getById($productId);
        $stockItem = $this->_stockRegistry->getStockItem($product->getId());
        $stockItem->setData('is_in_stock', 1);
        $stockItem->setData('quantity', $stockData);
        $stockItem->setData('manage_stock', 1);
        $stockItem->setData('notify_quantity', 1);
        $stockItem->save();
        $this->_stockRegistry->updateStockItemBySku($product->getSku(), $stockItem);
    }

    /**
     * Usage product-updater:update-qty [<product_id>] [<quantity>]
     */
    protected function configure()
    {
        parent::configure();

        $this->setName('product-updater:update-qty')
            ->setDescription('Product Quantity Update')
            ->setDefinition([
                new InputArgument(
                    'product_id',
                    InputArgument::OPTIONAL,
                    'Product Id'
                ),
                new InputArgument(
                    'quantity',
                    InputArgument::OPTIONAL,
                    'Product Qty'
                )
            ]);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $this->state->setAreaCode(Area::AREA_ADMINHTML);
        if ($input->getArgument('product_id')) {
            $productId = $input->getArgument('product_id');
        } else {
            $output->writeln('<info>Please input product Id for update!<info>');
            return;
        }
        if ($input->getArgument('quantity')) {
            $quantity = $input->getArgument('quantity');
        } else {
            $output->writeln('<info>Please input product qty for update!<info>');
            return;
        }
        $output->writeln("<info>Processing product id: $productId. Quantity: $quantity. <info>");
        $this->updateProductStock($productId, $quantity);
        $output->writeln('<info>Product has been updated. <info>');
    }
}

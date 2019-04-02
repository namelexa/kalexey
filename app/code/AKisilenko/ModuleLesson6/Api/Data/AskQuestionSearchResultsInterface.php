<?php
namespace AKisilenko\ModuleLesson6\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface AskQuestionSearchResultsInterface
 * @package AKisilenko\ModuleLesson6\Api\Data
 */
interface AskQuestionSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get request samples list.
     *
     * @return AskQuestionInterface[]
     */
    public function getItems();
    /**
     * Set request samples list.
     *
     * @param AskQuestionInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
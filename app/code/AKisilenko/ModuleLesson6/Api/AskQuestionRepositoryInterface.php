<?php
namespace AKisilenko\ModuleLesson6\Api;

use AKisilenko\ModuleLesson6\Api\Data\AskQuestionInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface AskQuestionRepositoryInterface
 * @package AKisilenko\ModuleLesson6\Api
 */
interface AskQuestionRepositoryInterface
{
    /**
     * @param \AKisilenko\ModuleLesson6\Api\Data\AskQuestionInterface $askQuestion
     * @return \AKisilenko\ModuleLesson6\Api\Data\AskQuestionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(AskQuestionInterface $askQuestion);

    /**
     * @param int $askQuestionId
     * @return \AKisilenko\ModuleLesson6\Api\Data\AskQuestionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($askQuestionId);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \AKisilenko\ModuleLesson6\Api\Data\AskQuestionSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param \AKisilenko\ModuleLesson6\Api\Data\AskQuestionInterface $askQuestion
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(AskQuestionInterface $askQuestion);

    /**
     * @param int $askQuestionId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($askQuestionId);
}
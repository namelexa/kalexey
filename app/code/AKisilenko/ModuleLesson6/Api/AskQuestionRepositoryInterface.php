<?php
namespace AKisilenko\ModuleLesson6\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface AskQuestionRepositoryInterface
 * @package AKisilenko\ModuleLesson6\Api
 */
interface AskQuestionRepositoryInterface
{
    /**
     * @param Data\AskQuestionInterface $askQuestion
     * @return mixed
     */
    public function save(Data\AskQuestionInterface $askQuestion);

    /**
     * @param $askQuestionId
     * @return mixed
     */
    public function getById($askQuestionId);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param Data\AskQuestionInterface $askQuestion
     * @return mixed
     */
    public function delete(Data\AskQuestionInterface $askQuestion);

    /**
     * @param $askQuestionId
     * @return mixed
     */
    public function deleteById($askQuestionId);
}
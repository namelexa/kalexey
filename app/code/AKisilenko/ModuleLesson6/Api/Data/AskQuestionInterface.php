<?php
namespace AKisilenko\ModuleLesson6\Api\Data;

/**
 * Interface AskQuestionInterface
 * @package AKisilenko\ModuleLesson6\Api\Data
 */
interface AskQuestionInterface
{
    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * @param $id
     * @return mixed
     */
    public function setId($id);

    /**
     * Gets the created-at timestamp for the request sample.
     *
     * @return string|null Created-at timestamp.
     */
    public function getCreatedAt();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * @param $name
     * @return mixed
     */
    public function setName($name);

    /**
     * @return mixed
     */
    public function getEmail();

    /**
     * @param $email
     * @return mixed
     */
    public function setEmail($email);

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone();

    /**
     * @param $phone
     * @return mixed
     */
    public function setPhone($phone);

    /**
     * Get request
     *
     * @return string
     */
    public function getComment();

    /**
     * @param $comment
     * @return mixed
     */
    public function setComment($comment);

    /**
     * @return mixed
     */
    public function getStatus();

    /**
     * @param $status
     * @return mixed
     */
    public function setStatus($status);

    /**
     * @return mixed
     */
    public function getStoreId();

    /**
     * @param $storeId
     * @return mixed
     */
    public function setStoreId($storeId);
}

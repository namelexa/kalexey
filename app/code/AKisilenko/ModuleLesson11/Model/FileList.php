<?php

declare(strict_types=1);

namespace AKisilenko\ModuleLesson11\Model;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Magento\Framework\Filesystem\DirectoryList ;

/**
 * Class MyFiles
 * @package file_list
 */
class FileList extends DirectoryList
{
    protected $directoryList;

    /**
     * FileList constructor.
     * @param DirectoryList $directoryList
     */
    public function __construct(
        DirectoryList $directoryList
    )
    {
        $this->directoryList = $directoryList;
        parent::__construct(
            $directoryList
        );
    }

    public function makeFileList()
    {
        $path = realpath($this->directoryList->getRoot() . '/app/code/');
        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
        return $objects;
    }
}

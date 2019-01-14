<?php

declare(strict_types=1);

namespace AKisilenko\ModuleLesson11\Model;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Class MyFiles
 * @package file_list
 */
class FileList
{
    public function makeFileList()
    {
        $path = realpath('/misc/apps/kalexey/app/code/');
        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
        return $objects;
//        foreach($objects as $name => $object){
//            return "$name" . ' ' . date('F d Y H:i:s.', filemtime($name)) . "\n";
//        }
    }
}
//$newFiles = new FileList();
//$newFiles->makeFileList();

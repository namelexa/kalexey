<?php
namespace AKisilenko\ModuleLesson6\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use AKisilenko\ModuleLesson6\Model\AskQuestion;
use Magento\Cron\Model\Schedule;

class Status implements OptionSourceInterface
{
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'label' => __('Processed'),
                'value' => AskQuestion::STATUS_PROCESSED,
            ],
            [
                'label' => __('Pending'),
                'value' => AskQuestion::STATUS_PENDING,
            ],

        ];
    }
}
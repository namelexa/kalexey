<?php
namespace AKisilenko\UIModuleLesson9\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;

class NewField extends AbstractModifier
{
    private $locator;
    public function __construct(
        LocatorInterface $locator
    ) {
        $this->locator = $locator;
    }
    /**
     * @param array $meta
     * @return array
     */
    public function modifyMeta(array $meta): array
    {
        $meta['custom_product_fieldset'] = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Custom product fieldset'),
                        'componentType' => 'fieldset',
                        'sortOrder' => 10,
                        'collapsible' => true
                    ]
                ]
            ],
            'children' => [
                'input_field' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'componentType' => 'field',
                                'formElement'   => 'input',
                                'label'         => __('Input field'),
                                'dataType'      => 'text',
                                'sortOrder'     => 20,
                                'dataScope'     => 'input_field',
                            ]
                        ]
                    ]
                ],
                'input_number_field' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'componentType' => 'field',
                                'formElement'   => 'input',
                                'label'         => __('Input number field'),
                                'dataType'      => 'number', /*how to do this field type number ?*/
                                'sortOrder'     => 20,
                                'dataScope'     => 'input_number_field',
                                'required'      => 'true', /*how to do this field required ?*/
                            ]
                        ]
                    ]
                ],
                'checkbox_field' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'componentType' => 'field',
                                'formElement'   => 'checkbox',
                                'label'         => __('Checkbox field'),
                                'dataType'      => 'boolean',
                                'sortOrder'     => 30,
                                'dataScope'     => 'checkbox_field',
                            ]
                        ]
                    ]
                ],
            ]
        ];
        return $meta;
    }
    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data): array
    {
        return $data;
    }
}

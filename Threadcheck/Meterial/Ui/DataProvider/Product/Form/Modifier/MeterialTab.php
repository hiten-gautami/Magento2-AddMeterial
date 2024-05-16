<?php

namespace Threadcheck\Meterial\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Framework\View\LayoutFactory;
use Threadcheck\Meterial\Block\Adminhtml\Product\Edit\Tab\Meterial;

class MeterialTab extends AbstractModifier
{

    protected $layoutFactory;

    public function __construct(
        LayoutFactory $layoutFactory
    ) {
        $this->layoutFactory = $layoutFactory;
    }

    /**
     * Modify data
     *
     * @param array $data
     * @return array
     */
    public function modifyData(array $data)
    {
        return $data;
    }

    /**
     * Modify meta data
     *
     * @param array $meta
     * @return void
     */
    public function modifyMeta(array $meta)
    {
        $meta['meterial_tab'] = [
            "children" => [
                "meterial_tab_container" => [
                    "arguments" => [
                        "data" => [
                            "config" => [
                                "formElement" => "container",
                                "componentType" => "container",
                                'component' => 'Magento_Ui/js/form/components/html',
                                "required" => 0,
                                "sortOrder" => 5,
                                "content" => $this->layoutFactory->create()->createBlock(
                                    Meterial::class
                                )->toHtml(),
                            ]
                        ]
                    ]
                ]
            ],
            "arguments" => [
                "data" => [
                    "config" => [
                        "componentType" => "fieldset",
                        "label" => __("Material Tab"),
                        "collapsible" => true,
                        "sortOrder" => 5,
                        'opened' => true,
                        'canShow' => true
                    ]
                ]
            ]
        ];
        return $meta;
    }
}
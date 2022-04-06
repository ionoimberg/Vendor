<?php

namespace Mageplaza\Vendor\Model;

use Mageplaza\Vendor\Model\ResourceModel\Vendor\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $CollectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $CollectionFactory->create()->load();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        foreach ($items as $item)
        {
            $this->loadedData[$item->getData('vendor_id')]['main_fieldset']['general_information'] = $item->getData();
            $this->loadedData[$item->getData('vendor_id')]['settings_fieldset']['general_settings'] = $item->getData();
            $this->loadedData[$item->getData('vendor_id')]['addresses_fieldset']['billing_address'] = $item->getData();
            $this->loadedData[$item->getData('vendor_id')]['addresses_fieldset']['shipping_address'] = $item->getData();


        }

        return $this->loadedData;

    }

}

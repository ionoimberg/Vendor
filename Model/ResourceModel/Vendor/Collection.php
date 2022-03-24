<?php
namespace Mageplaza\Vendor\Model\ResourceModel\Vendor;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'mageplaza_vendor_vendor_collection';
    protected $_eventObject = 'vendor_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Mageplaza\Vendor\Model\Vendor', 'Mageplaza\Vendor\Model\ResourceModel\Vendor');
    }

}
<?php
namespace Mageplaza\Vendor\Model\ResourceModel\Vendor;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Mageplaza\Vendor\Model\Vendor', 'Mageplaza\Vendor\Model\ResourceModel\Vendor');
    }

}
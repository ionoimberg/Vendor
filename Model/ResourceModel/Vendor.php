<?php
namespace Mageplaza\Vendor\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Vendor extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('mageplaza_vendor_vendor', 'vendor_id');
    }

}
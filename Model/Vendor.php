<?php
namespace Mageplaza\Vendor\Model;

use Magento\Framework\Model\AbstractModel;
class Vendor extends AbstractModel
{
    const CACHE_TAG = 'vendor_id';

    protected function _construct()
    {
        $this->_init('Mageplaza\Vendor\Model\ResourceModel\Vendor');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
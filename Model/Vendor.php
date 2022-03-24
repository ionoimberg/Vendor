<?php
namespace Mageplaza\Vendor\Model;
class Vendor extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'mageplaza_vendor_vendor';

    protected $_cacheTag = 'mageplaza_vendor_vendor';

    protected $_eventPrefix = 'mageplaza_vendor_vendor';

    protected function _construct()
    {
        $this->_init('Mageplaza\Vendor\Model\ResourceModel\Vendor');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
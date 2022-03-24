<?php
namespace Mageplaza\Vendor\Block;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $_vendorFactory;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Mageplaza\Vendor\Model\VendorFactory $vendorFactory
    )
    {
        $this->_vendorFactory = $vendorFactory;
        parent::__construct($context);
    }

    public function getVendorCollection()
    {
        $vendor = $this->_vendorFactory->create();
        return $vendor->getCollection();
    }
}
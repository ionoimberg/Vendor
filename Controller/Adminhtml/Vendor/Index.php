<?php

namespace Mageplaza\Vendor\Controller\Adminhtml\Vendor;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Mageplaza_Vendor::mageplaza_vendor_vendor_listing');
        $resultPage->getConfig()->getTitle()->prepend((__('Vendor Portal')));

        return $resultPage;
    }
}

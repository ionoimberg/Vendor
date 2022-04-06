<?php

namespace Mageplaza\Vendor\Controller\Adminhtml\Vendor;

use Magento\Backend\App\Action;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }

    protected function _initAction()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Mageplaza_Vendor::mageplaza_vendor_vendor')
            ->addBreadcrumb(__('Vendor'), __('Vendor'))
            ->addBreadcrumb(__('Manage Vendor'), __('Manage Vendor'));
        return $resultPage;
    }


    public function execute()
    {
        // 1. Get ID and create model
        
        $id = $this->getRequest()->getParam('vendor_id');
        $model = $this->_objectManager->create(\Mageplaza\Vendor\Model\Vendor::class); //TODO DON'T USE OBJECT MANAGER

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This vendor no longer exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('vendor_vendor', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Vendor $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Vendor') : __('Add Vendor'),
            $id ? __('Edit Vendor') : __('Add Vendor')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Vendor'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTitle() : __('Add Vendor'));

        return $resultPage;
    }
}
?>

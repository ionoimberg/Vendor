<?php

namespace Mageplaza\Vendor\Controller\Adminhtml\Vendor;

class Save extends \Magento\Backend\App\Action
{
    protected $vendorFactory;
    protected $adapterFactory;
    protected $uploader;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Mageplaza\Vendor\Model\VendorFactory $vendorFactory
    )
    {
        parent::__construct($context);
        $this->vendorFactory = $vendorFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        try {
            $model = $this->vendorFactory->create();
            $model->addData([
                "name" => $data['main_fieldset']['general_information']['name'],
                "status" => $data['main_fieldset']['general_information']['status'],
                "email" => $data['main_fieldset']['general_information']['email'],
                "telephone" => $data['main_fieldset']['general_information']['telephone'],
                "currency" => $data['settings_fieldset']['general_settings']['currency'],
                "notifications" => $data['settings_fieldset']['general_settings']['notifications'],
                "specifications" => $data['settings_fieldset']['general_settings']['specifications'],

            ]);
            $saveData = $model->save();
            if($saveData){
                $this->messageManager->addSuccess( __('Insert data Successfully !') );
            }
        }catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('*/*/index');
    }
}
<?php

namespace Mageplaza\Vendor\Controller\Adminhtml\Vendor;

class Save extends \Magento\Backend\App\Action
{
    protected $vendorFactory;
    protected $adapterFactory;
    protected $uploader;

    public function __construct(
        \Magento\Backend\App\Action\Context   $context,
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
            $model->setData([
                "name" => $data['main_fieldset']['general_information']['name'],
                "status" => $data['main_fieldset']['general_information']['status'],
                "email" => $data['main_fieldset']['general_information']['email'],
                "telephone" => $data['main_fieldset']['general_information']['telephone'],
                "currency" => $data['settings_fieldset']['general_settings']['currency'],
                "notifications" => $data['settings_fieldset']['general_settings']['notifications'],
                "specifications" => $data['settings_fieldset']['general_settings']['specifications'],
                "contact_name" => $data['addresses_fieldset']['billing_address']['contact_name'],
                "street" => $data['addresses_fieldset']['billing_address']['street'],
                "city" => $data['addresses_fieldset']['billing_address']['city'],
                "postal_code" => $data['addresses_fieldset']['billing_address']['postal_code'],
                "country" => $data['addresses_fieldset']['billing_address']['country'],
                "state_region" => $data['addresses_fieldset']['billing_address']['state_region'],
            ]);
            
            if($data['addresses_fieldset']['shipping_address']['custom_use_parent_settings'] == 1)
            {
                $model->addData([
                    "shipp_contact_name" => $data['addresses_fieldset']['billing_address']['contact_name'],
                    "shipp_street" => $data['addresses_fieldset']['billing_address']['street'],
                    "shipp_city" => $data['addresses_fieldset']['billing_address']['city'],
                    "shipp_postal_code" => $data['addresses_fieldset']['billing_address']['postal_code'],
                    "shipp_country" => $data['addresses_fieldset']['billing_address']['country'],
                    "shipp_state_region" => $data['addresses_fieldset']['billing_address']['state_region'],
                ]);
            } else {
                $model->addData([
                    "shipp_contact_name" => $data['addresses_fieldset']['shipping_address']['shipp_contact_name'],
                    "shipp_street" => $data['addresses_fieldset']['shipping_address']['shipp_street'],
                    "shipp_city" => $data['addresses_fieldset']['shipping_address']['shipp_city'],
                    "shipp_postal_code" => $data['addresses_fieldset']['shipping_address']['shipp_postal_code'],
                    "shipp_country" => $data['addresses_fieldset']['shipping_address']['shipp_country'],
                    "shipp_state_region" => $data['addresses_fieldset']['shipping_address']['shipp_state_region'],
                ]);
            }
            $saveData = $model->save();
            if ($saveData) {
                $this->messageManager->addSuccessMessage(__('Insert data Successfully !'));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        $this->_redirect('*/*/index');
    }
}

<?php
namespace Mageplaza\Vendor\Block\Adminhtml;

class Vendor extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_vendor';
        $this->_blockGroup = 'Mageplaza_Vendor';
        $this->_headerText = __('Vendors');
        $this->_addButtonLabel = __('Create New Vendor');
        parent::_construct();
    }
}
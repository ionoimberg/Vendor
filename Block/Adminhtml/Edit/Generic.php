<?php
namespace Mageplaza\Vendor\Block\Adminhtml\Edit;

use Magento\Backend\Block\Widget\Context;

class Generic
{
    protected $context;
    
    public function __construct(Context $context)
    {
        $this->context = $context;
    }
    
    public function getSettingsId()
    {
        return 1;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
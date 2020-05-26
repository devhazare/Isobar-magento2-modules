<?php
/**
 * Copyright © 2015 Isobar. All rights reserved.
 */
namespace Isobar\DiscountPackage\Model\ResourceModel;

/**
 * Custom resource
 */
class Custom extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('discountpackage_custom', 'id');
    }

  
}

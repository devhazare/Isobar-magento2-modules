<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Isobar\PayMeModule\Model;



/**
 * Pay In Store payment method model
 */
class PayMe extends \Magento\Payment\Model\Method\AbstractMethod
{

    /**
     * Payment code
     *
     * @var string
     */
    protected $_code = 'payme';

    /**
     * Availability option
     *
     * @var bool
     */
    protected $_isOffline = true;


  

}

<?php

/**
 * @author     Karazey Sergey <karazey.sergey@gmail.com>
 * @copyright  2014 Karazey Sergey
 * @created    6/22/14 7:13 PM
 */
class SliRx_PaymentMethod_Model_TestPaymentMethod extends Mage_Payment_Model_Method_Abstract
{
    protected $_code = 'test_payment_method';

    /**
     * Calls after user checkout and redirect to that link
     *
     * @return string
     */
    public function getOrderPlaceRedirectUrl()
    {
        return Mage::getUrl('slirx_paymentmethod/index/redirect', array('_secure' => true));
    }
}

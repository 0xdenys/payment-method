<?php

/**
 * @author     Karazey Sergey <karazey.sergey@gmail.com>
 * @copyright  2014 Karazey Sergey
 * @created    6/22/14 7:13 PM
 */
class SliRx_PaymentMethod_Model_TestPaymentMethod extends Mage_Payment_Model_Method_Abstract
{
    protected $_code = 'test_payment_method';
    protected $_formBlockType = 'slirx_paymentmethod/formPayment';
    protected $_infoBlockType = 'slirx_paymentmethod/infoPayment';

    public function assignData($data)
    {
        if (!($data instanceof Varien_Object)) {
            $data = new Varien_Object($data);
        }

        $info = $this->getInfoInstance();
        $info->setBillingCode($data->getBillingCode());
        $info->setBillingDate($data->getBillingDate());

        return $this;
    }

    public function validate()
    {
        parent::validate();

        $info = $this->getInfoInstance();

        $billingCode = $info->getBillingCode();
        $billingDate = $info->getBillingDate();
        if (empty($billingCode) || empty($billingDate)) {
            $errorMessage = $this->_getHelper()->__('Billing code and billing date are required fields');
        }

        if ($errorMessage) {
            Mage::throwException($errorMessage);
        }

        return $this;
    }
}

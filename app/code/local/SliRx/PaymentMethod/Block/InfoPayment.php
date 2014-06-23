<?php

/**
 * SliRx_PaymentMethod_Block_SliRx
 *
 * @author     Karazey Sergey <karazey.sergey@gmail.com>
 * @copyright  2014 Karazey Sergey
 * @created    6/23/14 10:23 PM
 */
class SliRx_PaymentMethod_Block_InfoPayment extends Mage_Payment_Block_Info
{
    protected function _prepareSpecificInformation($transport = null)
    {
        if (null !== $this->_paymentSpecificInformation) {
            return $this->_paymentSpecificInformation;
        }

        $info = $this->getInfo();
        $transport = new Varien_Object();
        $transport = parent::_prepareSpecificInformation($transport);
        $transport->addData(
            array(
                Mage::helper('payment')->__('Billing code') => $info->getBillingCode(),
                Mage::helper('payment')->__('Billing date') => $info->getBillingDate()
            )
        );

        return $transport;
    }
}

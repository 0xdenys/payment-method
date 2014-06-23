<?php

/**
 * @author     Karazey Sergey <karazey.sergey@gmail.com>
 * @copyright  2014 Karazey Sergey
 * @created    6/23/14 8:16 PM
 */
class SliRx_PaymentMethod_Block_FormPayment extends Mage_Payment_Block_Form
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('slirx_paymentmethod/form_payment.phtml');
    }
}

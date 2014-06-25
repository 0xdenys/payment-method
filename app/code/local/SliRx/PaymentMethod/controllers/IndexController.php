<?php

/**
 * SliRx_PaymentMethod_IndexController
 *
 * @author     Karazey Sergey <karazey.sergey@gmail.com>
 * @copyright  2014 Karazey Sergey
 * @created    6/24/14 9:30 PM
 */
class SliRx_PaymentMethod_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {

    }

    public function redirectAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function responseAction()
    {
        if ($this->getRequest()->getParam('paid') && $this->getRequest()->getParam('transaction_id') > 0) {
            $orderIncrementId = $this->getRequest()->getParam('order_id');
            $order = Mage::getModel('sales/order')->loadByIncrementId($orderIncrementId);
            $payment = $order->getPayment();
            $grandTotal = $order->getBaseGrandTotal();

            // add transaction
            $payment->setTransactionId($this->getRequest()->getParam('transaction_id'))
                ->setPreparedMessage("Payment:")
                ->setIsTransactionClosed(1)
                ->registerAuthorizationNotification($grandTotal);

            // add invoice
            $invoice = Mage::getModel('sales/service_order', $order)->prepareInvoice();
            if (!$invoice->getTotalQty()) {
                Mage::throwException(Mage::helper('core')->__('Cannot create an invoice without products.'));
            }
            $invoice->setRequestedCaptureCase(Mage_Sales_Model_Order_Invoice::CAPTURE_ONLINE);
            $invoice->register();
            $transactionSave = Mage::getModel('core/resource_transaction')
                ->addObject($invoice)
                ->addObject($invoice->getOrder());
            $transactionSave->save();

            $message = Mage::helper('slirx_paymentmethod')->__(
                'Notified customer about invoice #%s.',
                $order->getIncrementId()
            );
            $order->sendNewOrderEmail()->addStatusHistoryComment($message)
                ->setIsCustomerNotified(true);

            $order->save();

            // Show success notofication
            Mage::getSingleton('core/session')->addSuccess(
                $this->__('Online payment has been successfully completed.')
            );
            $url = Mage::getUrl('checkout/onepage/success', ['_secure' => true]);
            Mage::register('redirect_url', $url);
            $this->_redirectUrl($url);
        } else {
            // Show error notification
            Mage::getSingleton('core/session')->addError($this->__('Online payment has been failed!'));

            // Redirect to main page
            $this->_redirect('/');
        }
    }
}

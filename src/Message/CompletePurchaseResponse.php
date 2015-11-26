<?php

namespace Omnipay\Postfinance\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Postfinance\Gateway;

/**
 * Postfinance Complete Purchase Response
 */
class CompletePurchaseResponse extends AbstractResponse
{

    protected $validStates = array(
        Gateway::POSTFINANCE_AUTHORIZED,
        Gateway::POSTFINANCE_AUTHORIZED_WAITING,
        Gateway::POSTFINANCE_ORDER_SAVED,
        Gateway::POSTFINANCE_AWAIT_CUSTOMER_PAYMENT,
        Gateway::POSTFINANCE_PAYMENT_REQUESTED,
        Gateway::POSTFINANCE_PAYMENT_PROCESSING
    );

    public function isSuccessful()
    {
        $status = $this->getCode();

        return in_array((int)$status, $this->validStates);
    }

    public function getMessage()
    {
        if (!$this->isSuccessful()) {
            return $this->data['NCERROR'];
        }

        return '';
    }

    public function getCode()
    {
        return isset($this->data['STATUS']) ? $this->data['STATUS'] : '';
    }

    public function getTransactionReference()
    {
        return isset($this->data['PAYID']) ? $this->data['PAYID'] : '';
    }
}

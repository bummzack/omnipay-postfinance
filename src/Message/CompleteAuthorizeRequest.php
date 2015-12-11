<?php

namespace Omnipay\Postfinance\Message;


class CompleteAuthorizeRequest extends CompletePurchaseRequest
{
    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        return $this->response = new CompleteAuthorizeResponse($this, $data);
    }
}
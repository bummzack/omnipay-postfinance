<?php

namespace Omnipay\Postfinance\Message;


class CompleteAuthorizeResponse extends CompletePurchaseResponse
{
    protected $validStates = array(
        Helper::POSTFINANCE_AUTHORIZED,
        Helper::POSTFINANCE_AUTHORIZED_WAITING,
    );
}
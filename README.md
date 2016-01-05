# Omnipay: Postfinance 

[![Build Status](https://api.travis-ci.org/bummzack/omnipay-postfinance.png)](https://travis-ci.org/bummzack/omnipay-postfinance)

Ominpay Gateway for Postfinance.

This Gateway implements offsite payments via Postfinance. Purchase and Authorization are available, capturing an authorized payment has to be performed via Postfinance backend though (not currently implemented for this Gateway).

**Please note:** This gateway cannot successfully complete your requests if you don't use an SHA-OUT signature. If you don't set the SHA-OUT signature in the Postfinance backend, callback URLs won't be supplied with any parameters, which makes it impossible to determine success or failure of a payment-request.


## Basic Usage

Payment requests to the Postfinance Gateway must at least supply the following parameters:

 - `pspId` Your postfinance account ID 
 - `transactionId` unique transaction ID 
 - `amount` monetary amount 
 - `currency` currency
 - `language` locale code indicating the customer language preference, example: `en_US`
 
It is highly recommended to use SHA-IN and -OUT signatures for your requests.

```php
$gateway = Omnipay::create('Postfinance');
$gateway->setPspId('myPspId');
$gateway->setShaIn('MyShaInSecret');
$gateway->setShaOut('MyShaOutSecret');
$gateway->setLanguage('de_DE');

// Send purchase request
$response = $gateway->purchase(
    [
        'transactionId' => '17',
        'amount' => '10.00',
        'currency' => 'CHF'
    ]
)->send();

// This is a redirect gateway, so redirect right away
$response->redirect();

```


# Omnipay: Postfinance 

Ominpay Gateway for Postfinance

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


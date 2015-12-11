<?php

namespace Omnipay\Postfinance;

use Omnipay\Postfinance\Message\Helper;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setPspId('testPspId');
        $this->gateway->setLanguage('en_US');
        $this->gateway->setShaIn('MyShaInSecret');
        $this->gateway->setShaOut('MyShaOutSecret');

        $this->options = array(
            'amount' => '10.00',
            'currency' => 'CHF',
            'transactionId' => '1',
            'returnUrl' => 'https://www.example.com/return',
        );
    }

    public function testPurchase()
    {
        $response = $this->gateway->purchase($this->options)->send();

        $this->assertInstanceOf('\Omnipay\Postfinance\Message\PurchaseResponse', $response);
        $this->assertTrue($response->isRedirect());
        $this->assertStringStartsWith('https://e-payment.postfinance.ch/ncol/', $response->getRedirectUrl());
    }


    public function testCompletePurchaseSuccess()
    {
        $data = array(
            'STATUS' => 5,
            'NCERROR' => 0,
            'orderID' => '1',
            'PAYID' => 'a'
        );

        // create sha hash for the given data
        $data['SHASIGN'] = Helper::create_sha_hash($data, $this->gateway->getShaOut());

        $this->getHttpRequest()->query->replace($data);

        $response = $this->gateway->completePurchase($this->options)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('a', $response->getTransactionReference());
    }


    public function testCompletePurchaseError()
    {
        $data = array(
            'STATUS' => 0,
            'NCERROR' => 500,
            'orderID' => '1',
            'PAYID' => 'a'
        );

        // create sha hash for the given data
        $data['SHASIGN'] = Helper::create_sha_hash($data, $this->gateway->getShaOut());

        $this->getHttpRequest()->query->replace($data);

        $response = $this->gateway->completePurchase($this->options)->send();

        $this->assertFalse($response->isSuccessful());
    }

    /**
     * @expectedException Omnipay\Common\Exception\InvalidResponseException
     */
    public function testCompletePurchaseInvalid()
    {
        $this->getHttpRequest()->query->replace(array(
            'STATUS' => 5,
            'NCERROR' => 0,
            'orderID' => '1',
            'PAYID' => 'a',
            'SHASIGN' => 'InvalidHash'
        ));

        $response = $this->gateway->completePurchase($this->options)->send();
    }
}

<?php

namespace Omnipay\Postfinance;

use Omnipay\Common\AbstractGateway;

/**
 * Postfinance Gateway
 *
 */
class Gateway extends AbstractGateway
{
    /**
     * response status codes
     */
    const POSTFINANCE_INVALID                             = 0;
    const POSTFINANCE_PAYMENT_CANCELED_BY_CUSTOMER        = 1;
    const POSTFINANCE_AUTH_REFUSED                        = 2;

    const POSTFINANCE_ORDER_SAVED                         = 4;
    const POSTFINANCE_AWAIT_CUSTOMER_PAYMENT              = 41;

    const POSTFINANCE_AUTHORIZED                          = 5;
    const POSTFINANCE_AUTHORIZED_WAITING                  = 51;
    const POSTFINANCE_AUTHORIZED_UNKNOWN                  = 52;
    const POSTFINANCE_STAND_BY                            = 55;
    const POSTFINANCE_PAYMENTS_SCHEDULED                  = 56;
    const POSTFINANCE_AUTHORIZED_TO_GET_MANUALLY          = 59;

    const POSTFINANCE_VOIDED                              = 6;
    const POSTFINANCE_VOID_WAITING                        = 61;
    const POSTFINANCE_VOID_UNCERTAIN                      = 62;
    const POSTFINANCE_VOID_REFUSED                        = 63;
    const POSTFINANCE_VOIDED_ACCEPTED                     = 64;

    const POSTFINANCE_PAYMENT_DELETED                     = 7;
    const POSTFINANCE_PAYMENT_DELETED_WAITING             = 71;
    const POSTFINANCE_PAYMENT_DELETED_UNCERTAIN           = 72;
    const POSTFINANCE_PAYMENT_DELETED_REFUSED             = 73;
    const POSTFINANCE_PAYMENT_DELETED_OK                  = 74;
    const POSTFINANCE_PAYMENT_DELETED_PROCESSED_MERCHANT  = 75;

    const POSTFINANCE_REFUNDED                            = 8;
    const POSTFINANCE_REFUND_WAITING                      = 81;
    const POSTFINANCE_REFUND_UNCERTAIN_STATUS             = 82;
    const POSTFINANCE_REFUND_REFUSED                      = 83;
    const POSTFINANCE_REFUND_DECLINED_ACQUIRER            = 84;
    const POSTFINANCE_REFUND_PROCESSED_MERCHANT           = 85;

    const POSTFINANCE_PAYMENT_REQUESTED                   = 9;
    const POSTFINANCE_PAYMENT_PROCESSING                  = 91;
    const POSTFINANCE_PAYMENT_UNCERTAIN                   = 92;
    const POSTFINANCE_PAYMENT_REFUSED                     = 93;
    const POSTFINANCE_PAYMENT_DECLINED_ACQUIRER           = 94;
    const POSTFINANCE_PAYMENT_PROCESSED_MERCHANT          = 95;
    const POSTFINANCE_PAYMENT_IN_PROGRESS                 = 99;


    public function getName()
    {
        return 'Postfinance';
    }

    public function getDefaultParameters()
    {
        return array(
            // general params
            'pspId'             => '',
            'shaIn'             => '',
            'shaOut'            => '',
            'testMode'          => false,
            'hashingMethod'     => array('sha1', 'sha256', 'sha512'),
            'encoding'          => array('ISO-8859-1', 'UTF-8'),
            'language'          => '', // ISO Language code

            // template parameters
            'tp'                => '',
            'title'             => '',
            'bgColor'           => '',
            'txtColor'          => '',
            'tblBgColor'        => '',
            'hdTblBgColor'      => '', // iPhone template only
            'tblTxtColor'       => '',
            'hdTblTxtColor'     => '', // iPhone template only
            'buttonBgColor'     => '',
            'buttonTxtColor'    => '',
            'logo'              => '',
            'fontType'          => '',
            'hdFontType'        => '' // iPhone template only
        );
    }

    /**
     * Accessor for the PSP ID
     * @return string
     */
    public function getPspId()
    {
        return $this->getParameter('pspId');
    }

    public function setPspId($value)
    {
        $this->setParameter('pspId', $value);
    }

    /**
     * Accessor for the SHA IN signature
     * @return string
     */
    public function getShaIn()
    {
        return $this->getParameter('shaIn');
    }

    public function setShaIn($value)
    {
        $this->setParameter('shaIn', $value);
    }

    /**
     * Accessor for the SHA OUT signature
     * @return string
     */
    public function getShaOut()
    {
        return $this->getParameter('shaOut');
    }

    public function setShaOut($value)
    {
        $this->setParameter('shaOut', $value);
    }

    /**
     * Accessor for the hashing method to use.
     * @return string
     */
    public function getHashingMethod()
    {
        return $this->getParameter('hashingMethod');
    }

    /**
     * Set the hashing method
     * @param string $value Valid values are: sha1, sha256, sha512
     */
    public function setHashingMethod($value)
    {
        $this->setParameter('hashingMethod', strtolower($value));
    }

    /**
     * Accessor for the encoding to use.
     * @return string
     */
    public function getEncoding()
    {
        return $this->getParameter('encoding');
    }

    /**
     * Set the encoding
     * @param string $value Valid values are: ISO-8859-1, UTF-8
     */
    public function setEncoding($value)
    {
        $this->setParameter('encoding', strtoupper($value));
    }

    /**
     * Accessor for the language
     * @return string
     */
    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    public function setLanguage($value)
    {
        $this->setParameter('language', $value);
    }

    /**
     * Accessor for the custom template file
     * @return string
     */
    public function getTP()
    {
        return $this->getParameter('tp');
    }

    public function setTP($value)
    {
        $this->setParameter('tp', $value);
    }

    /**
     * Accessor for the template title
     * @return string
     */
    public function getTitle()
    {
        return $this->getParameter('title');
    }

    public function setTitle($value)
    {
        $this->setParameter('title', $value);
    }

    /**
     * Accessor for the template background-color (defaults to white)
     * @return string
     */
    public function getBgColor()
    {
        return $this->getParameter('bgColor');
    }

    public function setBgColor($value)
    {
        $this->setParameter('bgColor', $value);
    }

    /**
     * Accessor for the template text-color (defaults to black)
     * @return string
     */
    public function getTxtColor()
    {
        return $this->getParameter('txtColor');
    }

    public function setTxtColor($value)
    {
        $this->setParameter('txtColor', $value);
    }

    /**
     * Accessor for the template table-background-color (defaults to white)
     * @return string
     */
    public function getTblBgColor()
    {
        return $this->getParameter('tblBgColor');
    }

    public function setTblBgColor($value)
    {
        $this->setParameter('tblBgColor', $value);
    }

    /**
     * Accessor for the table-background-color for left column (iPhone template) (defaults to #00467F)
     * @return string
     */
    public function getHdTblBgColor()
    {
        return $this->getParameter('hdTblBgColor');
    }

    public function setHdTblBgColor($value)
    {
        $this->setParameter('hdTblBgColor', $value);
    }

    /**
     * Accessor for the template table-text-color (defaults to black)
     * @return string
     */
    public function getTblTxtColor()
    {
        return $this->getParameter('tblTxtColor');
    }

    public function setTblTxtColor($value)
    {
        $this->setParameter('tblTxtColor', $value);
    }

    /**
     * Accessor for the table-text-color for left column (iPhone template) (defaults to white)
     * @return string
     */
    public function getHdTblTxtColor()
    {
        return $this->getParameter('hdTblTxtColor');
    }

    public function setHdTblTxtColor($value)
    {
        $this->setParameter('hdTblTxtColor', $value);
    }

    /**
     * Accessor for the template button background-color
     * @return string
     */
    public function getButtonBgColor()
    {
        return $this->getParameter('buttonBgColor');
    }

    public function setButtonBgColor($value)
    {
        $this->setParameter('buttonBgColor', $value);
    }

    /**
     * Accessor for the template button text-color (defaults to black)
     * @return string
     */
    public function getButtonTxtColor()
    {
        return $this->getParameter('buttonTxtColor');
    }

    public function setButtonTxtColor($value)
    {
        $this->setParameter('buttonTxtColor', $value);
    }

    /**
     * Accessor for the template font (defaults to Verdana)
     * @return string
     */
    public function getFontType()
    {
        return $this->getParameter('fontType');
    }

    public function setFontType($value)
    {
        $this->setParameter('fontType', $value);
    }

    /**
     * Accessor for the font for left column (iPhone template) (defaults to Verdana)
     * @return string
     */
    public function getHdFontType()
    {
        return $this->getParameter('hdFontType');
    }

    public function setHdFontType($value)
    {
        $this->setParameter('hdFontType', $value);
    }

    /**
     * Accessor for the template logo. Must be stored on an https:// server
     * @return string
     */
    public function getLogo()
    {
        return $this->getParameter('logo');
    }

    public function setLogo($value)
    {
        $this->setParameter('logo', $value);
    }


    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Postfinance\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Postfinance\Message\CompletePurchaseRequest', $parameters);
    }

}

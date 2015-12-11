<?php

namespace Omnipay\Postfinance;

use Omnipay\Common\AbstractGateway;

/**
 * Postfinance Gateway
 *
 */
class Gateway extends AbstractGateway
{
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
        $this->setParameter('hashingMethod', $value);
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
        $this->setParameter('encoding', $value);
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

    /**
     * Start a purchase request
     *
     * @param array $parameters array of options
     * @return \Omnipay\Postfinance\Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Postfinance\Message\PurchaseRequest', $parameters);
    }

    /**
     * Complete a purchase
     *
     * @param array $parameters
     * @return \Omnipay\Postfinance\Message\CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Postfinance\Message\CompletePurchaseRequest', $parameters);
    }

}

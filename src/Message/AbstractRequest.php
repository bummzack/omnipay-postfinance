<?php

namespace Omnipay\Postfinance\Message;

use Omnipay\Common\CreditCard;

/**
 * Postfinance abstract request
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
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

}

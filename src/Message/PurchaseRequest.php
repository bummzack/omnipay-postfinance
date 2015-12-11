<?php

namespace Omnipay\Postfinance\Message;

use Omnipay\Common\CreditCard;

class PurchaseRequest extends AbstractRequest
{

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

    protected $optionalParams = array(
        'tp',
        'title',
        'bgColor',
        'txtColor',
        'tblBgColor',
        'hdTblBgColor',
        'tblTxtColor',
        'hdTblTxtColor',
        'buttonBgColor',
        'buttonTxtColor',
        'logo',
        'fontType',
        'hdFontType'
    );

    public function getData()
    {
        $this->validate('pspId', 'transactionId', 'amount', 'currency', 'language');

        $data = array(
            'PSPID'     => $this->getPspId(),
            'ORDERID'   => $this->getTransactionId(),
            'AMOUNT'    => $this->getAmountInteger(),
            'CURRENCY'  => $this->getCurrency(),
            'LANGUAGE'  => $this->getLanguage()
        );

        foreach($this->optionalParams as $param){
            $value = Helper::string_value($this->getParameter($param));

            if($value !== ''){
                $data[strtoupper($param)] = $value;
            }
        }

        /** @var CreditCard $card */
        if($card = $this->getCard()){
            $data['CN']             = $card->getName();
            $data['EMAIL']          = $card->getEmail();
            $data['OWNERADDRESS']   = $card->getAddress1() . ($card->getAddress2() ? ' / ' . $card->getAddress2() : '');
            $data['OWNERZIP']       = $card->getPostcode();
            $data['OWNERTOWN']      = $card->getCity();
            $data['OWNERCTY']       = $card->getCountry();
            $data['OWNERTELNO']     = $card->getPhone();
        }

        $data['COM'] = $this->getDescription();

        $data['ACCEPTURL']      = $this->getReturnUrl();
        $data['CANCELURL']      = $this->getCancelUrl();
        $data['EXCEPTIONURL']   = $this->getNotifyUrl();
        $data['DECLINEURL']     = $this->getNotifyUrl();


        return $data;
    }

    // Send request the 1.x way
    public function send()
    {
        return $this->response = new PurchaseResponse($this, $this->getData());
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}

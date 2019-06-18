<?php namespace Pyrexx\ZUGFeRD\Model;

use JMS\Serializer\Annotation as JMS;
use Pyrexx\ZUGFeRD\CodeList\Currency;
use Pyrexx\ZUGFeRD\Model\Trade\Amount;
use Pyrexx\ZUGFeRD\Model\Trade\Tax\TradeTax;

/**
 * Class AllowanceCharge
 *
 * @package Pyrexx\ZUGFeRD\Model
 */
class AllowanceCharge
{
    /**
     * @var Indicator
     * @JMS\Type("Pyrexx\ZUGFeRD\Model\Indicator")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("ChargeIndicator")
     */
    private $indicator;

    /**
     * @var Amount
     * @JMS\Type("Pyrexx\ZUGFeRD\Model\Trade\Amount")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("ActualAmount")
     */
    private $actualAmount;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("Reason")
     */
    private $reason;

    /**
     * @var TradeTax
     * @JMS\Type("Pyrexx\ZUGFeRD\Model\Trade\Tax\TradeTax")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("CategoryTradeTax")
     */
    private $categoryTradeTax;

    /**
     * AllowanceCharge constructor.
     *
     * @param bool   $indicator
     * @param double $actualAmount
     * @param string $currency
     */
    public function __construct($indicator, $actualAmount, $currency = Currency::EUR)
    {
        $this->indicator = new Indicator($indicator);
        $this->actualAmount = new Amount($actualAmount, $currency, false);
    }

    /**
     * @return boolean
     */
    public function getIndicator()
    {
        return $this->indicator->getIndicator();
    }

    /**
     * @param boolean $indicator
     */
    public function setIndicator($indicator)
    {
        $this->indicator->setIndicator($indicator);
    }

    /**
     * @return \Pyrexx\ZUGFeRD\Model\Trade\Amount
     */
    public function getActualAmount()
    {
        return $this->actualAmount;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\Amount $actualAmount
     */
    public function setActualAmount($actualAmount)
    {
        $this->actualAmount = $actualAmount;
    }

    /**
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }

    /**
     * @param string $reason
     *
     * @return AllowanceCharge
     */
    public function setReason(string $reason): AllowanceCharge
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * @return TradeTax
     */
    public function getCategoryTradeTax(): TradeTax
    {
        return $this->categoryTradeTax;
    }

    /**
     * @param TradeTax $categoryTradeTax
     *
     * @return AllowanceCharge
     */
    public function setCategoryTradeTax(TradeTax $categoryTradeTax): AllowanceCharge
    {
        $this->categoryTradeTax = $categoryTradeTax;

        return $this;
    }
}

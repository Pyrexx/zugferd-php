<?php

namespace Pyrexx\ZUGFeRD\Model\Trade;

use JMS\Serializer\Annotation as JMS;
use Pyrexx\ZUGFeRD\Model\Trade\Tax\TradeTax;

/**
 * Class SpecifiedLogisticsServiceCharge
 *
 * @package Pyrexx\ZUGFeRD\Model\Trade
 */
class SpecifiedLogisticsServiceCharge
{
    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("Description")
     */
    private $description;

    /**
     * @var Amount
     * @JMS\Type("Pyrexx\ZUGFeRD\Model\Trade\Amount")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("AppliedAmount")
     */
    private $appliedAmount;

    /**
     * @var TradeTax
     * @JMS\Type("Pyrexx\ZUGFeRD\Model\Trade\Tax\TradeTax")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("AppliedTradeTax")
     */
    private $appliedTradeTax;

    /**
     * SpecifiedLogisticsServiceCharge constructor.
     *
     * @param string $description
     * @param Amount $appliedAmount
     */
    public function __construct(string $description, Amount $appliedAmount)
    {
        $this->description = $description;
        $this->appliedAmount = $appliedAmount;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return SpecifiedLogisticsServiceCharge
     */
    public function setDescription(string $description): SpecifiedLogisticsServiceCharge
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Amount
     */
    public function getAppliedAmount(): Amount
    {
        return $this->appliedAmount;
    }

    /**
     * @param Amount $appliedAmount
     *
     * @return SpecifiedLogisticsServiceCharge
     */
    public function setAppliedAmount(Amount $appliedAmount): SpecifiedLogisticsServiceCharge
    {
        $this->appliedAmount = $appliedAmount;

        return $this;
    }

    /**
     * @return TradeTax
     */
    public function getAppliedTradeTax(): TradeTax
    {
        return $this->appliedTradeTax;
    }

    /**
     * @param TradeTax $appliedTradeTax
     *
     * @return SpecifiedLogisticsServiceCharge
     */
    public function setAppliedTradeTax(TradeTax $appliedTradeTax): SpecifiedLogisticsServiceCharge
    {
        $this->appliedTradeTax = $appliedTradeTax;

        return $this;
    }
}

<?php namespace Pyrexx\ZUGFeRD\Model\Trade;

use Pyrexx\ZUGFeRD\CodeList\Currency;
use Pyrexx\ZUGFeRD\Model\AllowanceCharge;
use Pyrexx\ZUGFeRD\Model\Trade\Tax\TradeTax;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

/**
 * @AccessorOrder("custom", custom = {"paymentReference", "currency", "paymentMeans", "tradeTaxes", "allowanceCharges", "logisticsService", "paymentTerms", "monetarySummation"})
 */
class Settlement
{
    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("PaymentReference")
     */
    private $paymentReference;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("InvoiceCurrencyCode")
     */
    private $currency;

    /**
     * @var PaymentMeans
     * @Type("Pyrexx\ZUGFeRD\Model\Trade\PaymentMeans")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("SpecifiedTradeSettlementPaymentMeans")
     */
    private $paymentMeans;

    /**
     * @var TradeTax[]
     * @Type("array<Pyrexx\ZUGFeRD\Model\Trade\Tax\TradeTax>")
     * @XmlList(inline = true, entry = "ApplicableTradeTax", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     */
    private $tradeTaxes = array();

    /**
     * @var AllowanceCharge[]
     * @Type("array<Pyrexx\ZUGFeRD\Model\AllowanceCharge>")
     * @XmlList(inline=true, entry="SpecifiedTradeAllowanceCharge", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     */
    private $allowanceCharges = [];

    /**
     * @var SpecifiedLogisticsServiceCharge
     * @Type("Pyrexx\ZUGFeRD\Model\Trade\SpecifiedLogisticsServiceCharge")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("SpecifiedLogisticsServiceCharge")
     */
    private $logisticsService;

    /**
     * @var PaymentTerms
     * @Type("Pyrexx\ZUGFeRD\Model\Trade\PaymentTerms")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("SpecifiedTradePaymentTerms")
     */
    private $paymentTerms;

    /**
     * @var MonetarySummation
     * @Type("Pyrexx\ZUGFeRD\Model\Trade\MonetarySummation")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("SpecifiedTradeSettlementMonetarySummation")
     */
    private $monetarySummation;

    /**
     * Settlement constructor.
     *
     * @param string $paymentReference
     * @param string $currency
     */
    public function __construct($paymentReference = '', $currency = Currency::EUR)
    {
        $this->paymentReference = $paymentReference;
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getPaymentReference()
    {
        return $this->paymentReference;
    }

    /**
     * @param string $paymentReference
     *
     * @return self
     */
    public function setPaymentReference($paymentReference)
    {
        $this->paymentReference = $paymentReference;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     *
     * @return self
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return \Pyrexx\ZUGFeRD\Model\Trade\PaymentMeans
     */
    public function getPaymentMeans()
    {
        return $this->paymentMeans;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\PaymentMeans $paymentMeans
     *
     * @return self;
     */
    public function setPaymentMeans(PaymentMeans $paymentMeans)
    {
        $this->paymentMeans = $paymentMeans;
        return $this;
    }

    /**
     * @return \Pyrexx\ZUGFeRD\Model\Trade\Tax\TradeTax[]
     */
    public function getTradeTaxes()
    {
        return $this->tradeTaxes;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\Tax\TradeTax $tradeTax
     *
     * @return self
     */
    public function addTradeTax(TradeTax $tradeTax)
    {
        $this->tradeTaxes[] = $tradeTax;
        return $this;
    }

    /**
     * @return AllowanceCharge[]
     */
    public function getAllowanceCharges(): array
    {
        return $this->allowanceCharges;
    }

    /**
     * @param AllowanceCharge $allowanceCharge
     *
     * @return Settlement
     */
    public function addAllowanceCharge(AllowanceCharge $allowanceCharge): Settlement
    {
        $this->allowanceCharges[] = $allowanceCharge;

        return $this;
    }

    /**
     * @return SpecifiedLogisticsServiceCharge
     */
    public function getLogisticsService(): SpecifiedLogisticsServiceCharge
    {
        return $this->logisticsService;
    }

    /**
     * @param SpecifiedLogisticsServiceCharge $logisticsService
     *
     * @return Settlement
     */
    public function setLogisticsService(SpecifiedLogisticsServiceCharge $logisticsService): Settlement
    {
        $this->logisticsService = $logisticsService;

        return $this;
    }

    /**
     * @return \Pyrexx\ZUGFeRD\Model\Trade\PaymentTerms
     */
    public function getPaymentTerms()
    {
        return $this->paymentTerms;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\PaymentTerms $paymentTerms
     *
     * @return self
     */
    public function setPaymentTerms($paymentTerms)
    {
        $this->paymentTerms = $paymentTerms;
        return $this;
    }

    /**
     * @return MonetarySummation
     */
    public function getMonetarySummation(): MonetarySummation
    {
        return $this->monetarySummation;
    }

    /**
     * @param MonetarySummation $monetarySummation
     *
     * @return Settlement
     */
    public function setMonetarySummation(MonetarySummation $monetarySummation): Settlement
    {
        $this->monetarySummation = $monetarySummation;

        return $this;
    }
}

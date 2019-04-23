<?php

namespace Pyrexx\ZUGFeRD\Tests;

use Pyrexx\ZUGFeRD\Builder;
use Pyrexx\ZUGFeRD\CodeList\Country;
use Pyrexx\ZUGFeRD\CodeList\Currency;
use Pyrexx\ZUGFeRD\CodeList\DateFormat;
use Pyrexx\ZUGFeRD\CodeList\PaymentMethod;
use Pyrexx\ZUGFeRD\CodeList\TaxCategory;
use Pyrexx\ZUGFeRD\CodeList\TaxId;
use Pyrexx\ZUGFeRD\CodeList\TaxType;
use Pyrexx\ZUGFeRD\Helper\AnnotationRegistryHelper;
use Pyrexx\ZUGFeRD\Model\Address;
use Pyrexx\ZUGFeRD\Model\AllowanceCharge;
use Pyrexx\ZUGFeRD\Model\Date;
use Pyrexx\ZUGFeRD\Model\Document;
use Pyrexx\ZUGFeRD\Model\Note;
use Pyrexx\ZUGFeRD\Model\Trade\Amount;
use Pyrexx\ZUGFeRD\Model\Trade\CreditorFinancialAccount;
use Pyrexx\ZUGFeRD\Model\Trade\CreditorFinancialInstitution;
use Pyrexx\ZUGFeRD\Model\Trade\Delivery;
use Pyrexx\ZUGFeRD\Model\Trade\Item\LineDocument;
use Pyrexx\ZUGFeRD\Model\Trade\Item\LineItem;
use Pyrexx\ZUGFeRD\Model\Trade\Item\Price;
use Pyrexx\ZUGFeRD\Model\Trade\Item\Product;
use Pyrexx\ZUGFeRD\Model\Trade\Item\Quantity;
use Pyrexx\ZUGFeRD\Model\Trade\Item\SpecifiedTradeAgreement;
use Pyrexx\ZUGFeRD\Model\Trade\Item\SpecifiedTradeDelivery;
use Pyrexx\ZUGFeRD\Model\Trade\Item\SpecifiedTradeMonetarySummation;
use Pyrexx\ZUGFeRD\Model\Trade\Item\SpecifiedTradeSettlement;
use Pyrexx\ZUGFeRD\Model\Trade\MonetarySummation;
use Pyrexx\ZUGFeRD\Model\Trade\PaymentMeans;
use Pyrexx\ZUGFeRD\Model\Trade\PaymentTerms;
use Pyrexx\ZUGFeRD\Model\Trade\Settlement;
use Pyrexx\ZUGFeRD\Model\Trade\Tax\TaxRegistration;
use Pyrexx\ZUGFeRD\Model\Trade\Tax\TradeTax;
use Pyrexx\ZUGFeRD\Model\Trade\Trade;
use Pyrexx\ZUGFeRD\Model\Trade\TradeParty;
use Pyrexx\ZUGFeRD\Model\UnitCode;
use Pyrexx\ZUGFeRD\SchemaValidator;

class BuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @before
     */
    public function setupAnnotationRegistry()
    {
        AnnotationRegistryHelper::registerAutoloadNamespace();
    }

    public function testGetXML()
    {
        $zugferdXML = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<rsm:CrossIndustryDocument xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:rsm="urn:ferd:CrossIndustryDocument:invoice:1p0" xmlns:ram="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12" xmlns:udt="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:15">
  <rsm:SpecifiedExchangedDocumentContext>
    <ram:GuidelineSpecifiedDocumentContextParameter>
      <ram:ID>urn:ferd:CrossIndustryDocument:invoice:1p0:comfort</ram:ID>
    </ram:GuidelineSpecifiedDocumentContextParameter>
  </rsm:SpecifiedExchangedDocumentContext>
  <rsm:HeaderExchangedDocument>
    <ram:ID>RE1337</ram:ID>
    <ram:Name>RECHNUNG</ram:Name>
    <ram:TypeCode>380</ram:TypeCode>
    <ram:IssueDateTime>
      <udt:DateTimeString format="102">20130305</udt:DateTimeString>
    </ram:IssueDateTime>
    <ram:IncludedNote>
      <ram:Content>Test Node 1</ram:Content>
    </ram:IncludedNote>
    <ram:IncludedNote>
      <ram:Content>Test Node 2</ram:Content>
    </ram:IncludedNote>
    <ram:IncludedNote>
      <ram:Content>Easybill GmbH
            Düsselstr. 21
            41564 Kaarst
            
            Geschäftsführer:
            Christian Szardenings
            Ronny Keyser</ram:Content>
      <ram:SubjectCode>REG</ram:SubjectCode>
    </ram:IncludedNote>
  </rsm:HeaderExchangedDocument>
  <rsm:SpecifiedSupplyChainTradeTransaction>
    <ram:ApplicableSupplyChainTradeAgreement>
      <ram:SellerTradeParty>
        <ram:Name>Lieferant GmbH</ram:Name>
        <ram:PostalTradeAddress>
          <ram:PostcodeCode>80333</ram:PostcodeCode>
          <ram:LineOne>Lieferantenstraße 20</ram:LineOne>
          <ram:CityName>München</ram:CityName>
          <ram:CountryID>DE</ram:CountryID>
        </ram:PostalTradeAddress>
        <ram:SpecifiedTaxRegistration>
          <ram:ID schemeID="FC">201/113/40209</ram:ID>
        </ram:SpecifiedTaxRegistration>
        <ram:SpecifiedTaxRegistration>
          <ram:ID schemeID="VA">DE123456789</ram:ID>
        </ram:SpecifiedTaxRegistration>
      </ram:SellerTradeParty>
      <ram:BuyerTradeParty>
        <ram:Name>Kunden AG Mitte</ram:Name>
        <ram:PostalTradeAddress>
          <ram:PostcodeCode>69876</ram:PostcodeCode>
          <ram:LineOne>Hans Muster</ram:LineOne>
          <ram:LineTwo>Kundenstraße 15</ram:LineTwo>
          <ram:CityName>Frankfurt</ram:CityName>
          <ram:CountryID>DE</ram:CountryID>
        </ram:PostalTradeAddress>
      </ram:BuyerTradeParty>
    </ram:ApplicableSupplyChainTradeAgreement>
    <ram:ApplicableSupplyChainTradeDelivery>
      <ram:ActualDeliverySupplyChainEvent>
        <ram:OccurrenceDateTime>
          <udt:DateTimeString format="102">20130305</udt:DateTimeString>
        </ram:OccurrenceDateTime>
      </ram:ActualDeliverySupplyChainEvent>
    </ram:ApplicableSupplyChainTradeDelivery>
    <ram:ApplicableSupplyChainTradeSettlement>
      <ram:PaymentReference>2013-471102</ram:PaymentReference>
      <ram:InvoiceCurrencyCode>EUR</ram:InvoiceCurrencyCode>
      <ram:SpecifiedTradeSettlementPaymentMeans>
        <ram:TypeCode>31</ram:TypeCode>
        <ram:Information>Überweisung</ram:Information>
        <ram:PayeePartyCreditorFinancialAccount>
          <ram:IBANID>DE08700901001234567890</ram:IBANID>
          <ram:AccountName></ram:AccountName>
          <ram:ProprietaryID></ram:ProprietaryID>
        </ram:PayeePartyCreditorFinancialAccount>
        <ram:PayeeSpecifiedCreditorFinancialInstitution>
          <ram:BICID>GENODEF1M04</ram:BICID>
          <ram:GermanBankleitzahlID></ram:GermanBankleitzahlID>
          <ram:Name></ram:Name>
        </ram:PayeeSpecifiedCreditorFinancialInstitution>
      </ram:SpecifiedTradeSettlementPaymentMeans>
      <ram:ApplicableTradeTax>
        <ram:CalculatedAmount currencyID="EUR">19.25</ram:CalculatedAmount>
        <ram:TypeCode>VAT</ram:TypeCode>
        <ram:BasisAmount currencyID="EUR">275.00</ram:BasisAmount>
        <ram:ApplicablePercent>7.00</ram:ApplicablePercent>
      </ram:ApplicableTradeTax>
      <ram:ApplicableTradeTax>
        <ram:CalculatedAmount currencyID="EUR">37.62</ram:CalculatedAmount>
        <ram:TypeCode>VAT</ram:TypeCode>
        <ram:BasisAmount currencyID="EUR">198.00</ram:BasisAmount>
        <ram:ApplicablePercent>19.00</ram:ApplicablePercent>
      </ram:ApplicableTradeTax>
      <ram:SpecifiedTradePaymentTerms>
        <ram:Description>Zahlbar innerhalb von 20 Tagen (bis zum 05.10.2016) unter Abzug von 3% Skonto (Zahlungsbetrag = 1.766,03 €). Bis zum 29.09.2016 ohne Abzug.</ram:Description>
        <ram:DueDateDateTime>
          <udt:DateTimeString format="102">20130404</udt:DateTimeString>
        </ram:DueDateDateTime>
      </ram:SpecifiedTradePaymentTerms>
      <ram:SpecifiedTradeSettlementMonetarySummation>
        <ram:LineTotalAmount currencyID="EUR">198.00</ram:LineTotalAmount>
        <ram:ChargeTotalAmount currencyID="EUR">0.00</ram:ChargeTotalAmount>
        <ram:AllowanceTotalAmount currencyID="EUR">0.00</ram:AllowanceTotalAmount>
        <ram:TaxBasisTotalAmount currencyID="EUR">198.00</ram:TaxBasisTotalAmount>
        <ram:TaxTotalAmount currencyID="EUR">37.62</ram:TaxTotalAmount>
        <ram:GrandTotalAmount currencyID="EUR">235.62</ram:GrandTotalAmount>
        <ram:DuePayableAmount currencyID="EUR">235.62</ram:DuePayableAmount>
      </ram:SpecifiedTradeSettlementMonetarySummation>
    </ram:ApplicableSupplyChainTradeSettlement>
    <ram:IncludedSupplyChainTradeLineItem>
      <ram:AssociatedDocumentLineDocument>
        <ram:LineID>1</ram:LineID>
        <ram:IncludedNote>
          <ram:Content>Testcontent in einem LineDocument</ram:Content>
        </ram:IncludedNote>
      </ram:AssociatedDocumentLineDocument>
      <ram:SpecifiedSupplyChainTradeAgreement>
        <ram:GrossPriceProductTradePrice>
          <ram:ChargeAmount currencyID="EUR">9.9000</ram:ChargeAmount>
          <ram:AppliedTradeAllowanceCharge>
            <ram:ChargeIndicator>
              <udt:Indicator>false</udt:Indicator>
            </ram:ChargeIndicator>
            <ram:ActualAmount currencyID="EUR">1.8000</ram:ActualAmount>
          </ram:AppliedTradeAllowanceCharge>
        </ram:GrossPriceProductTradePrice>
        <ram:NetPriceProductTradePrice>
          <ram:ChargeAmount currencyID="EUR">9.9000</ram:ChargeAmount>
        </ram:NetPriceProductTradePrice>
      </ram:SpecifiedSupplyChainTradeAgreement>
      <ram:SpecifiedSupplyChainTradeDelivery>
        <ram:BilledQuantity unitCode="C62">20.0000</ram:BilledQuantity>
      </ram:SpecifiedSupplyChainTradeDelivery>
      <ram:SpecifiedSupplyChainTradeSettlement>
        <ram:ApplicableTradeTax>
          <ram:TypeCode>VAT</ram:TypeCode>
          <ram:CategoryCode>S</ram:CategoryCode>
          <ram:ApplicablePercent>19.00</ram:ApplicablePercent>
        </ram:ApplicableTradeTax>
        <ram:SpecifiedTradeSettlementMonetarySummation>
          <ram:LineTotalAmount currencyID="EUR">198.00</ram:LineTotalAmount>
        </ram:SpecifiedTradeSettlementMonetarySummation>
      </ram:SpecifiedSupplyChainTradeSettlement>
      <ram:SpecifiedTradeProduct>
        <ram:SellerAssignedID>TB100A4</ram:SellerAssignedID>
        <ram:Name>Trennblätter A4</ram:Name>
      </ram:SpecifiedTradeProduct>
    </ram:IncludedSupplyChainTradeLineItem>
  </rsm:SpecifiedSupplyChainTradeTransaction>
</rsm:CrossIndustryDocument>

XML;


        $doc = new Document(Document::TYPE_COMFORT);
        $doc->getHeader()
            ->setId('RE1337')
            ->setName('RECHNUNG')
            ->setDate(new Date(new \DateTime('20130305'), DateFormat::CALENDAR_DATE))
            ->addNote(new Note('Test Node 1'))
            ->addNote(new Note('Test Node 2'))
            ->addNote(new Note('Easybill GmbH
            Düsselstr. 21
            41564 Kaarst
            
            Geschäftsführer:
            Christian Szardenings
            Ronny Keyser', 'REG'));


        $trade = $doc->getTrade();

        $trade->setDelivery(new Delivery('20130305', DateFormat::CALENDAR_DATE));

        $this->setAgreement($trade);
        $this->setLineItem($trade);
        $this->setSettlement($trade);

        $builder = Builder::create();
        $xml = $builder->getXML($doc);

        $this->assertSame($zugferdXML, $xml);

        SchemaValidator::isValid($xml);
    }

    /**
     * @param Trade $trade
     */
    private function setAgreement(Trade $trade)
    {
        $trade->getAgreement()
            ->setSeller(
                new TradeParty('Lieferant GmbH',
                    new Address('80333', 'Lieferantenstraße 20', null, 'München', Country::GERMANY),
                    array(
                        new TaxRegistration(TaxId::FISCAL_NUMBER, '201/113/40209'),
                        new TaxRegistration(TaxId::VAT, 'DE123456789')
                    )
                )
            )->setBuyer(
                new TradeParty('Kunden AG Mitte',
                    new Address('69876', 'Hans Muster', 'Kundenstraße 15', 'Frankfurt', Country::GERMANY)
                )
            );
    }

    /**
     * @param Trade $trade
     */
    private function setLineItem(Trade $trade)
    {
        $tradeAgreement = new SpecifiedTradeAgreement();

        $grossPrice = new Price(9.90, Currency::EUR, false);
        $grossPrice
            ->addAllowanceCharge(new AllowanceCharge(false, 1.80));

        $tradeAgreement->setGrossPrice($grossPrice);
        $tradeAgreement->setNetPrice(new Price(9.90, Currency::EUR, false));

        $lineItemTradeTax = new TradeTax();
        $lineItemTradeTax->setCode(TaxType::VAT);
        $lineItemTradeTax->setPercent(19.00);
        $lineItemTradeTax->setCategory(TaxCategory::STANDARD);

        $lineItemSettlement = new SpecifiedTradeSettlement();
        $lineItemSettlement
            ->setTradeTax($lineItemTradeTax)
            ->setMonetarySummation(new SpecifiedTradeMonetarySummation(198.00));

        $lineItem = new LineItem();
        $lineItem
            ->setTradeAgreement($tradeAgreement)
            ->setDelivery(new SpecifiedTradeDelivery(new Quantity(UnitCode::PIECE, 20.00)))
            ->setSettlement($lineItemSettlement)
            ->setProduct(new Product('TB100A4', 'Trennblätter A4'))
            ->setLineDocument(new LineDocument('1'))
            ->getLineDocument()
            ->addNote(new Note('Testcontent in einem LineDocument'));

        $trade->addLineItem($lineItem);
    }

    /**
     * @param Trade $trade
     */
    private function setSettlement(Trade $trade)
    {
        $settlement = new Settlement('2013-471102', Currency::EUR);
        $settlement->setPaymentTerms(new PaymentTerms('Zahlbar innerhalb von 20 Tagen (bis zum 05.10.2016) unter Abzug von 3% Skonto (Zahlungsbetrag = 1.766,03 €). Bis zum 29.09.2016 ohne Abzug.', new Date('20130404')));

        $settlement->setPaymentMeans(new PaymentMeans());
        $settlement->getPaymentMeans()
            ->setCode(PaymentMethod::BANK_TRANSFER)
            ->setInformation('Überweisung')
            ->setPayeeAccount(new CreditorFinancialAccount('DE08700901001234567890', '', ''))
            ->setPayeeInstitution(new CreditorFinancialInstitution('GENODEF1M04', '', ''));

        $tradeTax = new TradeTax();
        $tradeTax->setCode(TaxType::VAT);
        $tradeTax->setPercent(7.00);
        $tradeTax->setBasisAmount(new Amount(275.00, Currency::EUR));
        $tradeTax->setCalculatedAmount(new Amount(19.25, Currency::EUR));

        $tradeTax2 = new TradeTax();
        $tradeTax2->setCode(TaxType::VAT);
        $tradeTax2->setPercent(19.00);
        $tradeTax2->setBasisAmount(new Amount(198.00, Currency::EUR));
        $tradeTax2->setCalculatedAmount(new Amount(37.62, Currency::EUR));

        $settlement
            ->addTradeTax($tradeTax)
            ->addTradeTax($tradeTax2)
            ->setMonetarySummation(
                new MonetarySummation(198.00, 0.00, 0.00, 198.00, 37.62, 235.62, 235.62, Currency::EUR)
            );

        $trade->setSettlement($settlement);
    }
}

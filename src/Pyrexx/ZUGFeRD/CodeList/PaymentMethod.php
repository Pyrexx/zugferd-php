<?php

namespace Pyrexx\ZUGFeRD\CodeList;

/**
 * Class PaymentMethod
 *
 * @see https://konik.io/ZUGFeRD-Spezifikation/Das-ZUGFeRD-Format_1p0_c1p0_Codelisten.pdf
 */
class PaymentMethod
{
    const NOT_DEFINED = 1;
    const DEBIT_BY_AUTOMATIC_CLEARING_HOUSE = 3;
    const CASH = 10;
    const CHECK = 20;

    /**
     * International bank transfer and national SEPA-Transfer
     */
    const BANK_TRANSFER = 31;

    const NATIOANL_PRE_SEPA_TRANSFER = 42;
    const CREDIT_CARD =48;
    const DIRECT_DEBIT = 49;

    /**
     * Amounts that two partners owe each other are compensated to avoid unnecessary payments.
     */
    const BALANCE_COMPENSATION = 97;
}

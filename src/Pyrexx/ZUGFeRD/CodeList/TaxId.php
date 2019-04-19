<?php

namespace Pyrexx\ZUGFeRD\CodeList;

/**
 * Class TaxId
 *
 * @see https://konik.io/ZUGFeRD-Spezifikation/Das-ZUGFeRD-Format_1p0_c1p0_Codelisten.pdf
 */
class TaxId
{
    /**
     * VAT identification number (EU).
     */
    const VAT = 'VA';

    /**
     * Fiscal number (national tax registration number).
     */
    const FISCAL_NUMBER = 'FC';
}

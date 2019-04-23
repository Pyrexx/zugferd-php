<?php

namespace Pyrexx\ZUGFeRD\CodeList;

/**
 * Class TaxType
 *
 * @see https://konik.io/ZUGFeRD-Spezifikation/Das-ZUGFeRD-Format_1p0_c1p0_Codelisten.pdf
 */
class TaxType
{
    /**
     * Value added tax.
     */
    const VAT = 'VAT';

    /**
     * Insurance tax. ZUGFeRD Code (temporary).
     */
    const INSURANCE = 'ZF_INSURANCE_TAX';

    /**
     * Tax on replacement part.
     */
    const REPLACEMENT = 'AAJ';
}

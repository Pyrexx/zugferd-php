<?php

namespace Pyrexx\ZUGFeRD\CodeList;

/**
 * Class TaxCategory
 *
 * @see https://konik.io/ZUGFeRD-Spezifikation/Das-ZUGFeRD-Format_1p0_c1p0_Codelisten.pdf
 */
class TaxCategory
{
    /**
     * Standard rate. Valid for regular VAT-rates, e.g. 7 % or 19 % in Germany.
     */
    const STANDARD = 'S';

    /**
     * Intra-Community Supply. Code specifying that the VAT rate
     * is levied from the invoicee for Intra-Community supplies.
     */
    const INTRA_COMMUNITY = 'IC';

    /**
     * Services outside scope of tax.
     */
    const OUTSIDE = 'O';

    /**
     * Zero rated goods.
     */
    const ZERO = 'Z';

    /**
     * Exempt from tax.
     */
    const EXEMPT = 'E';

    /**
     * VAT Reverse Charge. Code specifying that the VAT rate is levied from the invoicee.
     */
    const REVERSE_CHARGE = 'AE';
}

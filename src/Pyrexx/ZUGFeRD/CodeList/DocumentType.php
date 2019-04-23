<?php

namespace Pyrexx\ZUGFeRD\CodeList;

/**
 * Class DocumentType
 *
 * @see https://konik.io/ZUGFeRD-Spezifikation/Das-ZUGFeRD-Format_1p0_c1p0_Codelisten.pdf
 */
class DocumentType
{
    /**
     * Commercial credit notes (Correction of invoices) possible with negative values.
     */
    const COMMERCIAL_INVOICE = '380';

    /**
     * Debit information related to financial adjustments with no rleation to goods and services,
     * also possible with negative values (credit note).
     */
    const DEBIT_NOTE = '84';

    /**
     * Invoicing in self-billing environment.
     */
    const SELF_BILLED_INVOICE = '389';
}

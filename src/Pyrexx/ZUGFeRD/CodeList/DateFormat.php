<?php

namespace Pyrexx\ZUGFeRD\CodeList;

/**
 * Class DateFormat
 *
 * @see https://konik.io/ZUGFeRD-Spezifikation/Das-ZUGFeRD-Format_1p0_c1p0_Codelisten.pdf
 */
class DateFormat
{
    /**
     * YYYYMMDD
     * Calendar date: 20140226 = 26 February 2014
     */
    const CALENDAR_DATE = 102;

    /**
     * YYYYMM
     * Month date: 201406 = June 2014
     */
    const MONTH_DATE = 610;

    /**
     * YYYYWW
     * Week date: 201425 = 25th calendar week in 2014
     */
    const WEEK_DATE = 616;
}

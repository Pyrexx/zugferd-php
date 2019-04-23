<?php namespace Pyrexx\ZUGFeRD\Model;

use JMS\Serializer\Annotation as JMS;
use Pyrexx\ZUGFeRD\CodeList\DateFormat;

class DateTime
{
    /**
     * @var int
     * @JMS\Type("integer")
     * @JMS\XmlAttribute
     */
    private $format;
    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\XmlValue(cdata=false)
     */
    private $time;

    /**
     * DateTime constructor.
     *
     * @param \DateTime|string $time
     * @param int              $format
     */
    public function __construct($time, $format = DateFormat::CALENDAR_DATE)
    {

        if ($format !== DateFormat::CALENDAR_DATE && $format !== DateFormat::MONTH_DATE && $format !== DateFormat::WEEK_DATE) {
            throw new \RuntimeException('Invalid format! Please set it to: '.DateFormat::CALENDAR_DATE.', '.DateFormat::MONTH_DATE.' or '.DateFormat::WEEK_DATE);
        }

        if ($time instanceof \DateTime) {
            $dateTime = $time;
        } else if (is_string($time)) {
            $dateTime = new \DateTime($time);
        } else {
            throw new \RuntimeException('Invalid date! it must be an instance of \DateTime or must be a string!');
        }

        switch ($format) {
            case DateFormat::WEEK_DATE:
                $formatStr = 'YW';
                break;

            case DateFormat::MONTH_DATE:
                $formatStr = 'Ym';
                break;

            case DateFormat::CALENDAR_DATE:
            default:
                $formatStr = 'Ymd';

        }

        $this->time = $dateTime->format($formatStr);
        $this->format = $format;
    }

    /**
     * @return int
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }
}

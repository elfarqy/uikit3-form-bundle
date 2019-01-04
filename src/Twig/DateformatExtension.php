<?php

namespace Elfarqy\Uikit3Bundle;

use \IntlDateFormatter;

/**
 * Class DateformatExtension
 * @author Nils Uliczka
 */
class DateformatExtension extends \Twig_Extension
{

    /**
     * @var Twig
     **/
    protected $twigEnv;

    /**
     * __construct
     * @param mixed $twigEnv
     * @return void
     **/
    public function __construct($twigEnv)
    {
        $this->twigEnv = $twigEnv;
    }

    /**
     * getFunctions
     * @return array
     **/
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('localizeddateformat', array($this, 'getDateformat')),
        );
    }

    /**
     * getDateformat
     * @param string $dateFormat
     * @param string $timeFormat
     * @param string $locale
     * @param string $timezone
     * @param string $format
     * @return string
     **/
    public function getDateformat($dateFormat = 'medium', $timeFormat = 'medium', $locale = null, $timezone = null, $format = null)
    {
        $date = new \DateTime();

        $formatValues = array(
            'none' => IntlDateFormatter::NONE,
            'short' => IntlDateFormatter::SHORT,
            'medium' => IntlDateFormatter::MEDIUM,
            'long' => IntlDateFormatter::LONG,
            'full' => IntlDateFormatter::FULL,
        );

        $formatter = IntlDateFormatter::create(
            $locale,
            $formatValues[$dateFormat],
            $formatValues[$timeFormat],
            $date->getTimezone()->getName(),
            IntlDateFormatter::GREGORIAN,
            $format
        );

        return strtoupper($formatter->getPattern());
    }

    /**
     * getName
     * @return string
     **/
    public function getName()
    {
        return 'r_uikit_dateformat';
    }
}

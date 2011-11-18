<?php

namespace Venues\Domain;

/**
 * Location
 *
 * Represents a geographical location that can be used on his own or can be 
 * asociated with any other domain object. Tipically it will include the 
 * lat/lon and optionally other information.
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

class Location
    implements Location\LocationInterface
{
    /**
     * Radius of the earth
     */
    const RADIUS_OF_EARTH_IN_KM = 6378;

    /**
     * Country codes as per ISO 3166 alpha 2
     *
     * @staticvar Array
     */
    private static $countryCodes = array(
        'AD' => 'ANDORRA',
        'AE' => 'UNITED ARAB EMIRATES',
        'AF' => 'AFGHANISTAN',
        'AG' => 'ANTIGUA AND BARBUDA',
        'AI' => 'ANGUILLA',
        'AL' => 'ALBANIA',
        'AM' => 'ARMENIA',
        'AN' => 'NETHERLANDS ANTILLES',
        'AO' => 'ANGOLA',
        'AQ' => 'ANTARCTICA',
        'AR' => 'ARGENTINA',
        'AS' => 'AMERICAN SAMOA',
        'AT' => 'AUSTRIA',
        'AU' => 'AUSTRALIA',
        'AW' => 'ARUBA',
        'AZ' => 'AZERBAIJAN',
        'BA' => 'BOSNIA AND HERZEGOVINA',
        'BB' => 'BARBADOS',
        'BD' => 'BANGLADESH',
        'BE' => 'BELGIUM',
        'BF' => 'BURKINA FASO',
        'BG' => 'BULGARIA',
        'BH' => 'BAHRAIN',
        'BI' => 'BURUNDI',
        'BJ' => 'BENIN',
        'BM' => 'BERMUDA',
        'BN' => 'BRUNEI DARUSSALAM',
        'BO' => 'BOLIVIA',
        'BR' => 'BRAZIL',
        'BS' => 'BAHAMAS',
        'BT' => 'BHUTAN',
        'BV' => 'BOUVET ISLAND',
        'BW' => 'BOTSWANA',
        'BY' => 'BELARUS',
        'BZ' => 'BELIZE',
        'CA' => 'CANADA',
        'CC' => 'COCOS (KEELING) ISLANDS',
        'CD' => 'CONGO, THE DEMOCRATIC REPUBLIC OF THE',
        'CF' => 'CENTRAL AFRICAN REPUBLIC',
        'CG' => 'CONGO',
        'CH' => 'SWITZERLAND',
        'CI' => 'COTE D\'IVOIRE',
        'CK' => 'COOK ISLANDS',
        'CL' => 'CHILE',
        'CM' => 'CAMEROON',
        'CN' => 'CHINA',
        'CO' => 'COLOMBIA',
        'CR' => 'COSTA RICA',
        'CU' => 'CUBA',
        'CV' => 'CAPE VERDE',
        'CX' => 'CHRISTMAS ISLAND',
        'CY' => 'CYPRUS',
        'CZ' => 'CZECH REPUBLIC',
        'DE' => 'GERMANY',
        'DJ' => 'DJIBOUTI',
        'DK' => 'DENMARK',
        'DM' => 'DOMINICA',
        'DO' => 'DOMINICAN REPUBLIC',
        'DZ' => 'ALGERIA',
        'EC' => 'ECUADOR',
        'EE' => 'ESTONIA',
        'EG' => 'EGYPT',
        'EH' => 'WESTERN SARARA',
        'ER' => 'ERITREA',
        'ES' => 'SPAIN',
        'ET' => 'ETHIOPIA',
        'FI' => 'FINLAND',
        'FJ' => 'FIJI',
        'FK' => 'FALKLAND ISLANDS (MALVINAS)',
        'FM' => 'MICRONESIA, FEDERATED STATES OF',
        'FO' => 'FAROE ISLANDS',
        'FR' => 'FRANCE',
        'GA' => 'GABON',
        'GB' => 'UNITED KINGDOM',
        'GD' => 'GRENADA',
        'GE' => 'GEORGIA',
        'GF' => 'FRENCH GUIANA',
        'GG' => 'GUERNSEY',
        'GH' => 'GHANA',
        'GI' => 'GIBRALTAR',
        'GL' => 'GREENLAND',
        'GM' => 'GAMBIA',
        'GN' => 'GUINEA',
        'GP' => 'GUADELOUPE',
        'GQ' => 'EQUATORIAL GUINEA',
        'GR' => 'GREECE',
        'GS' => 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS',
        'GT' => 'GUATEMALA',
        'GU' => 'GUAM',
        'GW' => 'GUINEA-BISSAU',
        'GY' => 'GUYANA',
        'HK' => 'HONG KONG',
        'HM' => 'HEARD ISLAND AND MCDONALD ISLANDS',
        'HN' => 'HONDURAS',
        'HR' => 'CROATIA',
        'HT' => 'HAITI',
        'HU' => 'HUNGARY',
        'ID' => 'INDONESIA',
        'IE' => 'IRELAND',
        'IL' => 'ISRAEL',
        'IM' => 'ISLE OF MAN',
        'IN' => 'INDIA',
        'IO' => 'BRITISH INDIAN OCEAN TERRITORY',
        'IQ' => 'IRAQ',
        'IR' => 'IRAN, ISLAMIC REPUBLIC OF',
        'IS' => 'ICELAND',
        'IT' => 'ITALY',
        'JE' => 'JERSEY',
        'JM' => 'JAMAICA',
        'JO' => 'JORDAN',
        'JP' => 'JAPAN',
        'KE' => 'KENYA',
        'KG' => 'KYRGYZSTAN',
        'KH' => 'CAMBODIA',
        'KI' => 'KIRIBATI',
        'KM' => 'COMOROS',
        'KN' => 'SAINT KITTS AND NEVIS',
        'KP' => 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF',
        'KR' => 'KOREA, REPUBLIC OF',
        'KW' => 'KUWAIT',
        'KY' => 'CAYMAN ISLANDS',
        'KZ' => 'KAZAKHSTAN',
        'LA' => 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC',
        'LB' => 'LEBANON',
        'LC' => 'SAINT LUCIA',
        'LI' => 'LIECHTENSTEIN',
        'LK' => 'SRI LANKA',
        'LR' => 'LIBERIA',
        'LS' => 'LESOTHO',
        'LT' => 'LITHUANIA',
        'LU' => 'LUXEMBOURG',
        'LV' => 'LATVIA',
        'LY' => 'LIBYAN ARAB JAMABIRIYA',
        'MA' => 'MOROCCO',
        'MC' => 'MONACO',
        'MD' => 'MOLDOVA, REPUBLIC OF',
        'MG' => 'MADAGASCAR',
        'MH' => 'MARSHALL ISLANDS',
        'MK' => 'MACEDONIA, THE FORMER YUGOSLAV REPU8LIC OF',
        'ML' => 'MALI',
        'MM' => 'MYANMAR',
        'MN' => 'MONGOLIA',
        'MO' => 'MACAU',
        'MP' => 'NORTHERN MARIANA ISLANDS',
        'MQ' => 'MARTINIQUE',
        'MR' => 'MAURITANIA',
        'MS' => 'MONTSERRAT',
        'MT' => 'MALTA',
        'MU' => 'MAURITIUS',
        'MV' => 'MALDIVES',
        'MW' => 'MALAWI',
        'MX' => 'MEXICO',
        'MY' => 'MALAYSIA',
        'MZ' => 'MOZAMBIQUE',
        'NA' => 'NAMIBIA',
        'NC' => 'NEW CALEDONIA',
        'NE' => 'NIGER',
        'NF' => 'NORFOLK ISLAND',
        'NG' => 'NIGERIA',
        'NI' => 'NICARAGUA',
        'NL' => 'NETHERLANDS',
        'NO' => 'NORWAY',
        'NP' => 'NEPAL',
        'NU' => 'NIUE',
        'NZ' => 'NEW ZEALAND',
        'OM' => 'OMAN',
        'PA' => 'PANAMA',
        'PE' => 'PERU',
        'PF' => 'FRENCH POLYNESIA',
        'PG' => 'PAPUA NEW GUINEA',
        'PH' => 'PHILIPPINES',
        'PK' => 'PAKISTAN',
        'PL' => 'POLAND',
        'PM' => 'SAINT PIERRE AND MIQUELON',
        'PN' => 'PITCAIRN',
        'PR' => 'PUERTO RICO',
        'PT' => 'PORTUGAL',
        'PW' => 'PALAU',
        'PY' => 'PARAGUAY',
        'QA' => 'QATAR',
        'RE' => 'REUNION',
        'RO' => 'ROMANIA',
        'RS' => 'SERBIA',
        'RU' => 'RUSSIAN FEDERATION',
        'RW' => 'RWANDA',
        'SA' => 'SAUDI ARABIA',
        'SB' => 'SOLOMON ISLANDS',
        'SC' => 'SEYCHELLES',
        'SD' => 'SUDAN',
        'SE' => 'SWEDEN',
        'SG' => 'SINGAPORE',
        'SH' => 'SAINT HELENA',
        'SI' => 'SLOVENIA',
        'SJ' => 'SVALBARD AND JAN MAYEN',
        'SK' => 'SLOVAKIA',
        'SL' => 'SIERRA LEONE',
        'SM' => 'SAN MARINO',
        'SN' => 'SENEGAL',
        'SO' => 'SOMALIA',
        'SR' => 'SURINAME',
        'ST' => 'SAO TOME AND PRINCIPE',
        'SV' => 'EL SALVADOR',
        'SY' => 'SYRIAN ARAB REPUBLIC',
        'SZ' => 'SWAZILAND',
        'TC' => 'TURKS AND CAICOS ISLANDS',
        'TD' => 'CHAD',
        'TF' => 'FRENCH SOUTHERN TERRITORIES',
        'TG' => 'TOGO',
        'TH' => 'THAILAND',
        'TJ' => 'TAJIKISTAN',
        'TK' => 'TOKELAU',
        'TM' => 'TURKMENISTAN',
        'TN' => 'TUNISIA',
        'TO' => 'TONGA',
        'TP' => 'EAST TIMOR',
        'TR' => 'TURKEY',
        'TT' => 'TRINIDAD AND TOBAGO',
        'TV' => 'TUVALU',
        'TW' => 'TAIWAN, PROVINCE OF CHINA',
        'TZ' => 'TANZANIA, UNITED REPUBLIC OF',
        'UA' => 'UKRAINE',
        'UG' => 'UGANDA',
        'UM' => 'UNITED STATES MINOR OUTLYING ISLANDS',
        'US' => 'UNITED STATES',
        'UY' => 'URUGUAY',
        'UZ' => 'UZBEKISTAN',
        'VE' => 'VENEZUELA',
        'VG' => 'VIRGIN ISLANDS, BRITISH',
        'VI' => 'VIRGIN ISLANDS, U.S.',
        'VN' => 'VIET NAM',
        'VU' => 'VANUATU',
        'WF' => 'WALLIS AND FUTUNA',
        'WS' => 'SAMOA',
        'YE' => 'YEMEN',
        'YT' => 'MAYOTTE',
        'YU' => 'YUGOSLAVIA',
        'ZA' => 'SOUTH AFRICA',
        'ZM' => 'ZAMBIA',
        'ZW' => 'ZIMBABWE'
    );

    /**
     * Latitude
     *
     * @var Float
     */
    protected $lat;

    /**
     * Longitude
     *
     * @var Float
     */
    protected $lon;

    /**
     * Address
     *
     * @var String
     */
    protected $address;

    /**
     * Postcode
     *
     * @var String
     */
    protected $postcode;

    /**
     * City
     *
     * @var String
     */
    protected $city;

    /**
     * Country code
     *
     * @var String
     */
    protected $countryCode;

    /**
     * Constructor
     * 
     * @param Float $lat
     * @param Float $lon
     * @param String $address
     * @param String $postcode
     * @param String $city
     * @param String $countryCode
     *
     */
    public function __construct(
        $lat,
        $lon,
        $address = NULL,
        $postcode = NULL,
        $city = NULL,
        $countryCode = NULL
    )
    {
        if (!is_numeric($lat))
        {
            throw new \Venues\Error\BadParameter(
                'Error: Latitude \'' . $lat . '\' requires a numeric value.'
            );
        }

        if (!is_numeric($lon))
        {
            throw new \Venues\Error\BadParameter(
                'Error: Longitude \'' . $lon . '\' requires a numeric value.'
            );
        }


        if (!self::isValidCountryCode($countryCode))
        {
            throw new \Venues\Error\BadParameter(
                'Error: Country code \'' . $countryCode . '\' is not a '
                . 'valid code according to ISO 3166 aplha 2.'
            );
        }

        $this->lat = $lat;
        $this->lon = $lon;
        $this->address = $address;
        $this->postcode = $postcode;
        $this->city = $city;
        $this->countryCode = $countryCode;
    }

    /**
     * Get lat
     *
     * @return Float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Get lon
     *
     * @return Float
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * Get address
     *
     * @return String
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get postcode
     *
     * @return String
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Get city
     *
     * @return String
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get country code
     *
     * @return String
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    // --- public methods
    
    /**
     * Get distance to
     *
     * Method that return the distance on km from the current location 
     * into the $to location.
     *
     * Using the Harvesine formula, extracted from:
     *     http://www.movable-type.co.uk/scripts/latlong.html
     *
     * @param Location $to
     *
     * @return Float Distance from the current location to $to in km.
     */
    public function getDistanceTo(Location $to)
    {
        $dLat = $this->toRadians($to->lat - $this->lat);
        $dLon = $this->toRadians($to->lon - $this->lon);

        $a = pow(sin($dLat / 2), 2) +
            cos($this->toRadians($this->lat)) *           
            cos($this->toRadians($to->lat)) *  
            pow(sin($dLon / 2), 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));                   

        return self::RADIUS_OF_EARTH_IN_KM * $c;                  
    }

    /**
     * Is valid country code?
     *
     * @param String $countryCode
     *
     * @return Boolean
     */
    public static function isValidCountryCode($countryCode)
    {
        if (!is_null($countryCode))
        {
            $countryCode = strtoupper($countryCode);

            if(!isset(self::$countryCodes[$countryCode]))
            {
                return FALSE;
            }
        }

        return TRUE;
    }
    

    // --- private methods
    
    /**
     * To radians
     *
     * Method that transform an angle to radian.
     *
     * @param Float $value 
     *
     * @return Float
     */
    private function toRadians($value)
    {
        return $value * pi() / 180;
    }
}

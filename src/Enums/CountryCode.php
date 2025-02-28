<?php

namespace RolleMarketplace\NagerDateLaravel\Enums;

/**
 * CountryCode Enum
 * 
 * This enum represents the country codes supported by the Nager.Date API.
 * Since PHP 7.0 doesn't support native enums, we're implementing it as a class with constants.
 */
class CountryCode
{
    const AD = 'AD'; // Andorra
    const AL = 'AL'; // Albania
    const AR = 'AR'; // Argentina
    const AT = 'AT'; // Austria
    const AU = 'AU'; // Australia
    const AX = 'AX'; // Åland Islands
    const BA = 'BA'; // Bosnia and Herzegovina
    const BB = 'BB'; // Barbados
    const BE = 'BE'; // Belgium
    const BG = 'BG'; // Bulgaria
    const BJ = 'BJ'; // Benin
    const BO = 'BO'; // Bolivia
    const BR = 'BR'; // Brazil
    const BS = 'BS'; // Bahamas
    const BW = 'BW'; // Botswana
    const BY = 'BY'; // Belarus
    const BZ = 'BZ'; // Belize
    const CA = 'CA'; // Canada
    const CH = 'CH'; // Switzerland
    const CL = 'CL'; // Chile
    const CN = 'CN'; // China
    const CO = 'CO'; // Colombia
    const CR = 'CR'; // Costa Rica
    const CU = 'CU'; // Cuba
    const CY = 'CY'; // Cyprus
    const CZ = 'CZ'; // Czechia
    const DE = 'DE'; // Germany
    const DK = 'DK'; // Denmark
    const DO = 'DO'; // Dominican Republic
    const EC = 'EC'; // Ecuador
    const EE = 'EE'; // Estonia
    const EG = 'EG'; // Egypt
    const ES = 'ES'; // Spain
    const FI = 'FI'; // Finland
    const FO = 'FO'; // Faroe Islands
    const FR = 'FR'; // France
    const GA = 'GA'; // Gabon
    const GB = 'GB'; // United Kingdom
    const GD = 'GD'; // Grenada
    const GG = 'GG'; // Guernsey
    const GI = 'GI'; // Gibraltar
    const GL = 'GL'; // Greenland
    const GM = 'GM'; // Gambia
    const GR = 'GR'; // Greece
    const GT = 'GT'; // Guatemala
    const GY = 'GY'; // Guyana
    const HN = 'HN'; // Honduras
    const HR = 'HR'; // Croatia
    const HT = 'HT'; // Haiti
    const HU = 'HU'; // Hungary
    const ID = 'ID'; // Indonesia
    const IE = 'IE'; // Ireland
    const IM = 'IM'; // Isle of Man
    const IS = 'IS'; // Iceland
    const IT = 'IT'; // Italy
    const JE = 'JE'; // Jersey
    const JM = 'JM'; // Jamaica
    const JP = 'JP'; // Japan
    const KR = 'KR'; // South Korea
    const LI = 'LI'; // Liechtenstein
    const LT = 'LT'; // Lithuania
    const LU = 'LU'; // Luxembourg
    const LV = 'LV'; // Latvia
    const MA = 'MA'; // Morocco
    const MC = 'MC'; // Monaco
    const MD = 'MD'; // Moldova
    const ME = 'ME'; // Montenegro
    const MG = 'MG'; // Madagascar
    const MK = 'MK'; // North Macedonia
    const MT = 'MT'; // Malta
    const MX = 'MX'; // Mexico
    const MZ = 'MZ'; // Mozambique
    const NA = 'NA'; // Namibia
    const NE = 'NE'; // Niger
    const NG = 'NG'; // Nigeria
    const NI = 'NI'; // Nicaragua
    const NL = 'NL'; // Netherlands
    const NO = 'NO'; // Norway
    const NZ = 'NZ'; // New Zealand
    const PA = 'PA'; // Panama
    const PE = 'PE'; // Peru
    const PL = 'PL'; // Poland
    const PR = 'PR'; // Puerto Rico
    const PT = 'PT'; // Portugal
    const PY = 'PY'; // Paraguay
    const RO = 'RO'; // Romania
    const RS = 'RS'; // Serbia
    const RU = 'RU'; // Russia
    const SE = 'SE'; // Sweden
    const SI = 'SI'; // Slovenia
    const SJ = 'SJ'; // Svalbard and Jan Mayen
    const SK = 'SK'; // Slovakia
    const SM = 'SM'; // San Marino
    const SR = 'SR'; // Suriname
    const SV = 'SV'; // El Salvador
    const TN = 'TN'; // Tunisia
    const TR = 'TR'; // Turkey
    const UA = 'UA'; // Ukraine
    const US = 'US'; // United States
    const UY = 'UY'; // Uruguay
    const VA = 'VA'; // Vatican City
    const VE = 'VE'; // Venezuela
    const ZA = 'ZA'; // South Africa
    const ZW = 'ZW'; // Zimbabwe

    /**
     * Get all available country codes
     *
     * @return array
     */
    public static function all(): array
    {
        return [
            self::AD, self::AL, self::AR, self::AT, self::AU, self::AX, self::BA, self::BB,
            self::BE, self::BG, self::BJ, self::BO, self::BR, self::BS, self::BW, self::BY,
            self::BZ, self::CA, self::CH, self::CL, self::CN, self::CO, self::CR, self::CU,
            self::CY, self::CZ, self::DE, self::DK, self::DO, self::EC, self::EE, self::EG,
            self::ES, self::FI, self::FO, self::FR, self::GA, self::GB, self::GD, self::GG,
            self::GI, self::GL, self::GM, self::GR, self::GT, self::GY, self::HN, self::HR,
            self::HT, self::HU, self::ID, self::IE, self::IM, self::IS, self::IT, self::JE,
            self::JM, self::JP, self::KR, self::LI, self::LT, self::LU, self::LV, self::MA,
            self::MC, self::MD, self::ME, self::MG, self::MK, self::MT, self::MX, self::MZ,
            self::NA, self::NE, self::NG, self::NI, self::NL, self::NO, self::NZ, self::PA,
            self::PE, self::PL, self::PR, self::PT, self::PY, self::RO, self::RS, self::RU,
            self::SE, self::SI, self::SJ, self::SK, self::SM, self::SR, self::SV, self::TN,
            self::TR, self::UA, self::US, self::UY, self::VA, self::VE, self::ZA, self::ZW
        ];
    }

    /**
     * Check if the given country code is valid
     *
     * @param string $countryCode
     * @return bool
     */
    public static function isValid(string $countryCode): bool
    {
        return in_array($countryCode, self::all());
    }
}
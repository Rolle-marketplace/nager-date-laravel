<?php

namespace RolleMarketplace\NagerDateLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Support\Collection getAvailableCountries()
 * @method static \Illuminate\Support\Collection getPublicHolidays(int $year, string $countryCode)
 * @method static \Illuminate\Support\Collection getPublicHolidaysWithWeekend(int $year, string $countryCode)
 * @method static bool isPublicHoliday(string $countryCode, int $year, int $month, int $day)
 * @method static \Illuminate\Support\Collection getLongWeekend(int $year, string $countryCode)
 * @method static \RolleMarketplace\NagerDateLaravel\DTOs\CountryDTO getCountryInfo(string $countryCode)
 * @method static bool isWeekend(int $year, int $month, int $day)
 * 
 * @see \RolleMarketplace\NagerDateLaravel\NagerDate
 */
class NagerDate extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'nager-date';
    }
}
<?php

namespace RolleMarketplace\NagerDateLaravel;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use RolleMarketplace\NagerDateLaravel\DTOs\CountryDTO;
use RolleMarketplace\NagerDateLaravel\DTOs\HolidayDTO;
use RolleMarketplace\NagerDateLaravel\DTOs\LongWeekendDTO;
use RolleMarketplace\NagerDateLaravel\DTOs\PublicHolidayDTO;
use RolleMarketplace\NagerDateLaravel\Enums\CountryCode;
use RolleMarketplace\NagerDateLaravel\Exceptions\InvalidCountryCodeException;

class NagerDate
{
    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @var Client
     */
    protected $client;

    /**
     * Create a new NagerDate instance.
     *
     * @param string $baseUrl
     */
    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'http_errors' => false,
        ]);
    }

    /**
     * Get all available countries.
     *
     * @return Collection
     * @throws GuzzleException
     */
    public function getAvailableCountries(): Collection
    {
        $response = $this->client->get('/AvailableCountries');
        $data = json_decode($response->getBody()->getContents(), true);
        
        return collect($data)->map(function ($item) {
            return CountryDTO::fromArray($item);
        });
    }

    /**
     * Get all public holidays for a given year and country.
     *
     * @param int $year
     * @param string $countryCode
     * @return Collection
     * @throws InvalidCountryCodeException|GuzzleException
     */
    public function getPublicHolidays(int $year, string $countryCode): Collection
    {
        $this->validateCountryCode($countryCode);

        $response = $this->client->get("/PublicHolidays/{$year}/{$countryCode}");
        $data = json_decode($response->getBody()->getContents(), true);
        
        return collect($data)->map(function ($item) {
            return PublicHolidayDTO::fromArray($item);
        });
    }

    /**
     * Get all public holidays for a given year and country with the short weekend.
     *
     * @param int $year
     * @param string $countryCode
     * @return Collection
     * @throws InvalidCountryCodeException|GuzzleException
     */
    public function getPublicHolidaysWithWeekend(int $year, string $countryCode): Collection
    {
        $this->validateCountryCode($countryCode);

        $response = $this->client->get("/PublicHolidaysWithWeekend/{$year}/{$countryCode}");
        $data = json_decode($response->getBody()->getContents(), true);
        
        return collect($data)->map(function ($item) {
            return PublicHolidayDTO::fromArray($item);
        });
    }

    /**
     * Check if a given date is a public holiday.
     *
     * @param string $countryCode
     * @param int $year
     * @param int $month
     * @param int $day
     * @return bool
     * @throws InvalidCountryCodeException|GuzzleException
     */
    public function isPublicHoliday(string $countryCode, int $year, int $month, int $day): bool
    {
        $this->validateCountryCode($countryCode);

        $response = $this->client->get("/PublicHoliday/{$countryCode}/{$year}-{$month}-{$day}");
        
        return $response->getStatusCode() === 200;
    }

    /**
     * Get long weekends for a given year and country.
     *
     * @param int $year
     * @param string $countryCode
     * @return Collection
     * @throws InvalidCountryCodeException|GuzzleException
     */
    public function getLongWeekend(int $year, string $countryCode): Collection
    {
        $this->validateCountryCode($countryCode);

        $response = $this->client->get("/LongWeekend/{$year}/{$countryCode}");
        $data = json_decode($response->getBody()->getContents(), true);
        
        return collect($data)->map(function ($item) {
            return LongWeekendDTO::fromArray($item);
        });
    }

    /**
     * Get country info for a given country.
     *
     * @param string $countryCode
     * @return CountryDTO
     * @throws InvalidCountryCodeException|GuzzleException
     */
    public function getCountryInfo(string $countryCode): CountryDTO
    {
        $this->validateCountryCode($countryCode);

        $response = $this->client->get("/CountryInfo/{$countryCode}");
        $data = json_decode($response->getBody()->getContents(), true);
        
        return CountryDTO::fromArray($data);
    }

    /**
     * Check if the given date is a weekend.
     *
     * @param int $year
     * @param int $month
     * @param int $day
     * @return bool
     * @throws GuzzleException
     */
    public function isWeekend(int $year, int $month, int $day): bool
    {
        $response = $this->client->get("/IsWeekend/{$year}-{$month}-{$day}");
        $data = json_decode($response->getBody()->getContents(), true);
        
        return $data ?? false;
    }

    /**
     * Validate the country code.
     *
     * @param string $countryCode
     * @return void
     * @throws InvalidCountryCodeException
     */
    protected function validateCountryCode(string $countryCode)
    {
        if (!CountryCode::isValid($countryCode)) {
            throw new InvalidCountryCodeException("Invalid country code: {$countryCode}");
        }
    }
}
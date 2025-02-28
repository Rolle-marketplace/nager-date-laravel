<?php

namespace RolleMarketplace\NagerDateLaravel\DTOs;

class CountryDTO extends BaseDTO
{
    /**
     * @var string
     */
    public $countryCode;

    /**
     * @var string
     */
    public $name;

    /**
     * Create a new CountryDTO instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->countryCode = $data['countryCode'] ?? null;
        $this->name = $data['name'] ?? null;
    }
}
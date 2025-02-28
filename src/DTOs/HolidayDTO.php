<?php

namespace RolleMarketplace\NagerDateLaravel\DTOs;

class HolidayDTO extends BaseDTO
{
    /**
     * @var string
     */
    public $date;

    /**
     * @var string
     */
    public $localName;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $countryCode;

    /**
     * @var bool
     */
    public $fixed;

    /**
     * @var bool
     */
    public $global;

    /**
     * @var string|null
     */
    public $launchYear;

    /**
     * @var array
     */
    public $types;

    /**
     * @var array|null
     */
    public $counties;

    /**
     * Create a new HolidayDTO instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->date = $data['date'] ?? null;
        $this->localName = $data['localName'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->countryCode = $data['countryCode'] ?? null;
        $this->fixed = $data['fixed'] ?? false;
        $this->global = $data['global'] ?? true;
        $this->launchYear = $data['launchYear'] ?? null;
        $this->types = $data['types'] ?? [];
        $this->counties = $data['counties'] ?? null;
    }
}
<?php

namespace RolleMarketplace\NagerDateLaravel\DTOs;

class LongWeekendDTO extends BaseDTO
{
    /**
     * @var string
     */
    public $startDate;

    /**
     * @var string
     */
    public $endDate;

    /**
     * @var int
     */
    public $dayCount;

    /**
     * @var bool
     */
    public $needBridgeDay;

    /**
     * Create a new LongWeekendDTO instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->startDate = $data['startDate'] ?? null;
        $this->endDate = $data['endDate'] ?? null;
        $this->dayCount = $data['dayCount'] ?? 0;
        $this->needBridgeDay = $data['needBridgeDay'] ?? false;
    }
}
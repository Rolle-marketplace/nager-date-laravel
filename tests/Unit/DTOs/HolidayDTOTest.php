<?php

namespace RolleMarketplace\NagerDateLaravel\Tests\Unit\DTOs;

use PHPUnit\Framework\TestCase;
use RolleMarketplace\NagerDateLaravel\DTOs\HolidayDTO;

class HolidayDTOTest extends TestCase
{
    /** @test */
    public function it_can_be_created_from_array()
    {
        $data = [
            'date' => '2023-01-01',
            'localName' => 'New Year\'s Day',
            'name' => 'New Year\'s Day',
            'countryCode' => 'US',
            'fixed' => true,
            'global' => true,
            'launchYear' => null,
            'types' => ['Public'],
            'counties' => ['US-AL', 'US-AK']
        ];

        $holidayDTO = HolidayDTO::fromArray($data);

        $this->assertInstanceOf(HolidayDTO::class, $holidayDTO);
        $this->assertEquals('2023-01-01', $holidayDTO->date);
        $this->assertEquals('New Year\'s Day', $holidayDTO->localName);
        $this->assertEquals('New Year\'s Day', $holidayDTO->name);
        $this->assertEquals('US', $holidayDTO->countryCode);
        $this->assertTrue($holidayDTO->fixed);
        $this->assertTrue($holidayDTO->global);
        $this->assertNull($holidayDTO->launchYear);
        $this->assertEquals(['Public'], $holidayDTO->types);
        $this->assertEquals(['US-AL', 'US-AK'], $holidayDTO->counties);
    }

    /** @test */
    public function it_can_be_converted_to_array()
    {
        $data = [
            'date' => '2023-01-01',
            'localName' => 'New Year\'s Day',
            'name' => 'New Year\'s Day',
            'countryCode' => 'US',
            'fixed' => true,
            'global' => true,
            'launchYear' => null,
            'types' => ['Public'],
            'counties' => ['US-AL', 'US-AK']
        ];

        $holidayDTO = new HolidayDTO($data);
        $array = $holidayDTO->toArray();

        $this->assertIsArray($array);
        $this->assertEquals('2023-01-01', $array['date']);
        $this->assertEquals('New Year\'s Day', $array['localName']);
        $this->assertEquals('New Year\'s Day', $array['name']);
        $this->assertEquals('US', $array['countryCode']);
        $this->assertTrue($array['fixed']);
        $this->assertTrue($array['global']);
        $this->assertNull($array['launchYear']);
        $this->assertEquals(['Public'], $array['types']);
        $this->assertEquals(['US-AL', 'US-AK'], $array['counties']);
    }

    /** @test */
    public function it_handles_missing_data()
    {
        $data = [
            'date' => '2023-01-01',
            'name' => 'New Year\'s Day',
        ];

        $holidayDTO = new HolidayDTO($data);

        $this->assertEquals('2023-01-01', $holidayDTO->date);
        $this->assertEquals('New Year\'s Day', $holidayDTO->name);
        $this->assertNull($holidayDTO->localName);
        $this->assertNull($holidayDTO->countryCode);
        $this->assertFalse($holidayDTO->fixed);
        $this->assertTrue($holidayDTO->global);
        $this->assertNull($holidayDTO->launchYear);
        $this->assertEquals([], $holidayDTO->types);
        $this->assertNull($holidayDTO->counties);
    }
}
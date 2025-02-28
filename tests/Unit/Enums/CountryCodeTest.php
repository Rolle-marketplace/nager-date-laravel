<?php

namespace RolleMarketplace\NagerDateLaravel\Tests\Unit\Enums;

use PHPUnit\Framework\TestCase;
use RolleMarketplace\NagerDateLaravel\Enums\CountryCode;

class CountryCodeTest extends TestCase
{
    /** @test */
    public function it_can_get_all_country_codes()
    {
        $countryCodesArray = CountryCode::all();

        $this->assertIsArray($countryCodesArray);
        $this->assertNotEmpty($countryCodesArray);
        
        // Check that some common countries are in the list
        $this->assertContains(CountryCode::US, $countryCodesArray);
        $this->assertContains(CountryCode::CA, $countryCodesArray);
        $this->assertContains(CountryCode::GB, $countryCodesArray);
    }

    /** @test */
    public function it_can_validate_country_codes()
    {
        // Valid country codes
        $this->assertTrue(CountryCode::isValid(CountryCode::US));
        $this->assertTrue(CountryCode::isValid(CountryCode::CA));
        $this->assertTrue(CountryCode::isValid(CountryCode::GB));
        
        // Invalid country codes
        $this->assertFalse(CountryCode::isValid('XX'));
        $this->assertFalse(CountryCode::isValid('ZZ'));
        $this->assertFalse(CountryCode::isValid('INVALID'));
    }
}
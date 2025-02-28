<?php

namespace RolleMarketplace\NagerDateLaravel\Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use Orchestra\Testbench\TestCase;
use RolleMarketplace\NagerDateLaravel\DTOs\CountryDTO;
use RolleMarketplace\NagerDateLaravel\DTOs\PublicHolidayDTO;
use RolleMarketplace\NagerDateLaravel\Enums\CountryCode;
use RolleMarketplace\NagerDateLaravel\Exceptions\InvalidCountryCodeException;
use RolleMarketplace\NagerDateLaravel\Facades\NagerDate;
use RolleMarketplace\NagerDateLaravel\NagerDateServiceProvider;

class NagerDateTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            NagerDateServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'NagerDate' => NagerDate::class,
        ];
    }

    /** @test */
    public function it_can_get_available_countries()
    {
        $this->mock_response([
            new Response(200, [], json_encode([
                ['countryCode' => 'US', 'name' => 'United States'],
                ['countryCode' => 'CA', 'name' => 'Canada'],
            ])),
        ]);

        $countries = NagerDate::getAvailableCountries();

        $this->assertInstanceOf(Collection::class, $countries);
        $this->assertCount(2, $countries);
        $this->assertInstanceOf(CountryDTO::class, $countries->first());
        $this->assertEquals('US', $countries->first()->countryCode);
        $this->assertEquals('United States', $countries->first()->name);
    }

    /** @test */
    public function it_can_get_public_holidays()
    {
        $this->mock_response([
            new Response(200, [], json_encode([
                [
                    'date' => '2023-01-01',
                    'localName' => 'New Year\'s Day',
                    'name' => 'New Year\'s Day',
                    'countryCode' => 'US',
                    'fixed' => true,
                    'global' => true,
                    'counties' => null,
                    'launchYear' => null,
                    'types' => ['Public']
                ],
                [
                    'date' => '2023-01-16',
                    'localName' => 'Martin Luther King, Jr. Day',
                    'name' => 'Martin Luther King, Jr. Day',
                    'countryCode' => 'US',
                    'fixed' => false,
                    'global' => true,
                    'counties' => null,
                    'launchYear' => null,
                    'types' => ['Public']
                ],
            ])),
        ]);

        $holidays = NagerDate::getPublicHolidays(2023, CountryCode::US);

        $this->assertInstanceOf(Collection::class, $holidays);
        $this->assertCount(2, $holidays);
        $this->assertInstanceOf(PublicHolidayDTO::class, $holidays->first());
        $this->assertEquals('2023-01-01', $holidays->first()->date);
        $this->assertEquals('New Year\'s Day', $holidays->first()->localName);
    }

    /** @test */
    public function it_can_check_if_date_is_a_public_holiday()
    {
        $this->mock_response([
            new Response(200, [], json_encode(true)),
        ]);

        $isHoliday = NagerDate::isPublicHoliday(CountryCode::US, 2023, 12, 25);

        $this->assertTrue($isHoliday);
    }

    /** @test */
    public function it_throws_exception_for_invalid_country_code()
    {
        $this->expectException(InvalidCountryCodeException::class);

        NagerDate::getPublicHolidays(2023, 'INVALID');
    }

    /**
     * Mock the HTTP responses.
     *
     * @param array $responses
     * @return void
     */
    protected function mock_response(array $responses)
    {
        $mock = new MockHandler($responses);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $this->app->bind('nager-date', function ($app) use ($client) {
            $nagerDate = new \RolleMarketplace\NagerDateLaravel\NagerDate(
                $app['config']['nager-date.base_url']
            );

            // Use reflection to set the protected client property
            $reflection = new \ReflectionClass($nagerDate);
            $property = $reflection->getProperty('client');
            $property->setAccessible(true);
            $property->setValue($nagerDate, $client);

            return $nagerDate;
        });
    }
}
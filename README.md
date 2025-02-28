# Nager.Date Laravel

A Laravel wrapper for the [Nager.Date API](https://date.nager.at/swagger/index.html) that provides information about public holidays and weekend data.

## Requirements

- PHP 7.0 or higher
- Laravel 8.0 or higher
- Guzzle HTTP 7.0 or higher

## Installation

You can install the package via composer:

```bash
composer require rolle-marketplace/nager-date-laravel
```

The package will automatically register its service provider.

You can publish the configuration file with:

```bash
php artisan vendor:publish --provider="RolleMarketplace\NagerDateLaravel\NagerDateServiceProvider" --tag="config"
```

This will publish a `nager-date.php` file in your config directory.

## Usage

### Basic Usage

```php
// Using the facade
use RolleMarketplace\NagerDateLaravel\Facades\NagerDate;
use RolleMarketplace\NagerDateLaravel\Enums\CountryCode;

// Get all public holidays for 2023 in the United States
$holidays = NagerDate::getPublicHolidays(2023, CountryCode::US);

// Check if a specific date is a public holiday
$isHoliday = NagerDate::isPublicHoliday(CountryCode::US, 2023, 12, 25); // Christmas day

// Get all countries available in the API
$countries = NagerDate::getAvailableCountries();

// Check if a specific date is a weekend
$isWeekend = NagerDate::isWeekend(2023, 12, 23); // Saturday
```

### Available Methods

#### Get Available Countries

Returns a Collection of CountryDTO objects with all available countries in the API.

```php
$countries = NagerDate::getAvailableCountries();
```

#### Get Public Holidays

Returns a Collection of PublicHolidayDTO objects with all public holidays for a specific year and country.

```php
$holidays = NagerDate::getPublicHolidays(2023, CountryCode::US);
```

#### Get Public Holidays With Weekend

Returns a Collection of PublicHolidayDTO objects with all public holidays including weekend information.

```php
$holidays = NagerDate::getPublicHolidaysWithWeekend(2023, CountryCode::US);
```

#### Check if a Date is a Public Holiday

Returns a boolean indicating if a specific date is a public holiday in the given country.

```php
$isHoliday = NagerDate::isPublicHoliday(CountryCode::US, 2023, 12, 25);
```

#### Get Long Weekends

Returns a Collection of LongWeekendDTO objects with all long weekends for a specific year and country.

```php
$longWeekends = NagerDate::getLongWeekend(2023, CountryCode::US);
```

#### Get Country Info

Returns a CountryDTO object with information about a specific country.

```php
$countryInfo = NagerDate::getCountryInfo(CountryCode::US);
```

#### Check if a Date is a Weekend

Returns a boolean indicating if a specific date is a weekend.

```php
$isWeekend = NagerDate::isWeekend(2023, 12, 23);
```

## Response DTOs

All API responses are mapped to Data Transfer Objects (DTOs) for easy use:

### CountryDTO

- `countryCode`: string
- `name`: string

### PublicHolidayDTO

- `date`: string (ISO 8601 date format)
- `localName`: string
- `name`: string
- `countryCode`: string
- `fixed`: boolean
- `global`: boolean
- `launchYear`: string|null
- `types`: array

### LongWeekendDTO

- `startDate`: string (ISO 8601 date format)
- `endDate`: string (ISO 8601 date format)
- `dayCount`: integer
- `needBridgeDay`: boolean

## Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
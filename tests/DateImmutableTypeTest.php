<?php

namespace TheTribe\DoctrineDBALDateTimeImmutable\Tests;

use Doctrine\DBAL\Types\Type;
use TheTribe\DoctrineDBALDateTimeImmutable\DateImmutableType;

class DateTest extends TestCase
{
    protected $tz;

    protected function setUp()
    {
        parent::setUp();
        $this->type = Type::getType(DateImmutableType::NAME);
        $this->tz = date_default_timezone_get();
    }

    public function tearDown()
    {
        date_default_timezone_set($this->tz);
    }

    public function testDateConvertsToDatabaseValue()
    {
        $this->assertInternalType('string', $this->type->convertToDatabaseValue(new \DateTimeImmutable(), $this->platform));
    }

    public function testDateConvertsToPHPValue()
    {
        $this->assertInstanceOf('DateTimeImmutable', $this->type->convertToPHPValue('1985-09-01', $this->platform));
    }

    public function testDateResetsNonDatePartsToZeroUnixTimeValues()
    {
        $date = $this->type->convertToPHPValue('1985-09-01', $this->platform);
        $this->assertEquals('00:00:00', $date->format('H:i:s'));
    }

    public function testDateRests_SummerTimeAffection()
    {
        date_default_timezone_set('Europe/Berlin');
        $date = $this->type->convertToPHPValue('2009-08-01', $this->platform);
        $this->assertEquals('00:00:00', $date->format('H:i:s'));
        $this->assertEquals('2009-08-01', $date->format('Y-m-d'));
        $date = $this->type->convertToPHPValue('2009-11-01', $this->platform);
        $this->assertEquals('00:00:00', $date->format('H:i:s'));
        $this->assertEquals('2009-11-01', $date->format('Y-m-d'));
    }
}

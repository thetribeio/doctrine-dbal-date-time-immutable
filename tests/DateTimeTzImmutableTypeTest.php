<?php

namespace TheTribe\DoctrineDBALDateTimeImmutable\Tests;

use Doctrine\DBAL\Types\Type;
use TheTribe\DoctrineDBALDateTimeImmutable\DateTimeTzImmutableType;

class DateTimeImmutableTzTypeTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->type = Type::getType(DateTimeTzImmutableType::NAME);
    }

    public function testDateTimeConvertsToDatabaseValue()
    {
        $date = new \DateTimeImmutable('1985-09-01 10:10:10');
        $expected = $date->format($this->platform->getDateTimeTzFormatString());
        $actual = $this->type->convertToDatabaseValue($date, $this->platform);
        $this->assertEquals($expected, $actual);
    }

    public function testDateTimeConvertsToPHPValue()
    {
        $date = $this->type->convertToPHPValue('1985-09-01 00:00:00', $this->platform);
        $this->assertInstanceOf('DateTimeImmutable', $date);
        $this->assertEquals('1985-09-01 00:00:00', $date->format('Y-m-d H:i:s'));
    }
}

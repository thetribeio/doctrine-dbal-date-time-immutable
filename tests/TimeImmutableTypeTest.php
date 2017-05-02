<?php

namespace TheTribe\DoctrineDBALDateTimeImmutable\Tests;

use Doctrine\DBAL\Types\Type;
use TheTribe\DoctrineDBALDateTimeImmutable\TimeImmutableType;

class TimeImmutableTypeTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->type = Type::getType(TimeImmutableType::NAME);
    }

    public function testTimeConvertsToDatabaseValue()
    {
        $this->assertInternalType('string', $this->type->convertToDatabaseValue(new \DateTimeImmutable(), $this->platform));
    }

    public function testTimeConvertsToPHPValue()
    {
        $this->assertInstanceOf('DateTimeImmutable', $this->type->convertToPHPValue('5:30:55', $this->platform));
    }

    public function testDateFieldResetInPHPValue()
    {
        $time = $this->type->convertToPHPValue('01:23:34', $this->platform);
        $this->assertEquals('01:23:34', $time->format('H:i:s'));
        $this->assertEquals('1970-01-01', $time->format('Y-m-d'));
    }
}

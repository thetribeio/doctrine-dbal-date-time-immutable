<?php

namespace TheTribe\DoctrineDBALDateTimeImmutable\Tests;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractPlatform
     */
    protected $platform;

    /**
     * @var Type
     */
    protected $type;

    protected function setUp()
    {
        $this->platform = $this->getMockForAbstractClass(AbstractPlatform::class);
    }

    public function testInvalidFormatConversion()
    {
        $this->setExpectedException('Doctrine\DBAL\Types\ConversionException');
        $this->type->convertToPHPValue('abcdefg', $this->platform);
    }

    public function testNullConversion()
    {
        $this->assertNull($this->type->convertToPHPValue(null, $this->platform));
    }

    public function testConvertDateTimeToPHPValue()
    {
        $date = new \DateTimeImmutable('now');
        $this->assertSame($date, $this->type->convertToPHPValue($date, $this->platform));
    }
}

<?php

namespace TheTribe\DoctrineDBALDateTimeImmutable;

use Doctrine\DBAL\Types\Type;

Type::addType(DateImmutableType::NAME, DateImmutableType::class);
Type::addType(DateTimeImmutableType::NAME, DateTimeImmutableType::class);
Type::addType(DateTimeTzImmutableType::NAME, DateTimeTzImmutableType::class);
Type::addType(TimeImmutableType::NAME, TimeImmutableType::class);

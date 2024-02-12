<?php

namespace Motorola\Members\Domain\Attributes;

use Spatie\LaravelData\Data;

class MemberData extends Data
{
    public function __construct(
        public string $country,
        public string $region,
        public string $name,
        public string $email,
        public ?int $id = null,
    ) {}
}

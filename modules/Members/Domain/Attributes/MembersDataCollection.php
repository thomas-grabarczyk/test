<?php

namespace Motorola\Members\Domain\Attributes;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class MembersDataCollection extends Data
{
    public function __construct(
        #[DataCollectionOf(MemberData::class)]
        public DataCollection $members
    ) {}
}

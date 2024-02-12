<?php

namespace Motorola\Members\Domain\Attributes;

use Spatie\LaravelData\Data;

class MembersDataCollectionPaginated extends Data
{
    public function __construct(
        public array $paginatedMembers = [],
    ) {}
}

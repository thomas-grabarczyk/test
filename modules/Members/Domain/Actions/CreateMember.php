<?php

namespace Motorola\Members\Domain\Actions;

use Motorola\Members\Domain\Attributes\MemberData;
use Motorola\Members\Infrastructure\Database\MySQL\Models\MemberModel;

class CreateMember
{
    public function __invoke(MemberData $memberData): MemberData
    {
        return MemberData::from(
            MemberModel::create($memberData->toArray())
        );
    }
}

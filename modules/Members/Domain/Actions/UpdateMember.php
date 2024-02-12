<?php

namespace Motorola\Members\Domain\Actions;

use Motorola\Members\Domain\Attributes\MemberData;
use Motorola\Members\Infrastructure\Database\MySQL\Models\MemberModel;

class UpdateMember
{
    public function __invoke(MemberData $memberData): MemberData
    {
        $member = MemberModel::find($memberData->id);
        $member->update($memberData->toArray());

        return MemberData::from(
            $member->toArray()
        );
    }
}

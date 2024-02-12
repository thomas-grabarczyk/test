<?php

namespace Motorola\Members\Domain\Actions;

use Motorola\Members\Domain\Attributes\MemberData;
use Motorola\Members\Infrastructure\Database\MySQL\Models\MemberModel;

class GetMemberById
{
    public function __invoke(int $id): ?MemberData
    {
        $member = MemberModel::find($id);
        if (!$member) {
            return null;
        }

        return MemberData::from($member);
    }
}

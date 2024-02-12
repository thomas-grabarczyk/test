<?php

namespace Motorola\Members\Domain\Actions;

use Motorola\Members\Domain\Attributes\MembersDataCollection;
use Motorola\Members\Infrastructure\Database\MySQL\Models\MemberModel;

class GetAllMembers
{
    public function __invoke(): MembersDataCollection
    {
        return MembersDataCollection::from(['members' => MemberModel::orderBy('id', 'desc')->get()]);
    }
}

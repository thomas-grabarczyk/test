<?php

namespace Motorola\Members\Domain\Actions;

use Motorola\Members\Infrastructure\Database\MySQL\Models\MemberModel;

class DeleteMember
{
    public function __invoke(int $id): void
    {
        MemberModel::find($id)->delete();
    }
}

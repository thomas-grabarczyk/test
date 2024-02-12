<?php

namespace Motorola\Members\Domain\Actions;

use Motorola\Members\Domain\Attributes\MembersDataCollection;
use Motorola\Members\Domain\Attributes\MembersDataCollectionPaginated;
use Motorola\Members\Infrastructure\Database\MySQL\Models\MemberModel;

class GetAllMembersPaginated
{
    public function __invoke(int $paginateBy = 50): MembersDataCollectionPaginated
    {
        return MembersDataCollectionPaginated::from(['paginatedMembers' => MemberModel::paginate($paginateBy)->toArray()]);
    }
}

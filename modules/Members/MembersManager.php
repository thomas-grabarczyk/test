<?php

namespace Motorola\Members;

use Motorola\Members\Domain\Actions\CreateMember;
use Motorola\Members\Domain\Actions\DeleteMember;
use Motorola\Members\Domain\Actions\GetAllMembers;
use Motorola\Members\Domain\Actions\GetAllMembersPaginated;
use Motorola\Members\Domain\Actions\GetMemberById;
use Motorola\Members\Domain\Actions\UpdateMember;
use Motorola\Members\Domain\Attributes\MemberData;
use Motorola\Members\Domain\Attributes\MembersDataCollection;
use Motorola\Members\Domain\Attributes\MembersDataCollectionPaginated;

class MembersManager
{
    public function all(): MembersDataCollection
    {
        return (new GetAllMembers())();
    }

    public function paginated(int $paginatedBy = 50): MembersDataCollectionPaginated
    {
        return (new GetAllMembersPaginated())($paginatedBy);
    }

    public function getById(int $id): ?MemberData
    {
        return (new GetMemberById())($id);
    }

    public function create(MemberData $memberData): MemberData
    {
        return (new CreateMember())($memberData);
    }

    public function update(MemberData $memberData): MemberData
    {
        return (new UpdateMember())($memberData);
    }

    public function delete(int $id): void
    {
        (new DeleteMember())($id);
    }
}

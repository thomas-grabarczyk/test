<?php

namespace Motorola\Members;

use Illuminate\Support\Facades\Facade;
use Motorola\Members\Domain\Attributes\MemberData;
use Motorola\Members\Domain\Attributes\MembersDataCollection;

/**
 * @method static MembersDataCollection all()
 * @method static MembersDataCollection paginated(int $paginatedBy = 50)
 * @method static MemberData|null getById(int $id)
 * @method static MemberData create(MemberData $memberData)
 * @method static MemberData update(MemberData $memberData)
 * @method static void delete(int $id)
 */
class Members extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return'members';
    }
}

<?php

namespace Tests\Unit\modules\Members\Domain\Actions;

use Motorola\Members\Domain\Actions\CreateMember;
use Motorola\Members\Domain\Actions\DeleteMember;
use Motorola\Members\Domain\Attributes\MemberData;
use Tests\TestCase;

class DeleteMemberTest extends TestCase
{
    public function test_it_deletes_a_member(): void
    {
        $memberData = MemberData::from([
            'email' => 'test@mail.com',
            'country' => 'Brazil',
            'region' => 'Rio Grande do Norte',
            'name' => 'Thomas',
        ]);

        $member = (new CreateMember())($memberData);
        $this->assertNotNull($member);

        (new DeleteMember())($member->id);

        $this->assertDatabaseMissing('members', $memberData->toArray());
    }
}

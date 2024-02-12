<?php

namespace Tests\Unit\modules\Members\Domain\Actions;

use Motorola\Members\Domain\Actions\CreateMember;
use Motorola\Members\Domain\Actions\GetMemberById;
use Motorola\Members\Domain\Attributes\MemberData;
use Tests\TestCase;

class GetMemberByIdTest extends TestCase
{
    public function test_it_gets_member_by_id(): void
    {
        $memberData = MemberData::from([
            'name' => 'Thomas',
            'email' => 'test@mail.com',
            'country' => 'Brazil',
           'region' => 'Rio Grande do Norte',
        ]);

        $id = (new CreateMember())($memberData)->id;
        $this->assertDatabaseCount('members', 1);

        $retrievedMember = (new GetMemberById())($id);

        $this->assertNotNull($retrievedMember);
        $this->assertEquals($id, $retrievedMember->id);
        $this->assertEquals('Thomas', $retrievedMember->name);
        $this->assertEquals('test@mail.com', $retrievedMember->email);
        $this->assertEquals('Brazil', $retrievedMember->country);
        $this->assertEquals('Rio Grande do Norte', $retrievedMember->region);
    }

    public function test_it_returns_null_when_member_not_found(): void
    {
        $id = 9999999999;
        $retrievedMember = (new GetMemberById())($id);

        $this->assertNull($retrievedMember);
    }
}

<?php

namespace Tests\Unit\modules\Members\Domain\Actions;

use Motorola\Members\Domain\Actions\CreateMember;
use Motorola\Members\Domain\Attributes\MemberData;
use Motorola\Members\Infrastructure\Database\MySQL\Models\MemberModel;
use Tests\TestCase;

class CreateMemberTest extends TestCase
{
    public function test_it_creates_a_member(): void
    {
        $memberData = MemberData::from([
            'email' => 'test@mail.com',
            'country' => 'Brazil',
            'region' => 'Rio Grande do Norte',
            'name' => 'Thomas',
        ]);

        $member = MemberModel::where('email', '=', $memberData->email)->first();
        $this->assertNull($member);

        $returnedMember = (new CreateMember())($memberData);

        $this->assertNotNull($returnedMember);
        $this->assertNotNull($returnedMember->id);
        $this->assertEquals( 'test@mail.com', $returnedMember->email);
        $this->assertEquals( 'Thomas', $returnedMember->name);
        $this->assertEquals( 'Brazil', $returnedMember->country);
        $this->assertEquals( 'Rio Grande do Norte', $returnedMember->region);
    }
}

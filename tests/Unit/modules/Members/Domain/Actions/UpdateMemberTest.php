<?php

namespace Tests\Unit\modules\Members\Domain\Actions;

use Motorola\Members\Domain\Actions\CreateMember;
use Motorola\Members\Domain\Actions\UpdateMember;
use Motorola\Members\Domain\Attributes\MemberData;
use Tests\TestCase;

class UpdateMemberTest extends TestCase
{
    public function test_it_updates_a_member(): void
    {
        $memberData = MemberData::from([
            'email' => 'test@mail.com',
            'country' => 'Brazil',
            'region' => 'Rio Grande do Norte',
            'name' => 'Thomas',
        ]);

        $oldMember = (new CreateMember())($memberData);
        $this->assertNotNull($oldMember);

        $newMemberData = MemberData::from([
            'id' => $oldMember->id,
            'email' => 'test2@mail.com',
            'country' => 'Brazil2',
            'region' => 'Rio Grande do Norte2',
            'name' => 'Thomas2',
        ]);

        $updated = (new UpdateMember())($newMemberData);

        $this->assertNotNull($updated);
        $this->assertEquals( 'test2@mail.com', $updated->email);
        $this->assertEquals( 'Thomas2', $updated->name);
        $this->assertEquals( 'Brazil2', $updated->country);
        $this->assertEquals( 'Rio Grande do Norte2', $updated->region);
    }
}

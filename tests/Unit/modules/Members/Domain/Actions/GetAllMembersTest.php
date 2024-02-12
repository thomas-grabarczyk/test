<?php

namespace Tests\Unit\modules\Members\Domain\Actions;

use Motorola\Members\Domain\Actions\CreateMember;
use Motorola\Members\Domain\Actions\GetAllMembers;
use Motorola\Members\Domain\Attributes\MemberData;
use Motorola\Members\Domain\Attributes\MembersDataCollection;
use Tests\TestCase;

class GetAllMembersTest extends TestCase
{
    public function test_it_gets_all_members(): void
    {
        $collection = MembersDataCollection::from([
            'members' => [
                MemberData::from([
                    'name' => 'Thomas',
                    'email' => 'test@mail.com',
                    'country' => 'Brazil',
                    'region' => 'Rio Grande do Norte',
                ]),
                MemberData::from([
                    'name' => 'Thomas2',
                    'email' => 'test2@mail.com',
                    'country' => 'Brazil2',
                    'region' => 'Rio Grande do Norte2',
                ]),
                MemberData::from([
                    'name' => 'Thomas3',
                    'email' => 'test3@mail.com',
                    'country' => 'Brazil3',
                   'region' => 'Rio Grande do Norte3',
                    ]
                ),
            ]
        ]);

        $collection->members->each(fn (MemberData $member) => (new CreateMember())($member));
        $this->assertDatabaseCount('members', 3);

        $retrievedCollection = (new GetAllMembers())();

        $this->assertNotNull($retrievedCollection->members);
        $this->assertEquals(3, $retrievedCollection->members->count());
        $this->assertEquals(
            $retrievedCollection->members->except('id')->toArray(),
            $collection->members->except('id')->toArray()
        );
    }

    public function test_it_returns_empty_collection_when_no_members(): void
    {
        $retrievedCollection = (new GetAllMembers())();

        $this->assertNotNull($retrievedCollection->members);
        $this->assertEquals(0, $retrievedCollection->members->count());
    }
}

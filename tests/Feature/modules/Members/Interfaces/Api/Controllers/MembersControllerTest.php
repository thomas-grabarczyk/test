<?php

namespace Feature\modules\Members\Interfaces\Api\Controllers;

use App\Models\User;
use Illuminate\Support\Arr;
use Motorola\Members\Domain\Actions\CreateMember;
use Motorola\Members\Domain\Attributes\MemberData;
use Motorola\Members\Domain\Attributes\MembersDataCollection;
use Tests\TestCase;

class MembersControllerTest extends TestCase
{
    public function test_it_gets_all_members(): void
    {
        $this->getJson('/api/members')->assertStatus(401);

        $collection = MembersDataCollection::from(['members' => [
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
            ]),
        ]]);

        $collection->members->each(fn(MemberData $member) => (new CreateMember())($member));

        $this->be(User::factory()->create());
        $response = $this->json('GET', '/api/members');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'members' => [
                '*' => [
                    'id',
                    'name',
                    'email',
                    'country',
                    'region',
                ]
            ]
        ]);
    }

    public function test_it_returns_empty_collection_when_no_members(): void
    {
        $response = $this->json('GET', '/api/members');
        $this->assertEquals(401, $response->getStatusCode());

        $this->be(User::factory()->create());
        $response = $this->json('GET', '/api/members');

        $response->assertStatus(200);
        $this->assertCount(0, $response->json('members'));
    }

    public function test_it_shows_a_member(): void
    {
        $member = $this->createMember();

        $response = $this->json('GET', '/api/members/' . $member->id);
        $this->assertequals(401, $response->getStatusCode());

        $this->be(User::factory()->create());

        $response = $this->json('GET', '/api/members/' . $member->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($member->toArray(), $response->json());
    }

    public function test_it_stores_a_member(): void
    {
        $member = MemberData::from([
            'name' => 'Thomas',
            'email' => 'test@mail.com',
            'country' => 'Brazil',
            'region' => 'Rio Grande do Norte',
        ]);

        $response = $this->json('POST', '/api/members', $member->toArray());
        $this->assertEquals(401, $response->getStatusCode());

        $this->be(User::factory()->create());

        $response = $this->json('POST', '/api/members', $member->toArray());
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals('success', $response->json('status'));
        $this->assertEquals('Member created successfully', $response->json('message'));

        $this->assertEquals(
            $member->except('id')->toArray(),
            Arr::except($response->json('member'), 'id')
        );
    }

    public function test_it_updates_a_member(): void
    {
        $member = $this->createMember();

        $newMemberData = $member;
        $newMemberData->name = 'Thomas2';
        $newMemberData->email = 'test2@mail.com';
        $newMemberData->country = 'Brazil2';
        $newMemberData->region = 'Rio Grande do Norte2';

        $response = $this->json('PUT', '/api/members/'. $member->id, $newMemberData->toArray());
        $this->assertEquals(401, $response->getStatusCode());

        $this->be(User::factory()->create());

        $response = $this->json('PUT', '/api/members/'. $member->id, $newMemberData->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', $response->json('status'));
        $this->assertEquals('Member updated successfully', $response->json('message'));
        $this->assertEquals(
            $newMemberData->toArray(),
            $response->json('member')
        );
    }

    public function test_it_deletes_a_member(): void
    {
        $member = $this->createMember();

        $response = $this->json('DELETE', '/api/members/'. $member->id);
        $this->assertEquals(401, $response->getStatusCode());

        $this->be(User::factory()->create());

        $response = $this->json('DELETE', '/api/members/'. $member->id);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', $response->json('status'));
        $this->assertEquals('Member deleted successfully', $response->json('message'));
    }

    private function createMember(): MemberData
    {
        $member = MemberData::from([
            'name' => 'Thomas',
            'email' => 'test@mail.com',
            'country' => 'Brazil',
            'region' => 'Rio Grande do Norte',
        ]);

        return (new CreateMember())($member);
    }
}

<?php

namespace Motorola\Members\Infrastructure\Database\MySQL\Seeders;

use Illuminate\Database\Seeder;
use Motorola\Members\Infrastructure\Database\MySQL\Models\MemberModel;

class MembersSeeder extends Seeder
{
    public function run(): void
    {
        $json = file_get_contents(__DIR__. '/members.json');
        $members = json_decode($json, true);
        foreach ($members as $member) {
            MemberModel::create($member);
        }
    }
}

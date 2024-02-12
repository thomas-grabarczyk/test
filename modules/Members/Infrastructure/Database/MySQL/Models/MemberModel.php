<?php

namespace Motorola\Members\Infrastructure\Database\MySQL\Models;

use Illuminate\Database\Eloquent\Model;

class MemberModel extends Model
{
    protected $table ='members';
    protected $fillable = ['country','region', 'name', 'email'];
}

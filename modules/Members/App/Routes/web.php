<?php

use Illuminate\Support\Facades\Route;
use Motorola\Members\Interfaces\Api\Controllers\MembersController;

Route::resource('members', MembersController::class);

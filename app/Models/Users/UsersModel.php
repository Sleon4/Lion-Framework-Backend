<?php

namespace App\Models\Users;

use App\Models\Model;

class UsersModel extends Model {

	public function __construct() {
		$this->init();
	}

	public function createUsersDB(object $user): string {
		return "user '{$user->users_name} {$user->users_last_name}' created successfully";
	}

	public function readUsersDB(): array {
		return [
			(object) [
				'idusers' => 1,
				'users_name' => "Sergio",
				'users_last_name' => "Leon"
			],
			(object) [
				'idusers' => 2,
				'users_name' => "Steve",
				'users_last_name' => "Rogers"
			],
			(object) [
				'idusers' => 3,
				'users_name' => "Peggy",
				'users_last_name' => "Carter"
			],
			(object) [
				'idusers' => 4,
				'users_name' => "Tony",
				'users_last_name' => "Stark"
			],
			(object) [
				'idusers' => 5,
				'users_name' => "Thor",
				'users_last_name' => "Odinson"
			]
		];
	}

 }
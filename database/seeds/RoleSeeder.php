<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use Illuminate\Database\Eloquent\Model;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
	     * Add Roles
	     *
	     */
    	if (Role::where('name', '=', 'Admin')->first() === null) {
	        $adminRole = Role::create([
	            'name' => 'Admin',
	            'slug' => 'admin',
	            'description' => 'Admin Role',
	            'level' => 5,
        	]);
	    }

        
        if (Role::where('name', '=', 'Manager')->first() === null) {
	        $userRole = Role::create([
	            'name' => 'Manager',
	            'slug' => 'manager',
	            'description' => 'Manager Role',
	            'level' => 4,
	        ]);
	    }

    	if (Role::where('name', '=', 'User')->first() === null) {
	        $userRole = Role::create([
	            'name' => 'User',
	            'slug' => 'user',
	            'description' => 'User Role',
	            'level' => 1,
	        ]);
	    }

    	if (Role::where('name', '=', 'Unverified')->first() === null) {
	        $userRole = Role::create([
	            'name' => 'Unverified',
	            'slug' => 'unverified',
	            'description' => 'Unverified Role',
	            'level' => 0,
	        ]);
	    }

    }
}

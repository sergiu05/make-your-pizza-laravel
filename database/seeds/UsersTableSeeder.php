<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        		[
        			'name' => 'admin',
        			'created_at' => Carbon\Carbon::now(),
        			'updated_at' => Carbon\Carbon::now()
		        ],
		        [
		        	'name' => 'user',
        			'created_at' => Carbon\Carbon::now(),
        			'updated_at' => Carbon\Carbon::now()
		        ]
        ]);

        $admin_role_id = DB::table('roles')
        					->select('id')
        					->where('name', 'admin')
        					->first()
        					->id;



        DB::table('users')->insert([
        	'name' => 'admin',
        	'email' => 'admin@example.org',
        	'password' => bcrypt('admin'),
        	'remember_token' => str_random(10),
        	'role_id' => $admin_role_id,
        	'created_at' => Carbon\Carbon::now(),
        	'updated_at' => Carbon\Carbon::now()	
        ]);

        factory(App\User::class, 10)->create()->each(function($u) {
        	//
        });
    }
}

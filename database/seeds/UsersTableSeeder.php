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

        factory(App\User::class, 10)->create()->each(function($u) {
        	//
        });
    }
}

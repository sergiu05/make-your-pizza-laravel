<?php

use Illuminate\Database\Seeder;

class IngredientsAndCategoriesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
    		[
    			'name' => 'Crust',
    			'created_at' => Carbon\Carbon::now(),
    			'updated_at' => Carbon\Carbon::now()
	        ],
	        [
	        	'name' => 'Toppings',
    			'created_at' => Carbon\Carbon::now(),
    			'updated_at' => Carbon\Carbon::now()
	        ],
	        [
	        	'name' => 'Cheeses',
    			'created_at' => Carbon\Carbon::now(),
    			'updated_at' => Carbon\Carbon::now()
	        ],
	        [
	        	'name' => 'Sauces',
    			'created_at' => Carbon\Carbon::now(),
    			'updated_at' => Carbon\Carbon::now()
	        ],
        ]);

        $categories = DB::table('categories')->select('id', 'name')->get();

        $keyed = $categories->keyBy('name')->all();        

        DB::table('ingredients')->insert([
        	[
        		'name' => 'Gluten Free Crust',
        		'price' => 250,
        		'category_id' => $keyed['Crust']->id,
        		'created_at' => Carbon\Carbon::now(),
    			'updated_at' => Carbon\Carbon::now()
        	],
        	[
        		'name' => 'Low Carb Pizza Crust',
        		'price' => 240,
        		'category_id' => $keyed['Crust']->id,
        		'created_at' => Carbon\Carbon::now(),
    			'updated_at' => Carbon\Carbon::now()
        	],
        	[
        		'name' => 'Pizza Dough Mix',
        		'price' => 230,
        		'category_id' => $keyed['Crust']->id,
        		'created_at' => Carbon\Carbon::now(),
    			'updated_at' => Carbon\Carbon::now()
        	],
        	[
        		'name' => 'Sliced Pepperoni',
        		'price' => 125,
        		'category_id' => $keyed['Toppings']->id,
        		'created_at' => Carbon\Carbon::now(),
    			'updated_at' => Carbon\Carbon::now()
        	],
        	[
        		'name' => 'Pre-Cooked Bacon Pieces',
        		'price' => 175,
        		'category_id' => $keyed['Toppings']->id,
        		'created_at' => Carbon\Carbon::now(),
    			'updated_at' => Carbon\Carbon::now()
        	],
        	[
        		'name' => 'Ham',
        		'price' => 155,
        		'category_id' => $keyed['Toppings']->id,
        		'created_at' => Carbon\Carbon::now(),
    			'updated_at' => Carbon\Carbon::now()
        	],
        	[
        		'name' => 'Cooked Beef Topping',
        		'price' => 199,
        		'category_id' => $keyed['Toppings']->id,
        		'created_at' => Carbon\Carbon::now(),
    			'updated_at' => Carbon\Carbon::now()
        	],
        	[
        		'name' => 'Cooked Italian Sausage',
        		'price' => 235,
        		'category_id' => $keyed['Toppings']->id,
        		'created_at' => Carbon\Carbon::now(),
    			'updated_at' => Carbon\Carbon::now()
        	],
        	[
        		'name' => 'Mozzarella',
        		'price' => 95,
        		'category_id' => $keyed['Cheeses']->id,
        		'created_at' => Carbon\Carbon::now(),
    			'updated_at' => Carbon\Carbon::now()
        	],
        	[
        		'name' => 'Parmesa',
        		'price' => 125,
        		'category_id' => $keyed['Cheeses']->id,
        		'created_at' => Carbon\Carbon::now(),
    			'updated_at' => Carbon\Carbon::now()
        	],
        	[
        		'name' => 'Feta',
        		'price' => 105,
        		'category_id' => $keyed['Cheeses']->id,
        		'created_at' => Carbon\Carbon::now(),
    			'updated_at' => Carbon\Carbon::now()
        	],
        	[
        		'name' => 'Asian Wing Sauce',
        		'price' => 135,
        		'category_id' => $keyed['Sauces']->id,
        		'created_at' => Carbon\Carbon::now(),
    			'updated_at' => Carbon\Carbon::now()
        	],
        	[
        		'name' => 'Buffallo Wing Sauce',
        		'price' => 120,
        		'category_id' => $keyed['Sauces']->id,
        		'created_at' => Carbon\Carbon::now(),
    			'updated_at' => Carbon\Carbon::now()
        	]

        ]);
    }
}

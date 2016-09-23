<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Repositories\IngredientRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\HomeController;
use App\Ingredient;

/*
* "Controller tests should verfiy responses, ensure that the correnct database access methods are triggered,
*  and assert that the appropriate instance variables are sent to the view." ("Laravel Testing Decoded", p. 129)
*
* "The process of testing a controller (or any class, really) can be divided into three pieces
*	- Isolate: Mock all dependencies (perhaps excluding the View)
*	- Call: Trigger the desired controller method
*	- Ensure: Perform assertions, verifying that the stage has been set properly" (idem, p. 130)
*
*/

class HomeControllerTest extends TestCase
{
	protected $collection;

	protected $mockedIngredientRepository;

	protected function setUp() {
		parent::setUp();

		# Arrange - create some test products
		$p1 = new Ingredient(['name' => 'Pizza Dough 1', 'price' => 100, 'category_id' => 1, 'image_name' => '']);
		$p1->id = 1; /* "id" is not mass-assignable */		
		$p2 = new Ingredient(['name' => 'Pizza Topping 1', 'price' => 50, 'category_id' => 2, 'image_name' => '']);
		$p2->id = 2;
		$p3 = new Ingredient(['name' => 'Cheese 1', 'price' => 75, 'category_id' => 3, 'image_name' => '']);
		$p3->id = 3;
		$this->collection = new Collection();
		$this->collection->add($p1);
		$this->collection->add($p2);
		$this->collection->add($p3);

		$this->mockedIngredientRepository = Mockery::mock(IngredientRepository::class);
		app()->instance(IngredientRepository::class, $this->mockedIngredientRepository);
	}

	public function tearDown() {
		Mockery::close();
		$this->collection = null;
	}

    public function testCanRetrieveAllProducts()
    {

        # Arrange
        $this->mockedIngredientRepository
        	->shouldReceive('all')
        	->times(1)
        	->andReturn($this->collection);        
        
        # Act	
        $response = $this->action('GET', 'HomeController@index');        
        
        # Assert
        $this->assertResponseOk();
        $this->assertViewHas('ingredients');
        $data = $response->original->getData()['ingredients'];
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $data);
        $this->assertEquals(3, $data->count());

    }


}

<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Ingredient;
use App\Services\Cart;

class CartTest extends TestCase
{
	protected $p1;
	protected $p2;
	protected $p3;

	protected $cart;

	protected function setUp() {

		# Arrange - create some test products
		$this->p1 = new Ingredient(['name' => 'Pizza Dough 1', 'price' => 100, 'category_id' => 1, 'image_name' => '']);
		$this->p1->id = 1; /* "id" is not mass-assignable */		
		$this->p2 = new Ingredient(['name' => 'Pizza Topping 1', 'price' => 50, 'category_id' => 2, 'image_name' => '']);
		$this->p2->id = 2;
		$this->p3 = new Ingredient(['name' => 'Cheese 1', 'price' => 75, 'category_id' => 3, 'image_name' => '']);
		$this->p3->id = 3;

		# Arrange - create a new cart
		$this->cart = new Cart();
	}

    public function testCanAddNewLines() {

    	# Act
    	$this->cart->addItem($this->p1);
    	$this->cart->addItem($this->p2);
    	$this->cart->addItem($this->p3);
    	$results = $this->cart->getLines()->toArray();

    	# Assert
    	$this->assertEquals(3, count($results));
    	$this->assertEquals($results[0]->product, $this->p1);
    	$this->assertEquals($results[1]->product, $this->p2);
    	$this->assertEquals($results[2]->product, $this->p3);

    }

    public function testCanAddQuantitiesForExistingLines() {

    	# Act 
    	$this->cart->addItem($this->p1);
    	$this->cart->addItem($this->p2);
    	$this->cart->addItem($this->p1, 10);
    	$results = $this->cart->getLines()->toArray();


    	# Assert
    	$this->assertEquals(2, count($results));
    	$this->assertTrue(11 == $results[0]->quantity);
    	$this->assertEquals(1, $results[1]->quantity);

    }

    public function testCanRemoveLine() {

    	# Act
    	$this->cart->addItem($this->p1, 1);
    	$this->cart->addItem($this->p2, 3);
    	$this->cart->addItem($this->p3, 5);
    	$this->cart->addItem($this->p2, 1);
    	$this->cart->removeLine($this->p2);

    	# Assert
    	$this->assertTrue(2 == $this->cart->getLines()->count());
    	$this->assertTrue($this->cart->getLines()->contains(function($item, $key) {
    		return $item->product->getId() == $this->p1->getId();
    	}));
    	$this->assertFalse($this->cart->getLines()->contains(function($item, $key) {
    		return $item->product->getId() == $this->p2->getId(); 
    	}));
    	$this->assertTrue($this->cart->getLines()->contains(function($item, $key) {
    		return $item->product->getId() == $this->p3->getId();
    	}));
    }

    public function testCalculateCartTotal() {

    	# Act
    	$this->cart->addItem($this->p1, 1);
    	$this->cart->addItem($this->p2, 1);
    	$this->cart->addItem($this->p1, 3);
    	$result = $this->cart->computeTotalValue();
    	
    	# Assert
    	$this->assertEquals(450, $result);

    }

    public function testCanClearContents() {

    	# Act
    	$this->cart->addItem($this->p1);
    	$this->cart->addItem($this->p3);
    	$this->cart->clear();

    	# Assert
    	$this->assertTrue(0 == $this->cart->getLines()->count());

    }

    protected function tearDown() {

    	$this->p1 = null;
    	$this->p2 = null;
    	$this->p3 = null;

    	$this->cart = null;
    }
}

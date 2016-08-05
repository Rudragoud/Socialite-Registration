<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserOrderList extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $box = ['cat', 'toy', 'torch'];

        $this->assertTrue(in_array('cat',$box));
        $this->assertFalse(in_array('ball',$box));
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MatrixTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMultiply()
    {
        $matrix1 = [[1,2],[4,5]];
        $matrix2 = [[7,5], [3,2]];

        $response = $this->post('/matrix/multiply', ['matrix1' => $matrix1, 'matrix2' => $matrix2]);

        $response
            ->assertStatus(200)
            ->assertJson([["M","I"],["AQ","AD"]]);
    }
}

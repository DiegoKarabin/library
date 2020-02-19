<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Author;
use Carbon\Carbon;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_author_can_be_created()
    {
        $this->withoutExceptionHandling();

        $this->post('/authors', [
            'name' => 'Victor',
            'dob' => '05/14/1988'
        ]);

        $this->assertCount(1, Author::all());
    }

    /** @test */
    public function dob_is_a_carbon_instance()
    {
        $this->withoutExceptionHandling();

        $this->post('/authors', [
            'name' => 'Victor',
            'dob' => '05/14/1988'
        ]);

        $author = Author::first();

        $this->assertInstanceOf(Carbon::class, $author->dob);
        $this->assertEquals('1988/05/14', $author->dob->format('Y/m/d'));
    }
}

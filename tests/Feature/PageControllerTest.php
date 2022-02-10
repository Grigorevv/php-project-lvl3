<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class PageControllerTest extends TestCase
{
    public function testHome()
    {
        $response = $this->get(route('home'));
        $response->assertOk();
    }

}
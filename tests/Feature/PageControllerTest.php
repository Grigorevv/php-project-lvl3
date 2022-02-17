<?php

namespace Tests\Feature;

use Tests\TestCase;

class PageControllerTest extends TestCase
{
    public function testHome()
    {
        $response = $this->get(route('home'));
        $response->assertOk();
    }
}

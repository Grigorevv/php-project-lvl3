<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UrlControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Schema::connection('sqlite')->create('urls', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
    }

    public function testIndex()
    {
        $response = $this->get(route('urls.index'));
        $response->assertOk();
    }

    public function testStore()
    {
        $data = [
            'name' => 'https://mail.ru',
        ];
        $this->id = DB::table('urls')->insertGetId($data);
        $response = $this->post(route('urls.store'), ['url' => $data]);
        $response->assertRedirect(route('urls.show', ['url' =>  $this->id]));
        $response = $this->get(route('urls.show', ['url' => $this->id]));
        $this->assertDatabaseHas('urls', $data);
        $response->assertSessionHasNoErrors();
        $response->assertOk();
        $response->assertSeeText($data['name']);
    }

    public function testShow()
    {
        $data = [
            'name' => 'https://mail.ru',
        ];
        $this->id = DB::table('urls')->insertGetId($data);
        $response = $this->get(route('urls.show', ['url' => $this->id]));
        $response->assertOk();
    }

}


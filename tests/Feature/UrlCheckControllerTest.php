<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UrlCheckControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Schema::connection('sqlite')->create('urls', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('url_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('url_id')->constrained('urls');
            $table->integer('status_code')->nullable();
            $table->string('h1')->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        }
    );
    }

    public function testStore()
    {
        $data = [
            'name' => 'https://mail.ru',
        ];
        $id = DB::table('urls')->insertGetId($data);
        $response = $this->post(route('urls.checks.store', $id));
        $expectedData = [
            'url_id' => $id,
            //'status_code' => 200,
            //'h1' => 'header',
            //'title' => 'example',
           // 'description' => 'description'
        ];

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('url_checks', $expectedData);
    }
}
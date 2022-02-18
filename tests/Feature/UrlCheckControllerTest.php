<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

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

        Schema::create(
            'url_checks',
            function (Blueprint $table) {
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
            'name' => 'http://example.ru',
            'created_at' => Carbon::now(),
        ];

        $id = DB::table('urls')->insertGetId($data);

        $content = '<h1>header</h1> 
        <title>example</title> 
        <meta name="description" content="description">';

        Http::fake([$data['name'] => Http::response($content, 200)]);

        $expectedData = [
            'url_id' => $id,
            'status_code' => 200,
            'h1' => 'header',
            'title' => 'example',
            'description' => 'description'
        ];
        $response = $this->post(route('urls.checks.store', $id));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('url_checks', $expectedData);
    }
}

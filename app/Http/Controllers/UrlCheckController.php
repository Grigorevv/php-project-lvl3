<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use DiDom\Document;
use Illuminate\Http\Client\HttpClientException;

class UrlCheckController extends Controller
{
    public function store(Request $request, $id)
    {
        $url = DB::table('urls')->find($id);

        try {
            $response = Http::get($url->name);
            $status = $response->status();
            $document = new Document($response->body());
            $h1 = optional($document->first('h1'))->text();
            $title = optional($document->first('title'))->text();
            $description = optional($document->first('meta[name=description]'))->getAttribute('content');
            DB::table('url_checks')->insert([
                'url_id' => $id, 'status_code' => $status,
                'title' => $title, 'h1' => $h1,
                'description' => $description,
                'created_at' => Carbon::now()->toDateTimeString()
            ]);
        } catch (HttpClientException $exception) {
            $request->session()->flash('message', $exception->getMessage());
        }
        return redirect()->route('urls.show', ['url' => $id]);
    }
}

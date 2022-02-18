<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function index()
    {
        $urls = DB::table('urls')->paginate(15);
        $lastChecks = DB::table('url_checks')
            ->orderBy('url_id')
            ->latest()
            ->distinct('url_id')
            ->get()
            ->keyBy('url_id');
        return view('url.index', compact('urls', 'lastChecks'));
    }

    public function store(Request $request)
    {
        $data = $request->input('url');
        $validator = Validator::make(
            $data,
            [
                'name' => 'required|url|max:255',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('home')
                ->withErrors($validator)
                ->withInput();
        }

        $normalize = parse_url($data['name']);
        $normUrl['name'] = "{$normalize['scheme']}://{$normalize['host']}";
        /* DB::insert('insert into urls (name, created_at) values (?, ?)',
       [$data['name'], Carbon::now()->toDateTimeString()]); // for heroku */
        $url = DB::table('urls')->where('name', $normUrl['name'])->first();

        if ($url) {
            $request->session()->flash('message', 'Страница уже существует');
            return redirect()->route('urls.show', ['url' => $url->id]);
        }

        DB::table('urls')->insert(['name' => $normUrl['name'], 'created_at' => Carbon::now()->toDateTimeString()]);

        $url = DB::table('urls')->where('name', $normUrl['name'])->first();
        $request->session()->flash('message', 'Страница успешно добавлена');
        return redirect()->route('urls.show', ['url' => $url->id]);
    }

    public function show($id)
    {
        $url = DB::table('urls')->find($id);
        $checks = DB::table('url_checks')->where('url_id', $id)->orderBy('id', 'desc')->get();
        return view('url.show', ['url' => $url, 'checks' => $checks]);
    }
}

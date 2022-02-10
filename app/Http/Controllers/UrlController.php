<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Faker\Factory;


use Illuminate\Http\Request;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urls = DB::table('urls')->get();
        return view('url.index', ['urls' => $urls]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$article = new Article();
        //return view('article.create', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input('url');
        $validator = Validator::make(
            $data, [
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
        //DB::insert('insert into urls (name, created_at) values (?, ?)', [$data['name'], Carbon::now()->toDateTimeString()]); // for heroku
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

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = DB::table('urls')->find($id);
        return view('url.show', ['url' => $url]);
    }
}

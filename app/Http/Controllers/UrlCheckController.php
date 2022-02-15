<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UrlCheckController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        DB::table('url_checks')->insert(['url_id' => $id, 'created_at' => Carbon::now()->toDateTimeString()]);
        return redirect()->route('urls.show', ['url' => $id]);
    }

}

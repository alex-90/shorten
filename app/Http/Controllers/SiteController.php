<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SaveURLRequest;
use App\Models\Link;
use Helper;


class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function send(SaveURLRequest $request)
    {
        $url = $request->input('url');
        $id = Link::create([
            'url' => $url,
            'alias' => '',
        ])->id;

        $alias = Helper::getAliasbyId($id);

        Link::find($id)->update([
            'alias' => $alias,
        ]);

        return response()->json([
            'id' => $id,
            'alias' => $alias,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Item;


class ItemCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return Item::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! request()->name) {
            return [
                'message' => '錯誤',
            ];
        }
        Item::create([
            'name' => request()->name,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reqs = request()->all();
        $item = Item::create([
            'name' => $reqs['item']['name'],
        ]);
        return $item;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reqs = request()->all();
        $existItem = Item::find($id);
        if ($existItem) {
            $existItem->update([
                'completed' => $reqs['item']['completed'] ? true : false,
                'completed_at' => $reqs['item']['completed'] ? Carbon::now() : null,
            ]);
            return $existItem;
        }
        return "item not found.";

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reqs = request()->all();
        $existItem = Item::find($id);
        if ($existItem) {
            $existItem->delete();
            return 'item deleted';
        }
        return "item not found.";

    }
}

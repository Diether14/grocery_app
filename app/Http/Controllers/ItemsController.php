<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Http\Response;

class ItemsController extends Controller
{
    /**
     * Display a listing of items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $req = $request->all();

            $queryString = isset($req['query_string']) ? $req['query_string'] : '';
            $categorySearch = isset($req['category_search']) ? (int)$req['category_search'] : 0;
    
            $items = Item::query();
    
            $items->when($categorySearch, function($query) use ($queryString) {
                $query->whereHas('categories', function($q) use ($queryString) {
                    $q->where('name', 'LIKE', '%' . $queryString . '%')
                        ->orWhere('description', 'LIKE', '%' . $queryString . '%');
                });
            });
    
            $items->when(!$categorySearch, function($query) use ($queryString) {
                $query->where('name', 'LIKE', '%' . $queryString . '%')
                ->orWhere('description', 'LIKE', '%' . $queryString . '%');
            });
    
            $res = $items->get();
    
            return response(json_encode([
                'data' => $res,
                'status' => 201
            ]), 201);
        } catch(\Exception $e) {
            return response(json_encode([
                'data' => [],
                'message' => $e->getMessage(),
                'status' => 500
            ]), 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

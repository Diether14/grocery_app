<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
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
        $req = $request->all();

        $perPage = isset($req['per_page']) ? (int)$req['per_page'] : 10;
        $queryString = isset($req['query_string']) ? $req['query_string'] : '';
        $categorySearch = isset($req['category_search']) ? (int)$req['category_search'] : 0;

        $items = Item::query();

        $items->when($categorySearch, function($query) use ($queryString) {
            $query->whereHas('category', function($q) use ($queryString) {
                $q->where('name', 'LIKE', '%' . $queryString . '%')
                    ->orWhere('description', 'LIKE', '%' . $queryString . '%');
            });
        });

        $items->when(!$categorySearch, function($query) use ($queryString) {
            $query->where('name', 'LIKE', '%' . $queryString . '%')
            ->orWhere('description', 'LIKE', '%' . $queryString . '%');
        });


        $items->paginate($perPage);

        $users->appends([
            'per_page'      => $perPage,
            'query_string'  => $queryString,
            'category_search'  => $categorySearch,
        ]);

        dd($items->get());
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

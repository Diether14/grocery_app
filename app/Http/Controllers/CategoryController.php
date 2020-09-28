<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\Options as OptionCollection;

class CategoryController extends Controller
{
    public function getOptionCollection(Request $request) {
        try {
            $validated = $request->validate([
                'search_string' => ['required', 'min:3', 'string']
            ]);
            $categories = Category::where('name', 'like', '%' . $validated['search_string'] . '%')
                ->get();

            return response(json_encode([
                'code' => 201,
                'data' => OptionCollection::collection($categories)
            ]), 201);

        } catch (\Exception $e) {
            return response(json_encode([
                'code' => 500,
                'data' => $e->getMessage()
            ]), 500);
        }
    }
}

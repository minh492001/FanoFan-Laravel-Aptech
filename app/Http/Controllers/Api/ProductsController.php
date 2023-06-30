<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Images;
use App\Models\Report;
use App\Models\Videos;
use Illuminate\Http\Request;
use App\Models\Fans;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Http\Requests\ProductRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(ProductRequest $request)
    {

    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        $only_one = Fans::find($id);
        return response([$only_one]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(ProductRequest $request, string $id)
    {
        $data = $request->validated();
        Fans::where('id', $id)->update($data);
        return response(['message'=> 'Data updated successfully!'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Fans::where('id', $id)->delete();
        return response()->noContent();
    }
}

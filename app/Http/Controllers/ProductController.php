<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Product::query()->orderBy('id')->get();
        // return new ProductResource(Product::query()->orderBy('id')->paginate(10));
        return new ProductCollection(Product::query()->orderBy('id')->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $productStoreRequest)
    {
        $data = $productStoreRequest->validated();
        $product = Product::create($data);
        return new ProductResource($product);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource(Product::find($product));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $productUpdateRequest, Product $product)
    {
        $data = $productUpdateRequest->validated();
        $updatedData = Product::where('id', $product->id)->first();
        $updatedData->update($data);
        return new ProductResource($updatedData);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $deletedData = Product::where('id', $product->id)->first();
        if (empty($deletedData)) {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
        $deletedData->delete($deletedData);
        return new ProductResource([
            'data' => $deletedData,
            'message' => 'Delete Successfully',
        ]);
    }
}

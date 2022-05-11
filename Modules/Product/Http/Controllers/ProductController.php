<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Http\Requests\PostProductRequest;
use Modules\Product\Http\Requests\UpdateProductRequest;
use Modules\Product\Interface\ProductInterface;

class ProductController extends Controller
{
    private ProductInterface $productRepository;

    public function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return response()->json($this->productRepository->getAllProducts());
    }



    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PostProductRequest $request)
    {
        $product = $this->productRepository->createProduct($request->validated());
        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return response()->json($this->productRepository->getProductById($id));
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = $this->productRepository->updateProduct($id, $request->validated());
        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $product = $this->productRepository->deleteProduct($id);
        return response()->json([
            'message' => 'Product deleted successfully',
            'data' => $product
        ]);
    }
}

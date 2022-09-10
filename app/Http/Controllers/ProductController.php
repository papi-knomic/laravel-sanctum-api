<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\User;
use App\Repository\ProductRepository;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;


class ProductController extends Controller
{

    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository )
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Get all products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();

        return response([
            'message' => 'Products retrieved',
            'status' => true,
            'data' => $products
        ], 200);
    }

    /**
     * Get all active products
     * @return JsonResponse
     */
    public function inactiveProducts()
    {
        $products = $this->productRepository->getInactiveProducts();
        return  Response::successResponseWithData($products, 'Inactive products retrieved');
    }

    /**
     * Get all inactive products
     * @return JsonResponse
     */
    public function activeProducts()
    {
        $products = $this->productRepository->getActiveProducts();
        return  Response::successResponseWithData($products, 'Active products received');
    }

    /**
     * Create a new product.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(StoreProductRequest $request)
    {
        $formFields = $request->validated();
        $product =  $this->productRepository->create($formFields);

        return  Response::successResponseWithData($product, 'Products created', 201 );
    }

    /**
     * Get a specific product.
     */
    public function show(Product $product)
    {
        return  Response::successResponseWithData($product, 'Product retrieved');
    }

    /**
     * Update product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $product
     * @return JsonResponse
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $formFields = $request->validated();
        $product =  $this->productRepository->update($product->id, $formFields);

        return  Response::successResponseWithData($product, 'Product updated');
    }

    /**
     * Delete product.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->productRepository->delete($product->id);
        return  Response::successResponse('Product deleted');
    }

    /**
     * search for a product.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        $products = $this->productRepository->search($name);
        return  Response::successResponseWithData($products, 'Products retrieved');
    }

    /**
     * Get all user products
     * @return JsonResponse
     */
    public function userProducts()
    {
        $userProducts = $this->productRepository->getUserProducts();
        return  Response::successResponseWithData($userProducts, 'Products retrieved for user');
    }

    /**
     * Get all user active products
     * @return JsonResponse
     */
    public function activeUserProducts()
    {
        $userProducts = $this->productRepository->getUserActiveProducts();
        return Response::successResponseWithData($userProducts, 'Active products retrieved for user');
    }

    /**
     * Get all user inactive products
     * @return JsonResponse
     */
    public function inactiveUserProducts()
    {
        $userProducts = $this->productRepository->getUserInactiveProducts();
        return Response::successResponseWithData($userProducts, 'Inactive products retrieved for user');
    }

    /**
     * Get all user products by user id
     * @return JsonResponse
     */
    public function productsByUserID(int $id) {
        $userProducts = $this->productRepository->getProductsByUserID($id);
        return Response::successResponseWithData($userProducts, 'Products retrieved for user');
    }

    /**
     * Get all user active products by user id
     * @return JsonResponse
     */
    public function activeProductsByUserID(int $id) {
        $userProducts = $this->productRepository->getProductsByUserID($id);
        return Response::successResponseWithData($userProducts, 'Products retrieved for user');
    }

    /**
     * Get all user active products by user id
     * @return JsonResponse
     */
    public function inActiveProductsByUserID(int $id) {
        $userProducts = $this->productRepository->getProductsByUserID($id);
        return Response::successResponseWithData($userProducts, 'Products retrieved for user');
    }

    /**
     * Activate a meal
     * @param int $id
     * @return JsonResponse
     */
    public function activateProduct(int $id) {
        $this->productRepository->activateProduct($id);
        return Response::successResponse('Meal activated');
    }

    /**
     * Deactivate a meal
     * @param int $id
     * @return JsonResponse
     */
    public function deactivateProduct(int $id) {
        $this->productRepository->deactivateProduct($id);
        return Response::successResponse('Meal deactivated');
    }

}

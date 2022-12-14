<?php

namespace App\Repository;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Models\User;

class ProductRepository implements ProductRepositoryInterface
{

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update(int $id, array $data)
    {
        $product = Product::find($id);
        $product->update($data);
        return $product;
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function getById(int $id)
    {
        return Product::findOrFail($id);
    }

    public function delete(int $id)
    {
        return Product::find($id)->delete();
    }

    public function getUserProducts()
    {
        $user = auth()->user();
        $userProducts = $user->products;

        return $userProducts;
    }

    public function activateProduct(int $id)
    {
        $product = Product::find($id);
        $product->update(['is_active' => true]);
        return $product;
    }

    public function deactivateProduct(int $id)
    {
        $product = Product::find($id);
        $product->update(['is_active' => false]);
        return $product;
    }

    public function getActiveProducts()
    {
        return Product::isActive(1)->get();
    }

    public function getInactiveProducts()
    {
        return Product::isActive(0)->get();
    }

    public function getUserActiveProducts()
    {
        $user = User::find(auth()->id());
        $products = $user->products()->isActive(1)->get();

        return $products;
    }

    public function getUserInactiveProducts()
    {
        $user = User::find(auth()->id());
        $products = $user->products()->isActive(0)->get();

        return $products;
    }

    public function getProductsByUserID(int $userID)
    {
       $user = User::findOrFail($userID);
       $products = $user->products;

       return $products;
    }

    public function getActiveProductsByUserID(int $userID)
    {
        $user = User::findOrFail($userID);
        $products = $user->products()->isActive(1)->get();
        return $products;
    }

    public function getInactiveProductsByUserID(int $userID)
    {
        $user = User::findOrFail($userID);
        $products = $user->products()->isActive(0)->get();
        return $products;
    }

    public function search(string $search)
    {
        $products =  Product::where('name', 'like', '%'.$search.'%')->get();
        return $products;
    }
}

<?php

namespace App\Repository;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

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
        // TODO: Implement getById() method.
    }

    public function delete(int $id)
    {
        return Product::find($id)->delete();
    }

    public function getUserProducts(int $userID)
    {
//       return Product::where('user', $userID)->user()->products
    }

    public function activateProduct(int $id)
    {
        $meal = Product::find($id);
        $meal->update(['is_active' => true]);
        return $meal;
    }

    public function deactivateProduct(int $id)
    {
        $meal = Product::find($id);
        $meal->update(['is_active' => false]);
        return $meal;
    }
}

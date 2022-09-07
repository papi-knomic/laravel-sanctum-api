<?php

namespace App\Repository;

use App\Models\Product;

class ProductRepository implements \App\Interfaces\ProductRepositoryInterface
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
        // TODO: Implement delete() method.
    }
}

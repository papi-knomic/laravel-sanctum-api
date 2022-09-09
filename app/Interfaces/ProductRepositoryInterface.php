<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function create(array $data);
    public function update(int $id, array $data);
    public function getAll();
    public function getById(int $id);
    public function delete(int $id);
    public function getUserProducts();
    public function getActiveProducts();
    public function getInactiveProducts();
    public function getUserActiveProducts();
    public function getUserInactiveProducts();
    public function getProductsByUserID(int $userID);
    public function getActiveProductsByUserID(int $userID);
    public function getInactiveProductsByUserID(int $userID);
    public function activateProduct(int $id);
    public function deactivateProduct(int $id);
}

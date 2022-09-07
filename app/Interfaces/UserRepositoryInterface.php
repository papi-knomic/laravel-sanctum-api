<?php

namespace App\Interfaces;

interface  UserRepositoryInterface {
    public function register(array $data);
    public function login(array $data);
    public function update(int $id, array $data);
}

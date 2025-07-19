<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getAll() {
        return $this->userRepo->all();
    }

    public function getById($id) {
        return $this->userRepo->find($id);
    }

    public function create($data) {
        return $this->userRepo->create($data);
    }

    public function update($user, $data) {
        return $this->userRepo->update($user, $data);
    }

    public function delete($user) {
        return $this->userRepo->delete($user);
    }
}

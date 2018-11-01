<?php

namespace Domain\User;

class UserService
{
    protected $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function login(array $data = [])
    {
        try {
            return $this->repo->get(1);
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
                'code' => 500
            ];
        }
    }

}

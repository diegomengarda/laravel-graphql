<?php

namespace Domain\User;

use Domain\Base\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }
}

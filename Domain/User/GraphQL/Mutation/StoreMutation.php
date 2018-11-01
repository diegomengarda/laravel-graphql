<?php

namespace Domain\User\GraphQL\Mutation;

use Domain\User\GraphQL\Mutation\Args\ArgsTrait;
use Domain\User\User;
use Domain\User\UserRepository;
use Rebing\GraphQL\Support\Mutation;
use GraphQL;
use Rebing\GraphQL\Support\SelectFields;

class StoreMutation extends Mutation
{
    use ArgsTrait;

    protected $attributes = [
        'name' => 'StoreUser',
        'description' => 'Mutation to store a new User by'
    ];

    protected $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
        parent::__construct();
    }

    public function type()
    {
        return GraphQL::type('users');
    }

    public function args()
    {
        $args = $this->default_args();
        unset($args['id']);
        return array_merge($args, []);
    }

    public function resolve($root, $args)
    {
        $user = $this->repo->store($args);
        if (!$user) {
            return null;
        }
        return $user;
    }
}

<?php

namespace Domain\User\GraphQL\Mutation;

use Domain\User\UserRepository;
use Domain\User\GraphQL\Mutation\Args\ArgsTrait;
use Rebing\GraphQL\Support\Mutation;
use GraphQL;

class UpdateMutation extends Mutation
{
    use ArgsTrait;

    protected $attributes = [
        'name' => 'UpdateUser'
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
        return array_merge($this->default_args(), []);
    }

    public function resolve($root, $args)
    {
        $id = $args['id'];
        unset($args['id']);
        $user = $this->repo->update($args, $id);
        if (!$user) {
            return null;
        }
    }
}

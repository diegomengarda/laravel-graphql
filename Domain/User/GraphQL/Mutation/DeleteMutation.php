<?php

namespace Domain\User\GraphQL\Mutation;

use Domain\User\GraphQL\Mutation\Args\ArgsTrait;
use Domain\User\UserRepository;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL;

class DeleteMutation extends Mutation
{
    use ArgsTrait;

    protected $attributes = [
        'name' => 'DeleteUser',
        'description' => 'Mutation to delete one User by id'
    ];

    protected $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
        parent::__construct();
    }

    public function type()
    {
        return Type::boolean();
    }

    public function args()
    {
        $args = $this->default_args();
        return [
            'id' => $args['id']
        ];
    }

    public function resolve($root, $args)
    {
        $id = $args['id'];
        unset($args['id']);
        return $this->repo->delete($id);
    }
}

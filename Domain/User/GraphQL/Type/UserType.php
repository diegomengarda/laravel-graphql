<?php

namespace Domain\User\GraphQL\Type;

use Domain\User\User;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use GraphQL;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A type',
        'model' => User::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the user'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the user'
            ]
        ];
    }
}

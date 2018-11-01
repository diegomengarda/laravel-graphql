<?php

namespace App\GraphQL\Criteria;

use GraphQL;
use GraphQL\Type\Definition\Type;

trait ArgsQuery
{
    public function global_args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ],
            'limit' => [
                'name' => 'limit',
                'type' => Type::int()
            ],
            'page' => [
                'name' => 'page',
                'type' => Type::int()
            ],
            'filters' => [
                'name' => 'filters',
                'type' => Type::listOf(GraphQL::type('filter'))
            ]
        ];
    }
}
<?php

namespace App\GraphQL\Criteria\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class FilterType extends GraphQLType
{

    protected $inputObject = true;

    protected $attributes = [
        'name' => 'FilterType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'field' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user'
            ],
            'rule' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'value1' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'value2' => [
                'type' => Type::string(),
                'description' => ''
            ]
        ];
    }
}

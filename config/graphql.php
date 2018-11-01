<?php

return [
    'prefix' => 'graphql',
    'routes' => 'query/{graphql_schema?}',
    'controllers' => \Rebing\GraphQL\GraphQLController::class . '@query',
    'middleware' => [],
    'default_schema' => 'default',
    // register query
    'schemas' => [
        'default' => [
            'query' => [
                'users' => \Domain\User\GraphQL\Query\UserQuery::class,
            ],
            'mutation' => [
                'storeUser' => \Domain\User\GraphQL\Mutation\StoreMutation::class,
                'updateUser' => \Domain\User\GraphQL\Mutation\UpdateMutation::class,
                'deleteUser' => \Domain\User\GraphQL\Mutation\DeleteMutation::class
            ],
            'middleware' => []
        ],
    ],
    // register types
    'types' => [
        'filter' => \Domain\Base\GraphQL\Search\Type\FilterType::class,
        'users'  => \Domain\User\GraphQL\Type\UserType::class
    ],
    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],
    'params_key'    => 'variables'
];

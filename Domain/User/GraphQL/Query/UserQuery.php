<?php

namespace Domain\User\GraphQL\Query;

use App\GraphQL\Criteria\ArgsQuery;
use App\GraphQL\Criteria\SearchResolve;
use Domain\User\User;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class UserQuery extends Query
{
    use ArgsQuery;
    use SearchResolve;

    protected $attributes = [
        'name' => 'UserQuery',
        'description' => 'A query of users'
    ];

    protected $searchModel = User::class;

    public function type()
    {
        return GraphQL::paginate('users');
    }

    public function args()
    {
        return array_merge($this->global_args(), []);
    }
}

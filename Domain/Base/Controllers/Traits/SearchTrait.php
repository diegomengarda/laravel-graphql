<?php

namespace Domain\Base\Controllers\Traits;

use Illuminate\Http\Request;

trait SearchTrait
{
    public function search(Request $request)
    {
        $options = $request->only('_limit', '_columns', '_with', '_page');
        return handleResponses($this->repo->search($request->all(), $options));
    }
}

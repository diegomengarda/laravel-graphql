<?php

namespace Domain\Base\Controllers\Traits;

use App;
use Illuminate\Http\Request;

trait AllTrait
{
    /**
     * Get all :item.
     *
     * @return  \Illuminate\Pagination\LengthAwarePaginator
     * @return  \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $request = App::make(Request::class);
        $orders = [];
        $limit = 0;
        //$page = 1;
        if ($request->has('_orders') and is_array($request->get('_orders'))) {
            $orders = $request->get('_orders');
        }

        if ($request->has('_limit')) {
            $limit = $request->get('_limit');
        }

        if ($request->has('_columns')) {
            $this->columns = $request->get('_columns');
            if (!is_array($this->columns)) {
                $this->columns = explode(',', $this->columns);
            }
        }

        if ($request->has('_with')) {
            $this->with = $request->get('_with');
            if (!is_array($this->with)) {
                $this->with = explode(',', $this->with);
            }
        }

        $repo = $this->repo;
        $trash = null;
        if ($request->has('_trash')) {
            $trash = $request->get('_trash');
        }
        switch ($trash) {
            case 'only':
                $repo = $repo->onlyTrashed();
                break;
            case 'with':
                $repo = $repo->withTrashed();
                break;

            default:
                # code...
                break;
        }

        return handleResponses($repo->all($this->columns, $this->with, $orders, $limit));
    }
}

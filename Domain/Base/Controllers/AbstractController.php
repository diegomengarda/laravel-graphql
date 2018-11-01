<?php

namespace Domain\Base\Controllers;

use Illuminate\Container\Container as App;
use Illuminate\Container\Container;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

abstract class AbstractController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Columns default to get and all.
     * @var array
     */
    protected $columns = ['*'];

    /**
     * With relationships.
     * @var array
     */
    protected $with = [];

    /**
     * Load relationships.
     * @var array
     */
    protected $load = [];

    /**
     * Container.
     * @var Container
     */
    protected $app;

    /**
     * Repository.
     * @var \Domain\Base\Repositories\BaseRepository
     */
    protected $repo;

    /**
     * Constructor
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->repo = $this->app->make($this->repo());
    }
}

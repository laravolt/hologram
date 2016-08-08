<?php
namespace Laravolt\Hologram\Http\Controllers;

use Illuminate\Routing\Controller;
use Laravolt\Hologram\Repositories\LogRepositoryInterface;

class HologramController extends Controller
{
    /**
     * @var LogRepositoryInterface
     */
    protected $repository;


    /**
     * HologramController constructor.
     * @param LogRepositoryInterface $repository
     */
    public function __construct(LogRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $collection = $this->repository->paginate();
        $suitable = app('laravolt.suitable');
        return view('hologram::index', compact('collection', 'suitable'));
    }
}

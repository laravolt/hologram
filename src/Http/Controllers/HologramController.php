<?php
namespace Laravolt\Hologram\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laravolt\Hologram\Activity;
use Laravolt\Hologram\Factory;
use Laravolt\Hologram\Repositories\LogRepositoryInterface;

class HologramController extends Controller
{
    ///**
    // * @var LogRepositoryInterface
    // */
    //protected $repository;
    //
    //
    ///**
    // * HologramController constructor.
    // * @param LogRepositoryInterface $repository
    // */
    //public function __construct(LogRepositoryInterface $repository)
    //{
    //    $this->repository = $repository;
    //}
    //
    public function index(Request $request)
    {
        $by = Factory::create($request->get('by_id'), $request->get('by_type'));
        $on = Factory::create($request->get('on_id'), $request->get('on_type'));
        $logs = app('laravolt.hologram')->on($on)->by($by)->getData();

        if(request()->ajax()) {
            return view('hologram::items', compact('logs'));
        }
    }

}

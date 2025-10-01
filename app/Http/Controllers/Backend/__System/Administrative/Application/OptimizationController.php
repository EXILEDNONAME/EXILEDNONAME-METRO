<?php

namespace App\Http\Controllers\Backend\__System\Administrative\Application;

use App\Http\Controllers\Controller;
use App\Http\Traits\Backend\__System\Controllers\Datatable\DefaultController;
use App\Http\Traits\Backend\__System\Controllers\Datatable\ExtensionController;
use \Yajra\DataTables\Facades\DataTables;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Response;

class OptimizationController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['auth', 'verified', 'role:master-administrator'];
    }

    use DefaultController;
    use ExtensionController;

    /**
     **************************************************
     * @return __CONSTRUCT
     **************************************************
     **/

    protected $data, $model, $path, $url;

    function __construct()
    {
        $this->model  = 'App\Models\Backend\__System\Administrative\Application\Optimization';
        $this->path   = 'pages.backend.__system.administrative.application.optimization.';
        $this->url    = '/dashboard/administratives/applications/optimizations';
        $this->data   = $this->model::get();
    }

    /**
     **************************************************
     * @return INDEX
     **************************************************
     **/

    public function index()
    {
        $model = $this->model;
        if (request()->ajax()) {
            return DataTables::of($this->data)
                ->editColumn('date', function ($order) {
                    return empty($order->date) ? NULL : \Carbon\Carbon::parse($order->date)->format('d F Y');
                })
                ->editColumn('date_start', function ($order) {
                    return empty($order->date_start) ? NULL : \Carbon\Carbon::parse($order->date_start)->format('d F Y');
                })
                ->editColumn('date_end', function ($order) {
                    return empty($order->date_end) ? NULL : \Carbon\Carbon::parse($order->date_end)->format('d F Y');
                })
                ->editColumn('description', function ($order) {
                    return $order->description;
                })
                ->addIndexColumn()->make(true);
        }
        return view($this->path . 'index', compact('model'));
    }

    /**
     **************************************************
     * @return OPTIMIZE
     **************************************************
     **/

    public function start_optimizing($id)
    {
        if ($id == 1) {
            $data_1 = Artisan::call('optimize:clear');
            $data_2 = Artisan::call('config:clear');
            return Response::json([$data_1, $data_2]);
        }
        if ($id == 3) {
            $data = Artisan::call('cache:clear');
            return Response::json($data);
        }
        if ($id == 2) {
            $data = system('composer dump-autoload');
            return Response::json($data);
        }
    }
}

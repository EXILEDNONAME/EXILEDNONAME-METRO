<?php

namespace App\Http\Controllers\Backend\__System\Administrative;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Response;

class SessionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['auth', 'verified', 'role:master-administrator'];
    }
    
    /**
     **************************************************
     * @return __CONSTRUCT
     **************************************************
     **/

    protected $data, $model, $path, $url;

    function __construct()
    {
        $this->model = 'App\Models\Backend\__System\Administrative\Session';
        $this->path = 'pages.backend.__system.administrative.session.';
        $this->url = '/dashboard/administratives/sessions';
        $this->data = $this->model::get();
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
                ->editColumn('avatar', function ($order) {
                    if (!empty($order->user_id)) {
                        $data = \App\Models\User::where('id', $order->user_id)->where('avatar', '!=', '')->first();
                        if (!empty($data)) {
                            return '<div class="symbol symbol-lg-35 symbol-30 symbol-circle symbol-light-success" bis_skin_checked="1"><img src="' . env("APP_URL") . '/storage/avatar/' . $order->user_id . "/" . $data->avatar . '"></div>';
                        } else {
                            return '<div class="symbol symbol-lg-35 symbol-30 symbol-circle symbol-light-success" bis_skin_checked="1"><img src="' . env("APP_URL") . '/assets/backend/media/users/blank.png"></div>';
                        }
                    }
                })
                ->editColumn('user_id', function ($order) {
                    if (!empty($order->user_id)) {
                        $data = \App\Models\User::where('id', $order->user_id)->first();
                        return $data->name . '<br>' . $data->email . '<br>' . $data->phone;
                    }
                })
                ->editColumn('last_activity', function ($order) {
                    $data = $order->last_activity;
                    $datetime = date("d F Y, H:i:s", $data);
                    return $datetime;
                })
                ->rawColumns(['user_id', 'avatar'])
                ->addIndexColumn()->make(true);
        }
        return view($this->path . 'index', compact('model'));
    }

    /**
     **************************************************
     * @return RESET
     **************************************************
     **/

    public function reset()
    {
        $data = $this->model::truncate();
        return Response::json($data);
    }
}

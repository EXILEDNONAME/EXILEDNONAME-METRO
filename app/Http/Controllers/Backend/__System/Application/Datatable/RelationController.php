<?php

namespace App\Http\Controllers\Backend\__System\Application\Datatable;

use App\Http\Controllers\Controller;
use App\Http\Traits\Backend\__System\Controllers\Datatable\DefaultController;
use App\Http\Traits\Backend\__System\Controllers\Datatable\ExtensionController;
use App\Http\Traits\HandlesFormRequest;
use Illuminate\Routing\Controllers\HasMiddleware;

use App\Http\Requests\Backend\__System\Application\Datatable\Relation\StoreRequest;
use App\Http\Requests\Backend\__System\Application\Datatable\Relation\UpdateRequest;

class RelationController extends Controller implements HasMiddleware
{
    /**
     **************************************************
     * @return MIDDLEWARE
     **************************************************
     **/

    public static function middleware(): array
    {
        return [];
    }

    /**
     **************************************************
     * @return CONSTRUCT
     **************************************************
     **/

    public function __construct()
    {
        $this->model            = 'App\Models\Backend\__System\Application\Datatable\Relation';
        $this->path             = 'pages.backend.__system.application.datatable.relation.';
        $this->url              = '/dashboard/applications/datatables/relations';
        $this->sort             = '1, desc';
        $this->status           = 'default';

        $this->table_relation_1 = function ($datatable) {
            return $datatable->editColumn('id_table_general', function ($order) {
                return $order->application_table_general->name ?? '-';
            });
        };

        app()->instance('current.model', $this->model);
        app()->instance('current.url', $this->url);
    }

    use DefaultController;
    use ExtensionController;
    use HandlesFormRequest;

    public function store(StoreRequest $request) {}
    public function update(UpdateRequest $request, $id) {}
}

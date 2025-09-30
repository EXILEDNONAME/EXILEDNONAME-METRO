<?php

namespace App\Traits\Backend\__System\Controllers\Datatable;

trait DefaultController
{
    // CONTROLLER DEFAULTS
    use \App\Traits\Backend\__System\Controllers\Datatable\Default\IndexController;
    use \App\Traits\Backend\__System\Controllers\Datatable\Default\ShowController;
    use \App\Traits\Backend\__System\Controllers\Datatable\Default\CreateController;
    use \App\Traits\Backend\__System\Controllers\Datatable\Default\EditController;
    use \App\Traits\Backend\__System\Controllers\Datatable\Default\DestroyController;
}

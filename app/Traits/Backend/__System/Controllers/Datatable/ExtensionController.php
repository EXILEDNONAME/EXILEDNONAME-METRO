<?php

namespace App\Traits\Backend\__System\Controllers\Datatable;

trait ExtensionController
{
    // CONTROLLER EXTENSIONS
    use \App\Traits\Backend\__System\Controllers\Datatable\Extension\ActiveController;
    use \App\Traits\Backend\__System\Controllers\Datatable\Extension\ChartController;
    use \App\Traits\Backend\__System\Controllers\Datatable\Extension\InactiveController;
    use \App\Traits\Backend\__System\Controllers\Datatable\Extension\SelectedActiveController;
    use \App\Traits\Backend\__System\Controllers\Datatable\Extension\SelectedInactiveController;
    use \App\Traits\Backend\__System\Controllers\Datatable\Extension\DeleteController;
    use \App\Traits\Backend\__System\Controllers\Datatable\Extension\DeletePermanentController;
    use \App\Traits\Backend\__System\Controllers\Datatable\Extension\ResetPasswordController;
    use \App\Traits\Backend\__System\Controllers\Datatable\Extension\ResetPasswordSingleController;
    use \App\Traits\Backend\__System\Controllers\Datatable\Extension\RestoreController;
    use \App\Traits\Backend\__System\Controllers\Datatable\Extension\SelectedDeleteController;
    use \App\Traits\Backend\__System\Controllers\Datatable\Extension\SelectedDeletePermanentController;
    use \App\Traits\Backend\__System\Controllers\Datatable\Extension\SelectedRestoreController;

    // CONTROLLER PAGES
    use \App\Traits\Backend\__System\Controllers\Datatable\Extension\ActivityController;
    use \App\Traits\Backend\__System\Controllers\Datatable\Extension\TrashController;
}

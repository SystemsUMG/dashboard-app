<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $status = [
        0 => '<span title="No puede acceder al sistema" class="badge bg-danger hover">Inactivo</span>',
        1 => '<span title="Habilitado en el sistema" class="badge bg-success hover">Activo</span>'
    ];


}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public string $message;
    public int $status_code;
    public array $response;
    public array $statuses;
    public string $response_type;
    public function __construct()
    {
        $this->message = 'Ha ocurrido un error';
        $this->status_code = 400;
        $this->response = [];
        $this->response_type = 'error';
        $this->statuses = [
            0 => '<span title="No puede acceder al sistema" class="badge bg-danger hover">Inactivo</span>',
            1 => '<span title="Habilitado en el sistema" class="badge bg-success hover">Activo</span>'
        ];
    }

    public function connection()
    {
        $connection = Session::get('connection');
        return $connection ?? 'mysql';
    }

    public function listData($request, $data) {
        $server_side = [
            'search'    => $request->search['value'] ?? '',
            'limit_val' => $request->length,
            'start_val' => $request->start,
            'order_val' => $request->columns[$request->order[0]['column']]['data'],
            'dir_val'   => $request->order[0]['dir'],
        ];

        $recordsTotal = $data->count();
        $filtered = $data->search($server_side['search'])->orderBy($server_side['order_val'], $server_side['dir_val']);
        $recordsFiltered = $filtered->count();
        $filtered_data = $filtered->offset($server_side['start_val'])->limit($server_side['limit_val'])->get();

        return [
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data'            => $filtered_data,
        ];
    }
}

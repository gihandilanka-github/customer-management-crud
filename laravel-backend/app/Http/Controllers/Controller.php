<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $response_status_code = API_RES_STATUS_SUCCESS;
    protected $data = null;
    protected $status = false;
    protected $msg = '';
    /**
     * Handle API response type
     *
     * @param array $response
     * @param int $status_code
     * @param bool $status
     * @param string $msg
     * @return ResponseFactory|Response
     */
    public function apiResponse($response=[],$status_code = API_RES_STATUS_SUCCESS, $status=false, $msg ='')
    {
        Log::write('info', '', []);
        Log::write('info', 'info', ['Main Controller :=============================START=================================']);
        Log::write('info', 'info', ['Client IP'=>json_encode(request()->ip())]);

        if(getLoggedInUser()){
            Log::write('info', 'info', ['Current logged in user'=>json_encode(getLoggedInUser()->id)]);
        }

        Log::write('info', 'info', ['Route'=>json_encode(request()->route())]);
        Log::write('info', 'info', ['Headers'=>json_encode(request()->headers->all())]);
        Log::write('info', 'info', ['request'=>json_encode(request()->all())]);
        Log::write('info', 'info', ['response'=>json_encode($response)]);
        Log::write('info', 'info', ['Main Controller :==============================END==================================']);
        return response(['data'=>$response, 'status' => $status, 'msg' => $msg],$status_code)->header('Content-Type', 'application/json');
    }
}

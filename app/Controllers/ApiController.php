<?php

namespace App\Controllers;

use Support\BaseController;
use Support\Http;
use Support\Request;
use Support\Response;
use Support\Validator;
use Support\View;
use Support\CSRFToken;

class ApiController extends BaseController
{
    // Controller logic here
    public function DataApiNama(Request $request)
    {
        $emp = $request->nik;
        try{
            $api = Http::get(env('API_EMP').$emp.'&api_key='.env('API_KEY'));
            if($api !== null)
            {
                $data = $api['response']['0'];
                return Response::json($data);
            }
            return Response::json([]);
        } catch(\Exception $e){
            return Response::json(['error'=>$e->getMessage()],500);
        }
    }

    public function DataApiDept(Request $request)
    {
        $emp = $request->nik;
        $key = 'P@55W0RD';
        try{
            $api = Http::get(env('API_EMP').$emp.'&api_key='.$key);
            if($api !== null)
            {
                return Response::json($api['response']['0']);
            }
            return Response::json([]);
        } catch(\Exception $e){
            return Response::json(['error'=>$e->getMessage()],500);
        }
    }
    
    public function DataApiSect(Request $request)
    {
        $emp = $request->nik;
        $key = 'P@55W0RD';
        try{
            $api = Http::get(env('API_EMP').$emp.'&api_key='.$key);
            if($api !== null)
            {
                return Response::json($api['response']['0']);
            }
            return Response::json([]);
        } catch(\Exception $e){
            return Response::json(['error'=>$e->getMessage()],500);
        }
    }
}

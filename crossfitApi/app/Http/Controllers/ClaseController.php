<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use Illuminate\Http\Request;
use App\Libs\ResultResponse;

class ClaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clase = Clase::all();
        $resultResponse = new ResultResponse();
        $resultResponse->setData($clase);
        $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
        $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        return response()->json($resultResponse);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $resultResponse = new ResultResponse();
        try {
            $newClase = new Clase([
                'cl_nombre' => $request->get('cl_nombre'),
                'cl_fecha' => $request->get('cl_fecha'),
                'cl_hora' => $request->get('cl_hora'),
                'cl_maximo' => $request->get('cl_maximo'),
                'cl_actual' => $request->get('cl_actual'),
                'cl_rt_code' => $request->get('cl_rt_code'),
            ]);
            $newClase->save();
            $resultResponse->setData($newClase);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }
        return response()->json($resultResponse);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $resultResponse = new ResultResponse();
        try {
            $clase = Clase::findOrFail($id);
            $resultResponse->setData($clase);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }
        return response()->json($resultResponse);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, $id)
    {
        $resultResponse = new ResultResponse();

        try {
            $clase = Clase::findOrFail($id);
            $clase->cl_nombre = $request->get('cl_nombre', $clase->cl_nombre);
            $clase->cl_fecha = $request->get('cl_fecha', $clase->cl_fecha);
            $clase->cl_hora = $request->get('cl_hora', $clase->cl_hora);
            $clase->cl_maximo = $request->get('l_maximo', $clase->l_maximo);
            $clase->cl_actual = $request->get('cl_actual', $clase->cl_actual);
            $clase->cl_rt_code = $request->get('cl_rt_code', $clase->cl_rt_code);
            $clase->save();
            $resultResponse->setData($clase);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }
        return response()->json($resultResponse);
    }

    /**
     * Update the specified resource in storage.
     */
    public function put(Request $request, $id)
    {
        $resultResponse = new ResultResponse();
        try {
            $clase = Clase::findOrFail($id);
            $clase->cl_nombre = $request->get('cl_nombre', $clase->cl_nombre);
            $clase->cl_fecha = $request->get('cl_fecha', $clase->cl_fecha);
            $clase->cl_hora = $request->get('cl_hora', $clase->cl_hora);
            $clase->cl_maximo = $request->get('l_maximo', $clase->l_maximo);
            $clase->cl_actual = $request->get('cl_actual', $clase->cl_actual);
            $clase->cl_rt_code = $request->get('cl_rt_code', $clase->cl_rt_code);
            $clase->save();
            $resultResponse->setData($clase);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }
        return response()->json($resultResponse);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $resultResponse = new ResultResponse();
        try {
            $clase = Clase::findOrFail($id);
            $clase->delete();
            $resultResponse->setData($clase);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }
        return response()->json($resultResponse);
    }
}

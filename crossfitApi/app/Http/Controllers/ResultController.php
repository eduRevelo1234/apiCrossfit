<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use App\Libs\ResultResponse;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = Result::all();
        $resultResponse = new ResultResponse();
        $resultResponse->setData($result);
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
            $newPlan = new Result([
                'rl_fecha' => $request->get('rl_fecha'),
                'rl_observacion' => $request->get('rl_observacion'),
                'rl_rondas' => $request->get('rl_rondas'),
                'rl_repeticion' => $request->get('rl_repeticion'),
                'rl_peso' => $request->get('rl_peso'),
                'rl_unidad' => $request->get('rl_unidad'),
                'rl_us_codigo' => $request->get('rl_us_codigo'),
                'rl_ej_codigo' => $request->get('rl_ej_codigo'),
            ]);
            $newPlan->save();
            $resultResponse->setData($newPlan);
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
            $result = Result::findOrFail($id);
            $resultResponse->setData($result);
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
            $result = Result::findOrFail($id);
            $result->rl_fecha = $request->get('rl_fecha', $result->rl_fecha);
            $result->rl_observacion = $request->get('rl_observacion', $result->rl_observacion);
            $result->rl_rondas = $request->get('rl_rondas', $result->rl_rondas);
            $result->rl_repeticion = $request->get('rl_repeticion', $result->rl_repeticion);
            $result->rl_peso = $request->get('rl_peso', $result->rl_peso);
            $result->rl_unidad = $request->get('rl_unidad', $result->rl_unidad);
            $result->rl_us_codigo = $request->get('rl_us_codigo', $result->rl_us_codigo);
            $result->rl_ej_codigo = $request->get('rl_ej_codigo', $result->rl_ej_codigo);
            $result->save();
            $resultResponse->setData($result);
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
            $result = Result::findOrFail($id);
            $result->rl_fecha = $request->get('rl_fecha', $result->rl_fecha);
            $result->rl_observacion = $request->get('rl_observacion', $result->rl_observacion);
            $result->rl_rondas = $request->get('rl_rondas', $result->rl_rondas);
            $result->rl_repeticion = $request->get('rl_repeticion', $result->rl_repeticion);
            $result->rl_peso = $request->get('rl_peso', $result->rl_peso);
            $result->rl_unidad = $request->get('rl_unidad', $result->rl_unidad);
            $result->rl_us_codigo = $request->get('rl_us_codigo', $result->rl_us_codigo);
            $result->rl_ej_codigo = $request->get('rl_ej_codigo', $result->rl_ej_codigo);
            $result->save();
            $resultResponse->setData($result);
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
            $result = Result::findOrFail($id);
            $result->delete();
            $resultResponse->setData($result);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }
        return response()->json($resultResponse);
    }
}

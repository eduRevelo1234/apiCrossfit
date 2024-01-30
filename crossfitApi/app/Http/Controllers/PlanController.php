<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Libs\ResultResponse;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plan = Plan::all();
        $resultResponse = new ResultResponse();
        $resultResponse->setData($plan);
        $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
        $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        return response()->json($resultResponse);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $resultResponse = new ResultResponse();
        try {
            $newPlan = new Plan([
                'pl_nombre' => $request->get('pl_nombre'),
                'pl_numero_clase' => $request->get('pl_numero_clase'),
                'pl_estado' => $request->get('pl_estado'),
                'pl_costo_inscripcion' => $request->get('pl_costo_inscripcion'),
                'pl_costo_mensual' => $request->get('pl_costo_mensual'),
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
            $plan = Plan::findOrFail($id);
            $resultResponse->setData($plan);
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
            $plan = Plan::findOrFail($id);
            $plan->pl_nombre = $request->get('pl_nombre', $plan->pl_nombre);
            $plan->pl_numero_clase = $request->get('pl_numero_clase', $plan->pl_numero_clase);
            $plan->pl_estado = $request->get('pl_estado', $plan->pl_estado);
            $plan->pl_costo_inscripcion = $request->get('pl_costo_inscripcion', $plan->pl_costo_inscripcion);
            $plan->pl_costo_mensual = $request->get('pl_costo_mensual', $plan->pl_costo_mensual);
            $plan->save();
            $resultResponse->setData($plan);
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
            $plan = Plan::findOrFail($id);
            $plan->pl_nombre = $request->get('pl_nombre', $plan->pl_nombre);
            $plan->pl_numero_clase = $request->get('pl_numero_clase', $plan->pl_numero_clase);
            $plan->pl_estado = $request->get('pl_estado', $plan->pl_estado);
            $plan->pl_costo_inscripcion = $request->get('pl_costo_inscripcion', $plan->pl_costo_inscripcion);
            $plan->pl_costo_mensual = $request->get('pl_costo_mensual', $plan->pl_costo_mensual);
            $plan->save();
            $resultResponse->setData($plan);
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
        try{
            $plan = Plan::findOrFail($id);
            $plan->delete();
            $resultResponse->setData($plan);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        }
        catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }
        return response()->json($resultResponse);
    }
}

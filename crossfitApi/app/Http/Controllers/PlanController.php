<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Libs\ResultResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $resultResponse = new ResultResponse();
        $validation = $this->validateRequest($request);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
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
        }
        return response()->json($resultResponse);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $resultResponse = new ResultResponse();
        $validation = $this->validateId($id);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $plan = Plan::findOrFail($id);
                $resultResponse->setData($plan);
                $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
            } catch (\Exception $e) {
                $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
            }
        }
        return response()->json($resultResponse);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, $id)
    {
        $resultResponse = new ResultResponse();
        $validation = $this->validateRequest($request);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
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
        $validation = $this->validateId($id);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $plan = Plan::findOrFail($id);
                $plan->delete();
                $resultResponse->setData($plan);
                $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
            } catch (\Exception $e) {
                $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
            }
        }
        return response()->json($resultResponse);
    }

    public function search(Request $request)
    {
        $resultResponse = new ResultResponse();
        try {
            // Obtener todos los planes
            $plans = Plan::all();

            // Aplicar búsqueda si se proporciona un término de búsqueda
            if ($request->has('search_term')) {
                $searchTerm = strtolower($request->input('search_term'));

                // Filtrar planes que coincidan con el término de búsqueda en cualquiera de los campos
                $plans = $plans->filter(function ($plan) use ($searchTerm) {
                    foreach ($plan->toArray() as $field => $value) {
                        // Considerar solo campos de cadena y realizar una búsqueda insensible a mayúsculas y minúsculas
                        if (is_string($value) && str_contains(strtolower($value), $searchTerm)) {
                            return true;
                        }
                    }
                    return false;
                });
            }

            $resultResponse->setData($plans);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }

        return response()->json($resultResponse);
    }

    private function validateRequest(Request $request)
    {
        // Reglas de validación
        $rules = [
            'pl_nombre' => 'nullable|string|max:255',
            'pl_numero_clase' => 'nullable|integer',
            'pl_estado' => 'required|string|max:10',
            'pl_costo_inscripcion' => 'nullable|numeric|between:0,99999.99',
            'pl_costo_mensual' => 'nullable|numeric|between:0,99999.99',
        ];
        return Validator::make($request->all(), $rules);
    }

    private function validateId($id)
    {
        return Validator::make(['id' => $id], [
            'id' => [
                'required',
                'integer',
                Rule::exists('plans', 'id'),
            ],
        ]);
    }
}

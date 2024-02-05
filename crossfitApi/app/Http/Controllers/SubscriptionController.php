<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Libs\ResultResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscription = Subscription::all();
        $resultResponse = new ResultResponse();
        $resultResponse->setData($subscription);
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
                $newSubscription = new Subscription([
                    'sc_finicio' => $request->get('sc_finicio'),
                    'sc_ffin' => $request->get('sc_ffin'),
                    'sc_estado' => $request->get('sc_estado'),
                    'sc_observacion' => $request->get('sc_observacion'),
                    'sc_periodo' => $request->get('sc_periodo'),
                    'sc_us_codigo' => $request->get('sc_us_codigo'),
                    'sc_pl_codigo' => $request->get('sc_pl_codigo'),
                ]);
                $newSubscription->save();
                $resultResponse->setData($newSubscription);
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
                $subscription = Subscription::findOrFail($id);
                $resultResponse->setData($subscription);
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
                $subscription = Subscription::findOrFail($id);
                $subscription->sc_finicio = $request->get('sc_finicio', $subscription->sc_finicio);
                $subscription->sc_ffin = $request->get('sc_ffin', $subscription->sc_ffin);
                $subscription->sc_estado = $request->get('sc_estado', $subscription->sc_estado);
                $subscription->sc_observacion = $request->get('sc_observacion', $subscription->sc_observacion);
                $subscription->sc_periodo = $request->get('sc_periodo', $subscription->sc_periodo);
                $subscription->sc_us_codigo = $request->get('sc_us_codigo', $subscription->sc_us_codigo);
                $subscription->sc_pl_codigo = $request->get('sc_pl_codigo', $subscription->sc_pl_codigo);
                $subscription->save();
                $resultResponse->setData($subscription);
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
            $subscription = Subscription::findOrFail($id);
            $subscription->sc_finicio = $request->get('sc_finicio', $subscription->sc_finicio);
            $subscription->sc_ffin = $request->get('sc_ffin', $subscription->sc_ffin);
            $subscription->sc_estado = $request->get('sc_estado', $subscription->sc_estado);
            $subscription->sc_observacion = $request->get('sc_observacion', $subscription->sc_observacion);
            $subscription->sc_periodo = $request->get('sc_periodo', $subscription->sc_periodo);
            $subscription->sc_us_codigo = $request->get('sc_us_codigo', $subscription->sc_us_codigo);
            $subscription->sc_pl_codigo = $request->get('sc_pl_codigo', $subscription->sc_pl_codigo);
            $subscription->save();
            $resultResponse->setData($subscription);
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
                $subscription = Subscription::findOrFail($id);
                $subscription->delete();
                $resultResponse->setData($subscription);
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
            // Obtener todas las suscripciones
            $subscriptions = Subscription::all();

            // Aplicar búsqueda si se proporciona un término de búsqueda
            if ($request->has('search_term')) {
                $searchTerm = strtolower($request->input('search_term'));

                // Filtrar suscripciones que contengan el término de búsqueda en cualquiera de los campos
                $subscriptions = $subscriptions->filter(function ($subscription) use ($searchTerm) {
                    foreach ($subscription->getAttributes() as $field => $value) {
                        // Considerar solo campos de cadena y realizar una búsqueda insensible a mayúsculas y minúsculas
                        if (is_string($value) && str_contains(strtolower($value), $searchTerm)) {
                            return true;
                        }
                    }
                    return false;
                });
            }

            $resultResponse->setData($subscriptions);
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
            'sc_finicio' => 'required|date_format:Y-m-d',
            'sc_ffin' => 'required|date_format:Y-m-d',
            'sc_estado' => 'required|string|max:10',
            'sc_observacion' => 'nullable|string|max:255',
            'sc_periodo' => 'required|string|max:10',
            'sc_us_codigo' => ['required', 'integer', Rule::exists('users', 'id')],
            'sc_pl_codigo' => ['required', 'integer', Rule::exists('plans', 'id')],
        ];
        return Validator::make($request->all(), $rules);
    }

    private function validateId($id)
    {
        return Validator::make(['id' => $id], [
            'id' => [
                'required',
                'integer',
                Rule::exists('subscriptions', 'id'),
            ],
        ]);
    }
}

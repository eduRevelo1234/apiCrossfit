<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Libs\ResultResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = Payment::all();
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
        $validation = $this->validateRequest($request);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $newPayment = new Payment([
                    'pg_nombre' => $request->get('pg_nombre'),
                    'pg_tipo' => $request->get('pg_tipo'),
                    'pg_fecha' => $request->get('pg_fecha'),
                    'pg_resplado' => $request->get('pg_resplado'),
                    'pg_monto' => $request->get('pg_monto'),
                    'pg_sc_codigo' => $request->get('pg_sc_codigo'),
                ]);
                $newPayment->save();
                $resultResponse->setData($newPayment);
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
                $payment = Payment::findOrFail($id);
                $resultResponse->setData($payment);
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
                $payment = Payment::findOrFail($id);
                $payment->pg_nombre = $request->get('pg_nombre', $payment->pg_nombre);
                $payment->pg_tipo = $request->get('pg_tipo', $payment->pg_tipo);
                $payment->pg_fecha = $request->get('pg_fecha', $payment->pg_fecha);
                $payment->pg_resplado = $request->get('pg_resplado', $payment->pg_resplado);
                $payment->pg_monto = $request->get('pg_monto', $payment->pg_monto);
                $payment->pg_sc_codigo = $request->get('pg_sc_codigo', $payment->pg_sc_codigo);
                $payment->save();
                $resultResponse->setData($payment);
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
            $payment = Payment::findOrFail($id);
            $payment->pg_nombre = $request->get('pg_nombre', $payment->pg_nombre);
            $payment->pg_tipo = $request->get('pg_tipo', $payment->pg_tipo);
            $payment->pg_fecha = $request->get('pg_fecha', $payment->pg_fecha);
            $payment->pg_resplado = $request->get('pg_resplado', $payment->pg_resplado);
            $payment->pg_monto = $request->get('pg_monto', $payment->pg_monto);
            $payment->pg_sc_codigo = $request->get('pg_sc_codigo', $payment->pg_sc_codigo);
            $payment->save();
            $resultResponse->setData($payment);
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
                $payment = Payment::findOrFail($id);
                $payment->delete();
                $resultResponse->setData($payment);
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
            // Obtener todos los pagos
            $payments = Payment::all();

            // Aplicar búsqueda si se proporciona un término de búsqueda
            if ($request->has('search_term')) {
                $searchTerm = strtolower($request->input('search_term'));

                // Filtrar pagos que coincidan con el término de búsqueda en cualquiera de los campos
                $payments = $payments->filter(function ($payment) use ($searchTerm) {
                    foreach ($payment->toArray() as $field => $value) {
                        if (is_string($value) && str_contains(strtolower($value), $searchTerm)) {
                            return true;
                        }
                    }
                    return false;
                });
            }

            $resultResponse->setData($payments);
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
            'pg_nombre' => 'required|string|max:10',
            'pg_tipo' => 'required|string|max:10',
            'pg_fecha' => 'nullable|date_format:Y-m-d',
            'pg_resplado' => 'nullable|string|max:255',
            'pg_monto' => 'nullable|numeric|between:0,99999.99',
            'pg_sc_codigo' => ['required', 'integer', Rule::exists('subscriptions', 'id')],
        ];
        return Validator::make($request->all(), $rules);
    }

    private function validateId($id)
    {
        return Validator::make(['id' => $id], [
            'id' => [
                'required',
                'integer',
                Rule::exists('payments', 'id'),
            ],
        ]);
    }

}

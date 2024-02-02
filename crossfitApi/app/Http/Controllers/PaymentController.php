<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Libs\ResultResponse;

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
        return response()->json($resultResponse);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $resultResponse = new ResultResponse();
        try {
            $payment = Payment::findOrFail($id);
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
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
        return response()->json($resultResponse);
    }
}

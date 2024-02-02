<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Libs\ResultResponse;

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
        return response()->json($resultResponse);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $resultResponse = new ResultResponse();
        try {
            $subscription = Subscription::findOrFail($id);
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
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
        return response()->json($resultResponse);
    }
}

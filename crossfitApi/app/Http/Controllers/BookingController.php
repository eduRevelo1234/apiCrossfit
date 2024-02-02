<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Libs\ResultResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $booking = Booking::all();
        $resultResponse = new ResultResponse();
        $resultResponse->setData($booking);
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
        $validation = $this->validateBooking($request);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $newPlan = new Booking([
                    'rs_asistencia' => $request->get('rs_asistencia'),
                    'rs_us_codigo' => $request->get('rs_us_codigo'),
                    'rs_cl_codigo' => $request->get('rs_cl_codigo'),
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
        $validation = $this->bookingId($id);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $booking = Booking::findOrFail($id);
                $resultResponse->setData($booking);
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
        $validation = $this->validateBooking($request);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $booking = Booking::findOrFail($id);
                $booking->rs_asistencia = $request->get('rs_asistencia', $booking->rs_asistencia);
                $booking->rs_us_codigo = $request->get('rs_us_codigo', $booking->rs_us_codigo);
                $booking->rs_cl_codigo = $request->get('rs_cl_codigo', $booking->rs_cl_codigo);
                $booking->save();
                $resultResponse->setData($booking);
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
            $booking = Booking::findOrFail($id);
            $booking->rs_asistencia = $request->get('rs_asistencia', $booking->rs_asistencia);
            $booking->rs_us_codigo = $request->get('rs_us_codigo', $booking->rs_us_codigo);
            $booking->rs_cl_codigo = $request->get('rs_cl_codigo', $booking->rs_cl_codigo);
            $booking->save();
            $resultResponse->setData($booking);
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
        $validation = $this->bookingId($id);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $booking = Booking::findOrFail($id);
                $booking->delete();
                $resultResponse->setData($booking);
                $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
            } catch (\Exception $e) {
                $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
            }
        }
        return response()->json($resultResponse);
    }

    private function validateBooking(Request $request)
    {
        $rules = [
            'rs_asistencia' => ['required', 'string', 'max:10'],
            'rs_us_codigo' => ['required', Rule::exists('users', 'id')],
            'rs_cl_codigo' => ['required', Rule::exists('clases', 'id')],
        ];
        return Validator::make($request->all(), $rules);
    }
    private function bookingId($id)
    {
        return Validator::make(['id' => $id], [
            'id' => [
                'required',
                'integer',
                Rule::exists('bookings', 'id'),
            ],
        ]);
    }
}

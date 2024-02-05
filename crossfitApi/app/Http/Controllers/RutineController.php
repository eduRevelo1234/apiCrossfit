<?php

namespace App\Http\Controllers;

use App\Models\Rutine;
use Illuminate\Http\Request;
use App\Libs\ResultResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RutineController extends Controller
{
    public function index()
    {
        $rutine = Rutine::all();
        $resultResponse = new ResultResponse();
        $resultResponse->setData($rutine);
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
        $validation = $this->validateRutineRequest($request);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $newRutine = new Rutine([
                    'rt_nombre' => $request->get('rt_nombre'),
                    'rt_descripcion' => $request->get('rt_descripcion'),
                ]);
                $newRutine->save();
                $resultResponse->setData($newRutine);
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
        $validation = $this->validateRutineId($id);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $rutine = Rutine::findOrFail($id);
                $resultResponse->setData($rutine);
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
        $validation = $this->validateRutineRequest($request);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $rutine = Rutine::findOrFail($id);
                $rutine->rt_nombre = $request->get('rt_nombre', $rutine->rt_nombre);
                $rutine->rt_descripcion = $request->get('rt_descripcion', $rutine->rt_descripcion);
                $rutine->save();
                $resultResponse->setData($rutine);
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
            $rutine = Rutine::findOrFail($id);
            $rutine->rt_nombre = $request->get('rt_nombre', $rutine->rt_nombre);
            $rutine->rt_descripcion = $request->get('rt_descripcion', $rutine->rt_descripcion);
            $rutine->save();
            $resultResponse->setData($rutine);
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
        $validation = $this->validateRutineId($id);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(implode(', ', $errors));
        } else {
            try {
                $rutine = Rutine::findOrFail($id);
                $rutine->delete();
                $resultResponse->setData($rutine);
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
            // Obtener todas las rutinas
            $rutines = Rutine::all();

            // Aplicar búsqueda si se proporciona un término de búsqueda
            if ($request->has('search_term')) {
                $searchTerm = strtolower($request->input('search_term'));

                // Filtrar rutinas que contengan el término de búsqueda en cualquiera de los campos
                $rutines = $rutines->filter(function ($rutine) use ($searchTerm) {
                    foreach ($rutine->getAttributes() as $field => $value) {
                        // Considerar solo campos de cadena y realizar una búsqueda insensible a mayúsculas y minúsculas
                        if (is_string($value) && str_contains(strtolower($value), $searchTerm)) {
                            return true;
                        }
                    }
                    return false;
                });
            }

            $resultResponse->setData($rutines);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }

        return response()->json($resultResponse);
    }

    private function validateRutineRequest(Request $request)
    {
        $rules = [
            'rt_nombre' => 'nullable|string|max:255',
            'rt_descripcion' => 'nullable|string|max:255',
        ];
        return Validator::make($request->all(), $rules);
    }

    private function validateRutineId($id)
    {
        return Validator::make(['id' => $id], [
            'id' => [
                'required',
                'integer',
                Rule::exists('rutines', 'id'),
            ],
        ]);
    }
}

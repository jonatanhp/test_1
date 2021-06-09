<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cronograma_Pagos;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Cronograma_Pagos as Cronograma_PagosResource;

class CronogramaPagosController extends BaseController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cronogramas_pagos = Cronograma_Pagos::all();
    
        return $this->sendResponse(Cronograma_PagosResource::collection($cronogramas_pagos), 'Cronograma_Pagoss retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'fecha_limite' => 'required',
            'pagado' => 'required',
            'contrato_matricula_id' => 'required'
            
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $cronograma_pagos = Cronograma_Pagos::create($input);
   
        return $this->sendResponse(new Cronograma_PagosResource($cronograma_pagos), 'Cronograma_Pagos created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cronograma_pagos = Cronograma_Pagos::find($id);
  
        if (is_null($cronograma_pagos)) {
            return $this->sendError('Cronograma_Pagos not found.');
        }
   
        return $this->sendResponse(new Cronograma_PagosResource($cronograma_pagos), 'Cronograma_Pagos retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cronograma_Pagos $cronograma_pagos)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'fecha_limite' => 'required',
            'pagado' => 'required',
            'contrato_matricula_id' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $cronograma_pagos->fecha_limite = $input['fecha_limite'];
        $cronograma_pagos->pagado = $input['pagado'];
        $cronograma_pagos->contrato_matricula_id = $input['contrato_matricula_id'];
        $cronograma_pagos->save();
   
        return $this->sendResponse(new Cronograma_PagosResource($cronograma_pagos), 'Cronograma_Pagos updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cronograma_Pagos $cronograma_pagos)
    {
        $cronograma_pagos->delete();
   
        return $this->sendResponse([], 'Cronograma_Pagos deleted successfully.');
    }
}

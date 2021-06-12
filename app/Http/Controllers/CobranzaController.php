<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cobranza;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Cobranza as CobranzaResource;

class CobranzaController extends BaseController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cobranzas = Cobranza::all();
    
        return $this->sendResponse(CobranzaResource::collection($cobranzas), 'Cobranzas retrieved successfully.');
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
            'concepto' => 'required',
            'cantidad' =>'required',
            'valor_unitario' => 'required',
            'total' => 'required',
            'alumno_id' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $cobranza = Cobranza::create($input);
   
        return $this->sendResponse(new CobranzaResource($cobranza), 'Cobranza created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cobranza = Cobranza::find($id);
  
        if (is_null($cobranza)) {
            return $this->sendError('Cobranza not found.');
        }
   
        return $this->sendResponse(new CobranzaResource($cobranza), 'Cobranza retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cobranza=Cobranza::findOrFail($id);
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'concepto' => 'required',
            'cantidad' =>'required',
            'valor_unitario' => 'required',
            'total' => 'required',
            'alumno_id' => 'required'
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $cobranza->concepto = $input['concepto'];
        $cobranza->cantidad = $input['cantidad'];
        $cobranza->valor_unitario = $input['valor_unitario'];
        $cobranza->total = $input['total'];
        $cobranza->alumno_id = $input['alumno_id'];
        $cobranza->save();
   
        return $this->sendResponse(new CobranzaResource($cobranza), 'Cobranza updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cobranza=Cobranza::findOrFail($id);
        $cobranza->delete();
   
        return $this->sendResponse([], 'Cobranza deleted successfully.');
    }
}

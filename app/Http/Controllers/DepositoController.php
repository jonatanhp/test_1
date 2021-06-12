<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposito;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Deposito as DepositoResource;

class DepositoController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $depositos = Deposito::all();
    
        return $this->sendResponse(DepositoResource::collection($depositos), 'Depositos retrieved successfully.');
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
            'modalidad_deposito' => 'required',
            'cod_operacion' =>'required',
            'importe' => 'required',
            'alumno_id' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $deposito = Deposito::create($input);
   
        return $this->sendResponse(new DepositoResource($deposito), 'Deposito created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deposito = Deposito::find($id);
  
        if (is_null($deposito)) {
            return $this->sendError('Deposito not found.');
        }
   
        return $this->sendResponse(new DepositoResource($deposito), 'Deposito retrieved successfully.');
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
        $deposito=Deposito::findOrFail($id);
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'modalidad_deposito' => 'required',
            'cod_operacion' =>'required',
            'importe' => 'required',
            'alumno_id' => 'required'
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $deposito->modalidad_deposito = $input['modalidad_deposito'];
        $deposito->cod_operacion = $input['cod_operacion'];
        $deposito->importe = $input['importe'];
        $deposito->alumno_id = $input['alumno_id'];
        $deposito->save();
   
        return $this->sendResponse(new DepositoResource($deposito), 'Deposito updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deposito=Deposito::findOrFail($id);
        $deposito->delete();
   
        return $this->sendResponse([], 'Deposito deleted successfully.');
    }
}

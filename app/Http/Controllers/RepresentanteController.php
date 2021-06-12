<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Representante;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Representante as RepresentanteResource;

class RepresentanteController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $representantes = Representante::all();
    
        return $this->sendResponse(RepresentanteResource::collection($representantes), 'Representantes retrieved successfully.');
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
            'cod_representante' => 'required',
            'user_id' =>'required'
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $representante = Representante::create($input);
   
        return $this->sendResponse(new RepresentanteResource($representante), 'Representante created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $representante = Representante::find($id);
  
        if (is_null($representante)) {
            return $this->sendError('Representante not found.');
        }
   
        return $this->sendResponse(new RepresentanteResource($representante), 'Representante retrieved successfully.');
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
        $representante=Representante::findOrFail($id);
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'cod_representante' => 'required',
            'user_id' =>'required'
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $representante->cod_representante = $input['cod_representante'];
        $representante->user_id = $input['user_id'];
        
        $representante->save();
   
        return $this->sendResponse(new RepresentanteResource($representante), 'Representante updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $representante=Representante::findOrFail($id);
        $representante->delete();
   
        return $this->sendResponse([], 'Representante deleted successfully.');
    }
}

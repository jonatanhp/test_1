<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Ubigeo;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Ubigeo as UbigeoResource;

class UbigeoController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ubigeos = Ubigeo::all();
    
        return $this->sendResponse(UbigeoResource::collection($ubigeos), 'Ubigeos retrieved successfully.');
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
            'cod_departamento' => 'required',
            'cod_provincia' => 'required',
            'cod_distrito' => 'required',
            'distrito' => 'required'
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $ubigeo = Ubigeo::create($input);
   
        return $this->sendResponse(new UbigeoResource($ubigeo), 'Ubigeo created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ubigeo = Ubigeo::find($id);
  
        if (is_null($ubigeo)) {
            return $this->sendError('Ubigeo not found.');
        }
   
        return $this->sendResponse(new UbigeoResource($ubigeo), 'Ubigeo retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ubigeo $ubigeo)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'cod_departamento' => 'required',
            'cod_provincia' => 'required',
            'cod_distrito' => 'required',
            'distrito' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $ubigeo->cod_departamento = $input['cod_departamento'];
        $ubigeo->cod_provincia = $input['cod_provincia'];
        $ubigeo->cod_distrito = $input['cod_distrito'];
        $ubigeo->distrito = $input['distrito'];
        $ubigeo->save();
   
        return $this->sendResponse(new UbigeoResource($ubigeo), 'Ubigeo updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ubigeo $ubigeo)
    {
        $ubigeo->delete();
   
        return $this->sendResponse([], 'Ubigeo deleted successfully.');
    }
}

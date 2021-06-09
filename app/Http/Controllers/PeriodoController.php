<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periodo;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Periodo as PeriodoResource;

class PeriodoController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodos = Periodo::all();
    
        return $this->sendResponse(PeriodoResource::collection($periodos), 'Periodos retrieved successfully.');
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
            'nom_periodo' => 'required',
            'desc_periodo',
            'estado' => 'required'
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $periodo = Periodo::create($input);
   
        return $this->sendResponse(new PeriodoResource($periodo), 'Periodo created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $periodo = Periodo::find($id);
  
        if (is_null($periodo)) {
            return $this->sendError('Periodo not found.');
        }
   
        return $this->sendResponse(new PeriodoResource($periodo), 'Periodo retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Periodo $periodo)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'nom_periodo' => 'required',
            'desc_periodo',
            'estado' => 'required'
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $periodo->nom_periodo = $input['nom_periodo'];
        $periodo->desc_periodo = $input['desc_periodo'];
        $periodo->estado = $input['estado'];
        $periodo->save();
   
        return $this->sendResponse(new PeriodoResource($periodo), 'Periodo updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Periodo $periodo)
    {
        $periodo->delete();
   
        return $this->sendResponse([], 'Periodo deleted successfully.');
    }
}

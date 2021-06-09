<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Docente as DocenteResource;

class DocenteController extends BaseController
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docentes = Docente::all();
    
        return $this->sendResponse(DocenteResource::collection($docentes), 'Docentes retrieved successfully.');
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
            'cod_docente' => 'required',
            'user_id' =>'required'
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $docente = Docente::create($input);
   
        return $this->sendResponse(new DocenteResource($docente), 'Docente created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $docente = Docente::find($id);
  
        if (is_null($docente)) {
            return $this->sendError('Docente not found.');
        }
   
        return $this->sendResponse(new DocenteResource($docente), 'Docente retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Docente $docente)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'cod_docente' => 'required',
            'user_id' =>'required'
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $docente->cod_docente = $input['cod_docente'];
        $docente->user_id = $input['user_id'];
        
        $docente->save();
   
        return $this->sendResponse(new DocenteResource($docente), 'Docente updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Docente $docente)
    {
        $docente->delete();
   
        return $this->sendResponse([], 'Docente deleted successfully.');
    }
}

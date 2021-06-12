<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Alumno as AlumnoResource;

class AlumnoController extends BaseController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnos = Alumno::all();
    
        return $this->sendResponse(AlumnoResource::collection($alumnos), 'Alumnos retrieved successfully.');
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
            'cod_alumno' => 'required',
            'user_id' =>'required'
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $alumno = Alumno::create($input);
   
        return $this->sendResponse(new AlumnoResource($alumno), 'Alumno created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumno = Alumno::find($id);
  
        if (is_null($alumno)) {
            return $this->sendError('Alumno not found.');
        }
   
        return $this->sendResponse(new AlumnoResource($alumno), 'Alumno retrieved successfully.');
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
        $alumno=Alumno::findOrFail($id);
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'cod_alumno' => 'required',
            'user_id' =>'required'
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $alumno->cod_alumno = $input['cod_alumno'];
        $alumno->user_id = $input['user_id'];
        
        $alumno->save();
   
        return $this->sendResponse(new AlumnoResource($alumno), 'Alumno updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alumno=Alumno::findOrFail($id);
        $alumno->delete();
   
        return $this->sendResponse([], 'Alumno deleted successfully.');
    }
}

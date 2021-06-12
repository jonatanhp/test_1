<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno_Carga_Acad;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Alumno_Carga_Acad as Alumno_Carga_AcadResource;

class AlumnoCargaAcadController extends BaseController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumno_carga_acads = Alumno_Carga_Acad::all();
    
        return $this->sendResponse(Alumno_Carga_AcadResource::collection($alumno_carga_acads), 'Alumno_Carga_Acads retrieved successfully.');
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
            'curso_docente_seccion_id' => 'required',
            'contrato_matricula_id' => 'required',
            'alumno_id' => 'required'
            
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $alumno_carga_acad = Alumno_Carga_Acad::create($input);
   
        return $this->sendResponse(new Alumno_Carga_AcadResource($alumno_carga_acad), 'Alumno_Carga_Acad created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumno_carga_acad = Alumno_Carga_Acad::find($id);
  
        if (is_null($alumno_carga_acad)) {
            return $this->sendError('Alumno_Carga_Acad not found.');
        }
   
        return $this->sendResponse(new Alumno_Carga_AcadResource($alumno_carga_acad), 'Alumno_Carga_Acad retrieved successfully.');
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
        $alumno_carga_acad=Alumno_Carga_Acad::findOrFail($id);
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'curso_docente_seccion_id' => 'required',
            'contrato_matricula_id' => 'required',
            'alumno_id' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $alumno_carga_acad->curso_docente_seccion_id = $input['curso_docente_seccion_id'];
        $alumno_carga_acad->contrato_matricula_id = $input['contrato_matricula_id'];
        $alumno_carga_acad->alumno_id = $input['alumno_id'];
        $alumno_carga_acad->save();
   
        return $this->sendResponse(new Alumno_Carga_AcadResource($alumno_carga_acad), 'Alumno_Carga_Acad updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alumno_carga_acad=Alumno_Carga_Acad::findOrFail($id);
        $alumno_carga_acad->delete();
   
        return $this->sendResponse([], 'Alumno_Carga_Acad deleted successfully.');
    }
}

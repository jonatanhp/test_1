<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso_Docente_Seccion;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Curso_Docente_Seccion as Curso_Docente_SeccionResource;

class CursoDocenteSeccionController extends BaseController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curso_docente_seccion_docente_seccions = Curso_Docente_Seccion::all();
    
        return $this->sendResponse(Curso_Docente_SeccionResource::collection($curso_docente_seccion_docente_seccions), 'Curso_Docente_Seccions retrieved successfully.');
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
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'curso_id' => 'required',
            'seccion_id' => 'required',
            'docente_id' => 'required'
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $curso_docente_seccion = Curso_Docente_Seccion::create($input);
   
        return $this->sendResponse(new Curso_Docente_SeccionResource($curso_docente_seccion), 'Curso_Docente_Seccion created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso_docente_seccion = Curso_Docente_Seccion::find($id);
  
        if (is_null($curso_docente_seccion)) {
            return $this->sendError('Curso_Docente_Seccion not found.');
        }
   
        return $this->sendResponse(new Curso_Docente_SeccionResource($curso_docente_seccion), 'Curso_Docente_Seccion retrieved successfully.');
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
        $curso_docente_seccion=Curso_Docente_Seccion::findOrFail($id);
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'curso_id' => 'required',
            'seccion_id' => 'required',
            'docente_id' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $curso_docente_seccion->fecha_inicio = $input['fecha_inicio'];
        $curso_docente_seccion->fecha_fin = $input['fecha_fin'];
        $curso_docente_seccion->curso_id = $input['curso_id'];
        $curso_docente_seccion->seccion_id = $input['seccion_id'];
        $curso_docente_seccion->docente_id = $input['docente_id'];
        
        $curso_docente_seccion->save();
   
        return $this->sendResponse(new Curso_Docente_SeccionResource($curso_docente_seccion), 'Curso_Docente_Seccion updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso_docente_seccion=Curso_Docente_Seccion::findOrFail($id);
        $curso_docente_seccion->delete();
   
        return $this->sendResponse([], 'Curso_Docente_Seccion deleted successfully.');
    }
}

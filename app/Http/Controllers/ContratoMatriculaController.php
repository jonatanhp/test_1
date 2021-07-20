<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato_Matricula;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Contrato_Matricula as Contrato_MatriculaResource;
use App\Models\User;
use App\Http\Resources\User as UserResource;

class ContratoMatriculaController extends BaseController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contrato_matriculas = Contrato_Matricula::all();
    
        return $this->sendResponse(Contrato_MatriculaResource::collection($contrato_matriculas), 'Contrato_Matriculas retrieved successfully.');
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
            'cod_matricula' => 'required',
            'confirmacion' => 'required',
            'periodo_id' => 'required',
            'alumno_id' => 'required',
            'representante_id' => 'required'
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $contrato_matricula = Contrato_Matricula::create($input);
   
        return $this->sendResponse(new Contrato_MatriculaResource($contrato_matricula), 'Contrato_Matricula created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contrato_matricula = Contrato_Matricula::find($id);
  
        if (is_null($contrato_matricula)) {
            return $this->sendError('Contrato_Matricula not found.');
        }
   
        return $this->sendResponse(new Contrato_MatriculaResource($contrato_matricula), 'Contrato_Matricula retrieved successfully.');
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
        $contrato_matricula=Contrato_Matricula::findOrFail($id);
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'cod_matricula' => 'required',
            'confirmacion' => 'required',
            'periodo_id' => 'required',
            'alumno_id' => 'required',
            'representante_id' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $contrato_matricula->cod_matricula = $input['cod_matricula'];
        $contrato_matricula->confirmacion = $input['confirmacion'];
        $contrato_matricula->periodo_id = $input['periodo_id'];
        $contrato_matricula->alumno_id = $input['alumno_id'];
        $contrato_matricula->representante_id = $input['representante_id'];
        $contrato_matricula->save();
   
        return $this->sendResponse(new Contrato_MatriculaResource($contrato_matricula), 'Contrato_Matricula updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contrato_matricula=Contrato_Matricula::findOrFail($id);
        $contrato_matricula->delete();
   
        return $this->sendResponse([], 'Contrato_Matricula deleted successfully.');
    }


    public function actualizarEstado($id){
        
        $user = User::find($id);
        dd($user);
        $newestado="0";
        if($user->estado=="0") $newestado="1";

        $user->estado = $newestado;
        $user->save();
   
        return $this->sendResponse(new UserResource($user), 'user updated successfully.');

    }    
}

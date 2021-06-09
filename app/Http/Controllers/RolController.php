<?php

namespace App\Http\Controllers;
use App\Models\Rol;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Rol as RolResource;

use Illuminate\Http\Request;

class RolController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rols = Rol::all();
    
        return $this->sendResponse(RolResource::collection($rols), 'Rols retrieved successfully.');
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
            'nom_rol' => 'required',
            'desc_rol',
            'permisos_id' => 'required'
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $rol = Rol::create($input);
   
        return $this->sendResponse(new RolResource($rol), 'Rol created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rol = Rol::find($id);
  
        if (is_null($rol)) {
            return $this->sendError('Rol not found.');
        }
   
        return $this->sendResponse(new RolResource($rol), 'Rol retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rol $rol)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'nom_rol' => 'required',
            'desc_rol',
            'permisos_id' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $rol->nom_rol = $input['nom_rol'];
        $rol->desc_rol = $input['desc_rol'];
        $rol->permisos_id = $input['permisos_id'];
        $rol->save();
   
        return $this->sendResponse(new RolResource($rol), 'Rol updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rol $rol)
    {
        $rol->delete();
   
        return $this->sendResponse([], 'Rol deleted successfully.');
    }
}

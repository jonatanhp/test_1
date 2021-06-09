<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Permiso as PermisoResource;

class PermisoController extends BaseController
{
    //

    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos = Permiso::all();
    
        return $this->sendResponse(PermisoResource::collection($permisos), 'Permisos retrieved successfully.');
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
            'nom_permiso' => 'required',
            'desc_permiso'
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $permiso = Permiso::create($input);
   
        return $this->sendResponse(new PermisoResource($permiso), 'Permiso created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permiso = Permiso::find($id);
  
        if (is_null($permiso)) {
            return $this->sendError('Permiso not found.');
        }
   
        return $this->sendResponse(new PermisoResource($permiso), 'Permiso retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permiso $permiso)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'nom_permiso' => 'required',
            'desc_permiso'
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $permiso->nom_permiso = $input['nom_permiso'];
        $permiso->desc_permiso = $input['desc_permiso'];
        
        $permiso->save();
   
        return $this->sendResponse(new PermisoResource($permiso), 'Permiso updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permiso $permiso)
    {
        $permiso->delete();
   
        return $this->sendResponse([], 'Permiso deleted successfully.');
    }

}

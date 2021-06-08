<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Seccion;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Seccion as SeccionResource;

class SeccionController extends BaseController
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seccions = Seccion::all();
    
        return $this->sendResponse(SeccionResource::collection($seccions), 'Seccions retrieved successfully.');
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
            'nom_seccion' => 'required'
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $seccion = Seccion::create($input);
   
        return $this->sendResponse(new SeccionResource($seccion), 'Seccion created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seccion = Seccion::find($id);
  
        if (is_null($seccion)) {
            return $this->sendError('Seccion not found.');
        }
   
        return $this->sendResponse(new SeccionResource($seccion), 'Seccion retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seccion $seccion)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'nom_seccion' => 'required'
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $seccion->nom_seccion = $input['nom_seccion'];
        
        $seccion->save();
   
        return $this->sendResponse(new SeccionResource($seccion), 'Seccion updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seccion $seccion)
    {
        $seccion->delete();
   
        return $this->sendResponse([], 'Seccion deleted successfully.');
    }
}

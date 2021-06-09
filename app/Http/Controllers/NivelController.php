<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nivel;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Nivel as NivelResource;

class NivelController extends BaseController
{
    public function index()
    {
        $nivels = Nivel::all();
    
        return $this->sendResponse(NivelResource::collection($nivels), 'Nivels retrieved successfully.');
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nom_nivel' => 'required',
            'desc_nivel' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $nivel = Nivel::create($input);
   
        return $this->sendResponse(new NivelResource($nivel), 'Nivel created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nivel = Nivel::find($id);
  
        if (is_null($nivel)) {
            return $this->sendError('Nivel not found.');
        }
   
        return $this->sendResponse(new NivelResource($nivel), 'Nivel retrieved successfully.');
    }

       /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nivel $nivel)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'nom_nivel' => 'required',
            'desc_nivel' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $nivel->nom_nivel = $input['nom_nivel'];
        $nivel->desc_nivel = $input['desc_nivel'];
        $nivel->save();
   
        return $this->sendResponse(new NivelResource($nivel), 'Nivel updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nivel $nivel)
    {
        $nivel->delete();
   
        return $this->sendResponse([], 'Nivel deleted successfully.');
    }
    
}

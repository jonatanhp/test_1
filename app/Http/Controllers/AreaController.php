<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Area as AreaResource;
use Exception;
use App\Http\Data\AreaData;


class AreaController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::all();
    
        return $this->sendResponse(AreaResource::collection($areas), 'Areas retrieved successfully.');
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
            'cod_area' => 'required',
            'nom_area' => 'required'
            
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $area = Area::create($input);
   
        return $this->sendResponse(new AreaResource($area), 'Area created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $area = Area::find($id);
  
        if (is_null($area)) {
            return $this->sendError('Area not found.');
        }
   
        return $this->sendResponse(new AreaResource($area), 'Area retrieved successfully.');
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
        $area=Area::findOrFail($id);
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'cod_area' => 'required',
            'nom_area' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $area->cod_area = $input['cod_area'];
        $area->nom_area = $input['nom_area'];
        $area->save();
   
        return $this->sendResponse(new AreaResource($area), 'Area updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area=Area::findOrFail($id);
        $area->delete();
   
        return $this->sendResponse([], 'Area deleted successfully.');
    }

    public function getCursos(Request $request, $area_id)
    {
        $jResponse = [];
        try{
            $jResponse = AreaData::getCursos($area_id);
        }catch(Exception $e){
           return $this->errorResponse($e->getMessage(), 400);
        }
        return $this->sendResponse($jResponse, 201);
    }
}

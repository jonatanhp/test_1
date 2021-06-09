<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol_User;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Rol_User as Rol_UserResource;

class RolUserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rol_users = Rol_User::all();
    
        return $this->sendResponse(Rol_UserResource::collection($rol_users), 'Rol_Users retrieved successfully.');
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
            'rol_id' => 'required',
            'user_id' => 'required'
            
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $rol_user = Rol_User::create($input);
   
        return $this->sendResponse(new Rol_UserResource($rol_user), 'Rol_User created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rol_user = Rol_User::find($id);
  
        if (is_null($rol_user)) {
            return $this->sendError('Rol_User not found.');
        }
   
        return $this->sendResponse(new Rol_UserResource($rol_user), 'Rol_User retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rol_User $rol_user)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'rol_id' => 'required',
            'user_id' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $rol_user->rol_id = $input['rol_id'];
        $rol_user->user_id = $input['user_id'];
        $rol_user->save();
   
        return $this->sendResponse(new Rol_UserResource($rol_user), 'Rol_User updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rol_User $rol_user)
    {
        $rol_user->delete();
   
        return $this->sendResponse([], 'Rol_User deleted successfully.');
    }
}

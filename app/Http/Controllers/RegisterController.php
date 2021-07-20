<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
//use Validator;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\User as UserResource;
   
class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'ap_pat' => 'required',
            'ap_mat' => 'required',
            'dni' => 'required',
            'sexo' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'User register successfully.');
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->name;
            $success['id'] =  $user->id;
            $success['ap_pat'] =  $user->ap_pat;
            $success['ap_mat'] =  $user->ap_mat;
            $user = User::find(1);
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

    public function listUser(Request $request) 
    {

        $users = User::all();          
        return $this->sendResponse(UserResource::collection($users), 'list Users successfully.');
        
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

    public function showU($id)
    {        
        $user = User::find($id);
  
        if (is_null($user)) {
            return $this->sendError('User not found.');
        }
   
        return $this->sendResponse(new UserResource($user), 'User retrieved successfully.');
    }


    public function showUser($id)
    {        
        $user = User::find($id);
  
        if (is_null($user)) {
            return $this->sendError('User not found.');
        }
        return $user;
    }
}
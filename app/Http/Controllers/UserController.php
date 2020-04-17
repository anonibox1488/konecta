<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users = User::all();
        return response()->json([
            'status' => 'success',
            'data' => $users,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try {

            $validator = Validator::make($request->all(), [
                    'name'=> 'required|string',
                    'email'=> 'required|email|unique:users,email',
                    'password'=> 'required|string',
                    'role' => ['required',Rule::in(['admin', 'seller'])],
                ]);

            if ($validator->fails()) {
                    return response()->json([
                    'status' => 'error',
                    'error' => $validator->errors(),
                ], 400);
            }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();

            return response()->json([
                'status' => 'successful registration',
                'data' => $user,
            ], 200);
            
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e,
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                    'id'=> 'required|numeric',
                    'name'=> 'nullable|string',
                    'password'=> 'nullable|string',
                    'role' => ['required',Rule::in(['admin', 'seller'])],
                ]);

            if ($validator->fails()) {
                    return response()->json([
                    'status' => 'error',
                    'error' => $validator->errors(),
                ], 400);
            }

            $user = User::find($request->id);

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'data' => 'record not found',
                    
                ], 404);
            }
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();

            return response()->json([
                'status' => 'upgrade successful',
                'data' => $user,
            ], 200);
            
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        try {
            $user = User::find($id);
            if ($user) {
                $user->delete();
                return response()->json([
                    'status' => 'successful removal',
                    'data' => '',
                ], 200);
            }
            return response()->json([
                'status' => 'not found',
                'error' => $e,
            ], 404);            
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e,
            ], 500);
        }
    }


    /**
     * Serach the resource.
     *
     * @param  string  $data
     * @return \Illuminate\Http\Response
     */
    public function search($data){
        $users = User::where(function ($query) use ($data) {
            $query->orWhere('name', 'LIKE',"%$data%")
            ->orWhere('email', 'LIKE',"%$data%")
            ->orWhere('role',$data);
        })->get();

        return response()->json([
            'status' => 'success',
            'data' => $users,
        ], 200);
    }
}

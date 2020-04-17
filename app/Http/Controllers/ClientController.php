<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $clients = Client::all();
        return response()->json([
            'status' => 'success',
            'data' => $clients,
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
                    'document'=> 'required|string|unique:clients,document',
                    'email'=> 'required|email',
                    'address'=> 'required|string',
                ]);
            

            if ($validator->fails()) {
                    return response()->json([
                    'status' => 'error',
                    'error' => $validator->errors(),
                ], 400);
            }

            $client = new Client();
            $client->name = $request->name;
            $client->document = $request->document;
            $client->email = $request->email;
            $client->address = $request->address;
            $client->save();

            return response()->json([
                'status' => 'successful',
                'data' => $client,
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
                    'name'=> 'required|string',
                    'email'=> 'required|email',
                    'address'=> 'required|string',
                ]);

            if ($validator->fails()) {
                    return response()->json([
                    'status' => 'error',
                    'error' => $validator->errors(),
                ], 400);
            }

            $client = Client::find($request->id);
            if (!$client) {
                return response()->json([
                    'status' => 'error',
                    'data' => 'record not found',
                ], 404);
            }
            $client->name = $request->name;
            $client->email = $request->email;
            $client->address = $request->address;
            $client->save();

            return response()->json([
                'status' => 'upgrade successful',
                'data' => $client,
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
            $client = Client::find($id);
            if ($client) {
                $client->delete();
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register']]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'phone_number' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'id_card_number' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray(); 
            $message = reset($errors)[0];
            return response()->json(["message" => $message], 400);
        }

        $member = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'id_card_number' => $request->id_card_number
        ]);

        if ($member) {
            $response['message'] = 'Member has been successfully registered.';
            $response['data'] = array(
                'name' => $member->name,
                'email' => $member->email,
            );

            return response()->json($response, 201);
        } else {
            $response['message'] = 'Member registration failed.';
            return response()->json($response, 500);
        }
    }

    public function me()
    {
        return response()->json(['data' => auth()->user()]);
    }
}

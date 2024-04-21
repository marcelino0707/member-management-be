<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PersonalRefreshToken;


class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getActiveUsers()
    {
        $activeUserIds = PersonalRefreshToken::where('expired_at', '>', now())->pluck('user_id')->toArray();
        $activeUsers = User::whereIn('id', $activeUserIds)->get(['name', 'email']);

        return response()->json(['data' => $activeUsers], 200);
    }
}

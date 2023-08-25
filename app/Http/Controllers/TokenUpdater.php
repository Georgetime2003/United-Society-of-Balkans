<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokenUpdater extends Controller
{
    public function updateToken(Request $request){
        try {
            $request->user()->update(['fcm_token' => $request->token]);
            return response()->json(['status' => true, 'message' => 'Token updated successfully.']);

        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Token update failed.']);
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    public function create(Request $request){
        $presence = new Presence();
        $presence->user_id = Auth::user()->id;
        $presence->latitude = $request->latitude;
        $presence->longtitude = $request->longtitude;
        $presence->address = $request->address;
        $presence->created_at = Carbon::now()->toDateTimeString();

        //check if presence has photo
        if($request->photo != ''){
            //choose a unique name for photo
            $photo = time().'.jpg';
            file_put_contents('storage/presence/'.$photo,base64_decode($request->photo));
            $presence->photo = $photo;
        }
        //mistake
        $presence->save();
        $presence->user;
        return response()->json([
            'success' => true,
            'message' => 'presence',
            'presence' => $presence
        ]);
    }

    public function presence(){
        $presence = Presence::orderBy('id','desc')->get();
        foreach($presence as $prs){
            $prs->user;          
        }
        return response()->json([
            'success' => true,
            'presence' => $presence
        ]);
    }
}

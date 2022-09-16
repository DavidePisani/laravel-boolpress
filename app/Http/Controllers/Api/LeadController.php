<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Lead;

class LeadController extends Controller
{
    public function store(Request $request){
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|max: 60000',
        ]);

        
        $new_lead = new Lead();
        $new_lead -> fill($data);
        $new_lead -> save();

        return response()->json([
            'sucsess' => true,
        ]);
    }
    
}

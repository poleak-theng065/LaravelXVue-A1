<?php

namespace App\Http\Controllers;

use App\Models\Members;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member = Members::all();
        if($member->isEmpty()){
            $memberdata = [
                'message' => 'not member found',
                'data' =>[]
            ];
            return response()->json()($member, 404);
        }else{
            $memberdata = [
                'mesage' => 'member successfully',
                'data'=>$member
            ];
        }
        return response()->json($memberdata, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $member = Members::create([
            'fullName' => $request ->fullName,
            'email' => $request -> email,
            'phoneNumber' =>$request-> phoneNumber,
            'adress' => $request->adress
        ]);
        if (!$member){
            return response()->json([
                'message' => 'Failed to create member',
            ],500);
        }else {
            return response()->json([
                'message' => 'member create successfully',
                'data' =>$member
            ],201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $member = Members::find($id);
        if ($member){
            $memberdata = [
                'message' => 'member retriveed successfully',
                'data' => $member
            ];
            return response()-> json($memberdata, 200);

        }else {
            $memberdata = [
                'message' => 'member not found',
                'data' => null
            ];

            return response()-> json($memberdata, 404);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $member = Members::where('id', $id)->update([
            'fullName' => $request ->fullName,
            'email' => $request -> email,
            'phoneNumber' =>$request-> phoneNumber,
            'adress' => $request->adress
        ]);
    
        if ($member) {
            return response()->json([
                'message' => 'member updated successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed to update member',
            ], 500);
        }
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $member = Members::find($id);
        $member->delete();
        if ($member) {
            $memberdata = [
                'message' => 'memeber deleted successfully',
            ];
            return response()->json($memberdata, 200);
        } else {
            $memberdata = [
                'message' => 'Failed to delete member',
            ];
            return response()->json($memberdata, 500);
        }
    }
}

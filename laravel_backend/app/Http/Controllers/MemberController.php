<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member = Member::all();
        if ($member) {
            $memberData = [
                'message' => "Successfully",
                'data' => $member
            ];
            return response()->json($memberData, 200);
        } else {
            return response()->json(['message' => 'Member not found'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $member = Member::create([
            'full_name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'about' => $request->about
        ]);

        if ($member) {
            $memberData = [
                'message' => 'Created Sucessfully',
                'data' => $member
            ];

            return response()->json($memberData, 201);
        } else {
            return response()->json(["message" => "Fail to create"], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $member = Member::find($id);

        if ($member) {
            $memberData = [
                "message" => "Successfully",
                "data" => $member
            ];

            return response()->json($memberData, 200);
        } else {
            return response()->json(["message" => "Not found"], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $member = Member::where('id', $id)
            ->update([
                'full_name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'about' => $request->about
            ]);

        if ($member) {
            return response()->json(['message' => 'Edit successfully'], 201);
        } else {
            return response()->json(['message' => 'Edit fail'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return response()->json(['message' => 'Member not found!']);
        }

        $member->delete();
        return response()->json(['message' => 'Member Delete Successfuly!']);
    }
}

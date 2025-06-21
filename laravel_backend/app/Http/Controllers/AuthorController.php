<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Author = Author::all();
        if ($Author->isEmpty()){
            $Authordata =[
                'message'=> "Not author found",
                'data'=> []
            ];
            return response()-> json($Author, 404);

        }else{
            $Authordata = [
                'message' => 'Author successfully',
                'data'=>$Author
            ];
        }
        return response()->json( $Authordata, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
      public function create(Request $request)
    {
        $Author = Author::create([
            'name' => $request->name,
            'DOB' => $request->DOB,
            'NumberOfWrittenBook' => $request->NumberOfWrittenBook,
            'nationality' => $request->nationality
        ]);
    
        if (!$Author) {
            return response()->json([
                'message' => 'Failed to create Author',
            ], 500);
        } else {
            return response()->json([
                'message' => 'Author created successfully',
                'data' => $Author
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $id)
    {
        $Author = Author::find($id);
        if ($Author) {
            $Authordata = [
                'message' => 'Author retrieved successfully',
                'data' => $Author
            ];
            return response()->json($Authordata, 200);
        } else {
            $Authordata = [
                'message' => 'Author not found',
                'data' => null
            ];
            return response()->json($Authordata, 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(Request $request, $id)
{
    $Author = Author::where('id', $id)->update([
        'name' => $request->name,
        'DOB' => $request->DOB,
        'NumberOfWrittenBook' => $request->NumberOfWrittenBook,
        'nationality' => $request->nationality,
    ]);

    if ($Author) {
        return response()->json([
            'message' => 'Author updated successfully',
        ], 200);
    } else {
        return response()->json([
            'message' => 'Failed to update Author',
        ], 500);
    }
}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $Author = Author::find($id);
        $Author->delete();
        if ($Author) {
            $Authordata = [
                'message' => 'Author deleted successfully',
            ];
            return response()->json($Authordata, 200);
        } else {
            $Authordata = [
                'message' => 'Failed to delete Author',
            ];
            return response()->json($Authordata, 500);
        }
    }
}

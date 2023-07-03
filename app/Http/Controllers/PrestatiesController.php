<?php

namespace App\Http\Controllers;

use App\Models\Prestaties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PrestatiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        return Prestaties::where('UserId', $id)->get();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::channel('log')->info('created', ['item' => $request->except("_token")]);
        return Prestaties::create($request->only(['OefeningId','Aantal','UserId']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestaties $prestatie)
    {
        return $prestatie;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestaties $prestatie)
    {
        $prestatie->update($request->all());
        Log::channel('log')->info('Edited', ['item' => $request->except("_token")]);
        return $prestatie;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Prestaties $prestatie)
    {
        $prestatie->delete();
        Log::channel('log')->info('Deleted', ['item' => $request->except("_token")]);
        return response()->json(['data' => $prestatie,'action' =>'deleted '], 200);
    }
}

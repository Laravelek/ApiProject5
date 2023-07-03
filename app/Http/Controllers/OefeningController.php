<?php

namespace App\Http\Controllers;

use App\Models\Oefening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class OefeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Oefening::All();
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Naam' => 'required|max:255',
            'Beschrijving' => 'required|max:255',
            'Stappen' => 'required|max:255',
        ]);
        Log::channel('log')->info('created', ['item' => $request->except("_token")]);
        return Oefening::create($request->except('_token'));

    }



    /**
     * Display the specified resource.
     */
    public function show(Oefening $oefeningen)
    {
        return $oefeningen;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Oefening $oefeningen)
    {
        $oefeningen->update($request->all());
        Log::channel('log')->info('edited', ['item' => $request->except("_token")]);
        return $oefeningen;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Oefening $oefeningen)
    {
        Log::channel('log')->info('delete', ['item' => $oefeningen]);
        $oefeningen->delete();
        Log::channel('log')->info('deleted', ['item' => $request->except("_token")]);
        return response()->json(['message' => 'deleted'], 200);

    }
}

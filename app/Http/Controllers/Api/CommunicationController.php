<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Communication;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CommunicationResource;

class CommunicationController extends Controller
{

    public function __construct()
    {
        // $this->middleware('throttle:only_communication', ['only' => ['store']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $com = Communication::limit(5)->orderBy('id', 'desc')->paginate(5);
        return CommunicationResource::collection($com);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nameSurname' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        
        $com = Communication::create([
            'nameSurname' => $request->input('nameSurname'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return new CommunicationResource($com);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Communication $commun)
    {
        return new CommunicationResource($commun);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Communication $commun)
    {
        $commun->update([
            'nameSurname' => $request->input('nameSurname'),
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);
        return new CommunicationResource($commun);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Communication $commun)
    {
        $commun->delete();
        return response()->json(['msg' => 'Commun deleted successfully']);
    }
}

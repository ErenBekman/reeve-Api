<?php

namespace App\Http\Controllers\Api;

use App\Models\Announcement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAnnouncementRequest;
use App\Http\Requests\UpdateAnnouncementRequest;
use App\Http\Resources\AnnoResource;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anno = Announcement::orderBy('id', 'desc')->paginate(5);
        return AnnoResource::collection($anno);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAnnouncementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnnouncementRequest $request)
    {

        $validator = Validator::make($request->all(),[
            'author' => 'required|string|max:255',
            'content' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        
        $anno = Announcement::create([
            'author' => $request->input('author'),
            'content' => $request->input('content'),
        ]);

        return response()->json(['data' => new AnnoResource($anno), 'msg' => 'Announcement created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Announcement  $announce
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announce)
    {
        return new AnnoResource($announce);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAnnouncementRequest  $request
     * @param  \App\Models\Announcement  $announce
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnnouncementRequest $request, Announcement $announce)
    {   
        $announce->update([
            'author' => $request->input('author'),
            'content' => $request->input('content')
        ]);
        return new AnnoResource($announce);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announcement  $announce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announce)
    {
        $announce->delete();
        return response()->json(['msg' => 'Announce deleted successfully']);
    }
}

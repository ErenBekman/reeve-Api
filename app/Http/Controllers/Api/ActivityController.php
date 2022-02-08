<?php

namespace App\Http\Controllers\Api;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use Illuminate\Support\Facades\Validator;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $act = Activity::orderBy('id', 'desc')->paginate(7);
        return ActivityResource::collection($act);
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
            'aName' => 'required',
            'organizer' => 'required',
            'address' => 'required',
            'content' => 'required',
            'date' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $act = Activity::create([
            'aName' => $request->aName,
            'organizer' => $request->organizer,
            'address' => $request->address,
            'content' => $request->content,
            'date' => $request->date,
        ]);
        // return response()->json(['data' =>$act, 'msg' =>'Activity update.']);
        return response()->json(['data' => new ActivityResource($act), 'msg' => 'Activity created successfully.'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        return new ActivityResource($activity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Activity $activity)
    {
        $validator = Validator::make($request->all(),[
            'aName' => 'string',
            'organizer' => 'string',
            'address' => 'string',
            'content' => 'string',
            'date' => 'string',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $activity->update([
            'aName' => $request->input('aName'),
            'organizer' => $request->input('organizer'),
            'address' => $request->input('address'),
            'content' => $request->input('content'),
            'date' => $request->input('date'),
        ]);

        return new ActivityResource($activity);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return response()->json(['msg' => 'Activity deleted successfully']);
    }
}

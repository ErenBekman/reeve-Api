<?php

namespace App\Http\Controllers\Api;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\SurveyResource;
use Illuminate\Support\Facades\Validator;

class SurverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sur = Survey::all();
        return SurveyResource::collection($sur);
        
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
            'options' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        $sur = Survey::create([
            'options' => $request->input('options'),
        ]);

        return new SurveyResource($sur);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        return new SurveyResource($survey);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {
        // $survey->update($request->all());
        $survey->update(['options' => $request->input('options')]);
        return  new SurveyResource($survey);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        $survey->delete();
        return response()->json(['msg' => 'Survey deleted successfully']);
    }
}

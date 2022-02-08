<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Word;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WordResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Console\Scheduling\Schedule;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $word = Word::limit(1)->inRandomOrder()->get();
        return WordResource::collection($word);
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
            'author' => 'required',
            'content' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $word = Word::create([
            'author' => $request->input('author'),
            'content' => $request->input('content'),
        ]);

        return  new WordResource($word);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function show(Word $word)
    {
        return new WordResource($word);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Word $word)
    {
        $validator = Validator::make($request->all(),[
            'author' => 'string',
            'content' => 'string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        $word->update([
            'author' => $request->input('author'),
            'content' => $request->input('content'),
        ]);
        return new WordResource($word);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function destroy(Word $word)
    {
        $word->delete();
        return response()->json(['msg' => 'Word deleted successfully']);
    }
}

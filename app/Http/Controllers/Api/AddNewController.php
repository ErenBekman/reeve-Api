<?php

namespace App\Http\Controllers\Api;

use App\Models\AddNew;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\AddNewResource;
use App\Http\Requests\StoreAddNewRequest;
use App\Http\Requests\UpdateAddNewRequest;

class AddNewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = AddNew::orderBy('id', 'desc')->paginate(7);
        return AddNewResource::collection($news);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAddNewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddNewRequest $request, AddNew $news)
    {
        $request->validated();
        
        $files = $request->file('image');

        $news = AddNew::create([
            'author' => $request->input('author'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()){
            $news->addMedia($files)->toMediaCollection('images');
        }

        return new AddNewResource($news);
        // return response()->json(['data' => new AddNewResource($news), 'msg' => 'News created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AddNew  $addNew
     * @return \Illuminate\Http\Response
     */
    public function show(AddNew $news)
    {
        return new AddNewResource($news);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAddNewRequest  $request
     * @param  \App\Models\AddNew  $news
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAddNewRequest $request, AddNew $news)
    {
    
        $files = $request->file('image');
        if ($request->hasFile('image') && $request->file('image')->isValid()){
            $news->addMedia($files)->toMediaCollection('images');
        }
        
        $arr = $request->only(['image','author', 'title', 'content']);
        // $news->update([
        //     'author' => $request->input('author'),
        //     'title' => $request->input('title'),
        //     'content' => $request->input('content'),
        // ]);
        $news->update($arr);

        // $news = AddNew::findorFail($id);
        // $author = AddNew::where('id', $id)->first()->author;
        // // $author = AddNew::where('id', $id)->value('author');
        // $title = AddNew::where('id', $id)->first()->title;
        // // $title = AddNew::where('id', $id)->value('title');
        // $content = AddNew::where('id', $id)->first()->content;
        // // $content = AddNew::where('id', $id)->value('content');
        // $image = AddNew::where('id', $id)->first()->image;
        // $news->author = $request->input('author');
        // $news->title = $request->input('title');
        // $news->content = $request->input('content');
        // $news->save();
        
        // if (empty($request->input('author'))) {
        //     $news->author = $author;
        // }
        // if (empty($request->input('title'))) {
        //     $news->title = $title;
        // }
        // if (empty($request->input('content'))) {
        //     $news->content = $content;
        // }
        // if (empty($request->input('image'))) {
        //     $news->image = $image;
        // }

        return new AddNewResource($news);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AddNew  $addNew
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddNew $news)
    {
        $news->delete();
        return response()->json(['msg' => 'News deleted successfully']);
    }
}

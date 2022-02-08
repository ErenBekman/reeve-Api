<?php

namespace App\Http\Controllers\Api;

use App\Models\Foto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FotoResource;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $foto = Foto::orderBy('id', 'desc')->paginate(5);
            return FotoResource::collection($foto);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Foto $foto)
    {
        // $request->validated();

        $validator = Validator::make($request->all(),[
            'title' => 'string',
            'image' => 'mimes:jpg,png,jpeg,gif,svg',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        
        $foto = Foto::create([
            'title' => $request->input('title'),
        ]);

        $files = $request->file('image');
        
        if ($request->hasFile('image') && $request->file('image')->isValid()){
            $foto->addMedia($files)->toMediaCollection('fotos');
        }
        
        
        return new FotoResource($foto);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function show(Foto $foto)
    {
        return new FotoResource($foto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Foto $foto)
    {
        $files = $request->file('image');
        
        if ($request->hasFile('image') && $request->file('image')->isValid()){
            $foto->update([
                'image' => $foto->addMedia($files)->toMediaCollection('images')
            ]);
        }
        
        return new FotoResource($foto);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$id)
    {
        $foto = Media::findOrFail($id);
        $foto->delete();
        $task = Foto::findOrFail($request->fotoId);
        $task->delete();
        return response()->json(['msg' => 'News deleted successfully']);
    }
}

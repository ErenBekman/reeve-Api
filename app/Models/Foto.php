<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Foto extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['title'];

    public function getImageAttribute(){
        return $this->getFirstMediaUrl('fotos');
    }
    public function getImageIdAttribute(){
        // $mediaItems = $this->getMedia('fotos');
        // return  $mediaItems[0]->model_id;
        return $this->getMedia('fotos')->where('media_id', $this->primaryMediaId)->first();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;

class AddNew extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['author','title','content'];
    //'image',

    public function getImageAttribute(){
        return $this->getFirstMediaUrl('images');
        // return $this->getMedia('images');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getTotalAttribute() {
        return  $this->Select('options')->count();
    }
    public function getCount1Attribute() {
        return  $this->Where('options' ,'Çok İyi')->count();
    }
    public function getCount2Attribute() {
        return  $this->Where('options' ,'Memnunum')->count();
    }
    public function getCount3Attribute() {
        return  $this->Where('options' ,'Daha İyi Olabilirdi')->count();
    }
    public function getCount4Attribute() {
        return  $this->Where('options' ,'Beğenmiyorum.')->count();
    }
    public function getAvg1Attribute() {
        // $c1 = $this->count1;
        // $tot = $this->total;
        // return ($c1 / $tot) * 100;
        return ($this->count1 / $this->total) * 100;
    }
    public function getAvg2Attribute() {
        return ($this->count2 / $this->total) * 100;
    }
    public function getAvg3Attribute() {
        return ($this->count3 / $this->total) * 100;
    }
    public function getAvg4Attribute() {
        return ($this->count4 / $this->total) * 100;
    }

    // ->each(function ($user) {
    //     //
    // });
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Noti extends Model
{
    use HasFactory;
    protected $fillable = ['NameSurname','ComeDate','WhereFrom','WhoTook','DeliverDate'];

    public function getTotalyAttribute() {
        if(empty($this->DeliverData)){
            // return $this->Select($this->NameSurname)->count();
            return $this->each(function ($item, $key){
                if ($item['NameSurname'] == $this->NameSurname) {
                    return true;
                }
            });
        }else{
            return 0;
        }
    }
    protected $casts = [
        'ComeDate' => 'datetime',
        'DeliverDate' => 'datetime',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;


class Policecase extends Model
{
    use HasFactory;
    protected $table = 'policecases';
    protected $fillable = [
        'title',
        'act',
        'slug',
        'detail',
        'client_id',
        'lawyer_id',
        'status',
    ];

    public function hearings()
    {
        return $this->hasMany(Hearing::class,'case_id','id');
    }

   
}

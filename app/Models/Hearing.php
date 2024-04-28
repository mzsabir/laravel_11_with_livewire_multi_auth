<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Policecase;

class Hearing extends Model
{
    use HasFactory;
    protected $table = 'hearings';
    protected $fillable = [
        'case_id',
        'court',
        'judge',
        'city',
        'comment',
        'result',
        'hearing_date',
        'next_date'
    ];

    public function case()
    {
        return $this->belongsTo(Policecase::class, 'case_id', 'id');
    }
}

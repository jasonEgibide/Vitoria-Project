<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ActivityCentro extends Pivot
{
    protected $fillable = ['activity_id', 'centro_id', 'fecha', 'horario_inicio'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'fecha' => 'date',
        'horario_inicio' => 'time',
    ];

    public function activity(){
        return $this->belongsTo(Activity::class,"activity_id", "id");
    }

    public function centroCivico(){
        return $this->belongsTo(CentroCivico::class,"centro_id", "id");
    }
}

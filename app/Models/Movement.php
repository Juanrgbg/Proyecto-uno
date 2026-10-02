<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movement extends Model
{
    public const MOVEMENT_TYPE_IN = 'entrada';
    public const MOVEMENT_TYPE_DEVOLUTION = 'devolucion';
    public const MOVEMENT_TYPE_OUT = 'salida';

    use HasFactory;

    public function product():BelongsTo {
        return $this->belongsTo(Product::class);
    }
}

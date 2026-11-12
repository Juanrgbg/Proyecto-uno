<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Product extends Model
{
    use HasFactory;

    public function movements():HasMany {
        return $this->hasMany(Movement::class);
    }

    public function supplier():BelongsTo {
        return $this->belongsTo(Supplier::class);
    }
}

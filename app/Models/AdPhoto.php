<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdPhoto extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'url',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ads_photos';


    public function ad() {
        return $this->belongsTo(Ad::class, 'ad_id', 'id');
    }
}

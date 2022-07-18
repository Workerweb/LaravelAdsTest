<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    protected $appends = [
        'main_photo_url'
    ];
    public function photos() {
        return $this->hasMany(AdPhoto::class, 'ad_id', 'id');
    }

    public function getMainPhotoUrlAttribute()
    {   
        $photo = $this->hasMany(AdPhoto::class)->orderBy('id', 'desc')->first();
        if (!is_null($photo)) {
            return $photo->url;
        }
    }
}

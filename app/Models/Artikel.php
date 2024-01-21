<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Artikel extends Model
{
    use Sluggable;

    protected $table = 'das_artikel';

    protected $fillable = [
        'judul',
        'gambar',
        'isi',
        'status',
        'url_video'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul',
            ],
        ];
    }

    public function getGambarAttribute()
    {
        return $this->attributes['gambar'] ? Storage::url('artikel/' . $this->attributes['gambar']) : null;
    }

    public function getIsiAttribute()
    {
        return str_replace('//storage', '/storage', $this->attributes['isi']);
    }

    public function scopeStatus($query, $value = 1)
    {
        return $query->where('status', $value);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Championship extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'code',
        'title',
        'city_state',
        'city_id',
        'state_id',
        'date',
        'about',
        'gym_place',
        'info',
        'public_entrance',
        'type',
        'phase',
        'active_status',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    protected static function booted(): void
    {
        self::deleted(function (Championship $championship) {
            $championship->clearMediaCollection('cover');
        });

    }

    public function getDateFormatedAttribute ()
    {
        return $this->date->format('Y, d ') . __($this->date->format('M'));
    }

    public function getDateInputAttribute ()
    {
        return $this->date->format('Y-m-d');
    }

    public function getCoverAttribute ()
    {
        return $this->getFirstMediaUrl('cover');
    }

    public function setCoverAttribute (UploadedFile $img)
    {
        $collection = 'cover';
        $legend = $collection.'-'.\Illuminate\Support\Str::slug($this->title);

        $this->clearMediaCollection($collection);
        $this->addMedia($img)
            ->usingName($legend)
            ->usingFileName(md5($img->getClientOriginalName() . time()) . '.' . $img->getClientOriginalExtension())
            ->toMediaCollection($collection);
    }

}

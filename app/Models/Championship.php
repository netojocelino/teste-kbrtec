<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'feature_order',
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
        return $this->date->format('Y, d ') . substr(__($this->date->format('M')), 0, 3);
    }

    public function getDateInputAttribute ()
    {
        return $this->date->format('Y-m-d');
    }

    public function getCoverAttribute ()
    {
        return $this->getFirstMediaUrl('cover') ?: asset('/img/logo.svg');
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


    public function competitors (): HasMany
    {
        return $this->hasMany(Competitor::class, 'championship_id', 'id');
    }

    public function groups (): HasMany
    {
        return $this->hasMany(CompetitorGroups::class, 'championship_id');
    }

    public function randomCompetitors()
    {
        return $this->competitors()->inRandomOrder();
    }

}

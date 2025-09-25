<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;      // <-- Import
use Spatie\Sluggable\SlugOptions; // <-- Import
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory, HasSlug; // <-- Trait එක එකතු කරන්න

    // Mass assignable attributes
    protected $fillable = [
        'user_id',
        'district_id',
        'category_id',
        'title',
        'body',
        'slug',
        'is_anonymous',
        'is_resolved',
        'views_count',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title') // title එකෙන් slug හදයි
            ->saveSlugsTo('slug');       // slug column එකට save කරයි
    }

    // User relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
    //     return $this->belongsTo(Category::class);
    // }

    // District relationship (පසුව සාදමු)
    // public function district(): BelongsTo
    // {
    //     return $this->belongsTo(District::class);
    // }
}

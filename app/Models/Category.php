<?php
// app/Models/Category.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;      // <-- මේක Import කරන්න
use Spatie\Sluggable\SlugOptions; // <-- මේක Import කරන්න

class Category extends Model
{
    use HasFactory, HasSlug; // <-- HasSlug Trait එක මෙතනට එකතු කරන්න

    protected $fillable = ['name', 'slug', 'parent_id'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name') // 'name' column එකෙන් slug එක හදන්න
            ->saveSlugsTo('slug');      // 'slug' column එකේ save කරන්න
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MoonShine\UI\Fields\Phone;

class Newsletter extends Model
{
    protected $table = 'newsletters';
    protected $fillable = ['description', 'image'];

    public function newsLetterPhones()
    {
        return $this->belongsToMany(NewsLetterPhone::class, 'news_letter_phones');
    }



}

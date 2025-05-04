<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsLetterPhone extends Model
{
    protected $fillable = ['newsletter_id', 'phone'];

    public function newsletters()
    {
        return $this->belongsToMany(Newsletter::class, 'news_letter_phones');
    }


}


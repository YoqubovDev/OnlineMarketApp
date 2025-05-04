<?php

namespace App\Http\Controllers;

use App\Models\NewsLetterPhone;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'newsletter_id' => 'required|exists:newsletters,id',
            'phone' => 'required|string|max:20',
        ]);

        NewsletterPhone::create($validated);

        return back()->with('success', 'Phone number saved!');
    }

}

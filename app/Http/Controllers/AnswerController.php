<?php
// app/Http/Controllers/AnswerController.php

namespace App\Http\Controllers;

use App\Models\Question; // Question model එක import කරන්න
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $request->validate([
            'body' => 'required|string|min:5',
        ]);

        $question->answers()->create([
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        // Redirect back to the question page with a success message
        return back()->with('success', 'ඔබගේ පිළිතුර සාර්ථකව පළ කරන ලදී!');
    }
}

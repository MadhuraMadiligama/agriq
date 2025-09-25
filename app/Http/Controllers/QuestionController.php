<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Slug generation වලට
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource. (සියලුම ප්‍රශ්න පෙන්වනවා)
     */
    public function index()
    {
        // with 'user' and 'category'
        $questions = Question::with(['user', 'category'])->latest()->paginate(10);
        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource. (අලුත් ප්‍රශ්නයක් අසන form එක පෙන්වනවා)
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get(); // Get all categories
        return view('questions.create', compact('categories')); // Pass them to the view
    }

    /**
     * Store a newly created resource in storage. (අලුත් ප්‍රශ්නය database එකට save කරනවා)
     */
    // ... (use statements)

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id', // Validation එක
        ]);

        // Question create කරන්න user relationship එකෙන්
        $question = $request->user()->questions()->create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'category_id' => $validated['category_id'],
            'is_anonymous' => $request->has('is_anonymous'),
        ]);

        return redirect()->route('questions.show', $question->slug)
            ->with('success', 'ඔබගේ ප්‍රශ්නය සාර්ථකව පළ කරන ලදී!');
    }
    /**
     * Display the specified resource. (තනි ප්‍රශ්නයක් පෙන්වනවා)
     */
    // app/Http/Controllers/QuestionController.php
    public function show(Question $question)
    {
        // Eager load relationships for better performance
        $question->load(['user', 'category', 'answers.user']); // 'answers.user' මෙතනට එකතු කරන්න

        // Increment views count
        $question->increment('views_count');
        return view('questions.show', compact('question'));
    }

    // Edit, Update, Destroy methods are not needed for now, but will be added later if required.
}

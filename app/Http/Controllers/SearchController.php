<?php

namespace App\Http\Controllers;

use App\Models\Translation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //

    public function index()
    {
        $word_of_the_day = Translation::inRandomOrder(Carbon::now()->startOfDay()->toDateString())->first();
        $recent_updates = Translation::orderByDesc('updated_at')->limit(2)->get();
        return view('search', [
            'word' => $word_of_the_day,
            'recent_updates' => $recent_updates,
        ]);
    }

    public function search($term)
    {
        if (empty($term)) {
            return redirect(route('search'));
        }

        $results = Translation::whereFuzzy('english', $term)
            ->orderBy('relevance_english', 'desc')
            ->limit(20)
            ->get();

        return view('search-results', [
            'term' => $term,
            'results' => $results
        ]);
    }

}

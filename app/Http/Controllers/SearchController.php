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
        $word_of_the_day = Translation::whereApproved(true)->whereNotNull('pronunciation_upload')->inRandomOrder(Carbon::now()->startOfDay()->toDateString())->first();
        if ($word_of_the_day == null) {
            $word_of_the_day = Translation::whereApproved(true)->inRandomOrder(Carbon::now()->startOfDay()->toDateString())->first();
        }
        $agent = new \Jenssegers\Agent\Agent;
        $recent_updates = Translation::orderByDesc('updated_at')->limit(5)->get();
        return view('search', [
            'word' => $word_of_the_day,
            'recent_updates' => $recent_updates,
            'mobile' => $agent->isMobile(),
        ]);
    }

    public function search($term)
    {
        if (empty($term)) {
            return redirect(route('search'));
        }

        $results = Translation::whereApproved(true)->whereFuzzy('english', $term)
            ->orderBy('relevance_english', 'desc')
            ->limit(20)
            ->get();

        return view('search-results', [
            'term' => $term,
            'results' => $results
        ]);
    }

}

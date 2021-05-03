<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Builder;

class DiscoverController extends Controller
{
    //

    public function index()
    {
        $words = Translation::whereApproved(true)->inRandomOrder()->limit(20)->get();
        $tags = Tag::all();

        return view('discover', [
            'words' => $words,
            'tags' => $tags,
            'tag_param' => ''
        ]);
    }

    public function tagged($tag)
    {
        if (!is_numeric($tag)) {
            $tag = Tag::whereName($tag)->firstOrFail()->id;
        }
        $words = Translation::whereApproved(true)->whereHas('tags', function (Builder $query) use ($tag) {
            $query->where('tags.id', $tag);
        })->inRandomOrder()->limit(20)->get();
        $tags = Tag::all();
        return view('discover', [
            'words' => $words,
            'tags' => $tags,
            'tag_param' => '/'. $tag
        ]);
    }
}

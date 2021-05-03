<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContributionRequest;
use App\Models\Tag;
use App\Models\Translation;
use Illuminate\Http\Request;

class ContributeController extends Controller
{

    public function index()
    {
        $tags = Tag::all()->pluck('name', 'id');
        return view('contribute.index', [
            'tags' => $tags
        ]);
    }

    public function submit(ContributionRequest $request)
    {
        $validated = $request->validated();
        $validated['english'] = strtolower($validated['english']);
        $validated['pronunciation'] = strtolower($validated['pronunciation']);
        $validated['approved'] = false;

        if ($request->hasFile('upload')) {
            $uid = \Auth::guest() ? time() : \Auth::user()->id;
            $filename = $validated['english'] . '_' . $uid . '.' . $request->file('upload')->extension();
            $path = $request->file('upload')->storePubliclyAs('pronunciations', $filename, 'public');
            $validated['pronunciation_upload'] = $path;
        }

        if (!\Auth::guest()) {
            $model = \Auth::user()->translations()->create($validated);
        } else {
            $model = Translation::create($validated);
        }

        $tag = Tag::findOrFail($validated['tags']);
        $model->tags()->save($tag);
        return view('contribute.submitted');
    }

}

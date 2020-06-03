<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Page;
use App\Category;
use App\User;
use App\Tag;
use App\Photo;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::orderBy('updated_at', 'DESC')->paginate(10);

        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $photos = Photo::all();

        return view('admin.pages.create', compact('categories', 'tags', 'photos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        if(!isset($data['visible'])) {
            $data['visible'] = 0;
        } else {
            $data['visible'] = 1;
        }

        $data['user_id'] = Auth::id();
        $validator = Validator::make($data, [
            'category_id' => 'required',
            'title' => 'required|string',
            'summary' => 'required|max:150',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
            'photos' => 'required|array',
            'photos.*' => 'exists:photos,id',
            'body' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.pages.create')
            ->withErrors($validator)
            ->withInput();
        }

        $page = new Page;
        $page->fill($data);
        $saved = $page->save();
        if (!$saved) {
            return redirect()->route('admin.pages.index')
            ->with('failure', 'Salvataggio della pagina ' . $page->id . ' fallito');

        }

        if(isset($data['tags'])) {
            $page->tags()->attach($data['tags']);
        }
        if(isset($data['photos'])) {
            $page->photos()->attach($data['photos']);
        }

        return redirect()->route('admin.pages.show', $page->id)
        ->with('success', 'Salvataggio pagina avvenuto con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $photos = Photo::all();
        $page = Page::findOrFail($id);

        return view('admin.pages.edit', compact('page', 'categories', 'tags', 'photos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $userId = Auth::id();
        $author = $page->user_id;

        if ($userId != $author) {
            return redirect()->route('admin.pages.index')
            ->with('failure', 'Non sei autorizzato a modificare la pagina ' . $page->id);
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required|string',
            'summary' => 'required|max:150',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
            'photos' => 'required|array',
            'photos.*' => 'exists:photos,id',
            'body' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $page->fill($data);
        $updated = $page->update();
        if (!$updated) {
            return redirect()->back()
            ->with('failure', 'Modifica della pagina ' . $page->id . ' non riuscita');
        }

        $page->tags()->sync($data['tags']);
        $page->photos()->sync($data['photos']);

        return redirect()->route('admin.pages.index')
        ->with('success', 'Modifica della pagina ' .$page->id . ' avvenuta con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $userId = Auth::id();
        $author = $page->user_id;

        if ($userId != $author) {
            return redirect()->route('admin.pages.index')
            ->with('failure', 'Non sei autorizzato ad eliminare la pagina ' . $page->id);
        }

        $page->tags()->detach();
        $page->photos()->detach();

        $page->delete();

        return redirect()->route('admin.pages.index')
        ->with('success', 'Cancellazione della pagina ' . $page->id . ' riuscita');
    }
}

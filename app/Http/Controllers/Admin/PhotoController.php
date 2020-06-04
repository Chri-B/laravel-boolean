<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Page;
use App\Category;
use App\User;
use App\Tag;
use App\Photo;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::orderBy('updated_at', 'DESC')->paginate(10);
        return view('admin.photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.photos.create');
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
        $path = Storage::disk('public')->put('images', $data['path']);
        $data['path'] = $path;
        $data['user_id'] = Auth::id();
        $validator = Validator::make($data, [
            'name' => 'required|string|max:80',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $photo = new Photo;
        $photo->fill($data);
        $saved = $photo->save();
        if (!$saved) {
            return redirect()->route('admin.photos.index')
            ->with('failure', 'Salvataggio della foto ' . $photo->id . ' fallito');
        }

        return redirect()->route('admin.photos.show', $photo->id)
        ->with('success', 'Salvataggio foto avvenuto con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo = Photo::findOrFail($id);
        // dd($photo->path);
        return view('admin.photos.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        return view('admin.photos.edit', compact('photo'));
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
        $photo = Photo::findOrFail($id);
        $data = $request->all();
        $autore = $photo->user_id;
        $user = Auth::id();

        if ($autore != $user) {
            return redirect()->route('admin.photos.index')
            ->with('failure', 'Non sei autorizzato a modificare la foto ' . $photo->id);
        }
        if (!isset($data['path'])) {
            return redirect()->back()
            ->with('failure', 'problemi modifica foto ' . $photo->id);
        }

        $path_deleted = Storage::disk('public')->delete($photo['path']);
        if (!$path_deleted) {
            return redirect()->route('admin.photos.index')
            ->with('failure', 'Eliminazione vecchio foto_path non riuscita');
        }


        $new_path = Storage::disk('public')->put('images', $data['path']);
        $data['path'] = $new_path;
        $validator = Validator::make($data, [
            'name' => 'required|string|max:80',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $photo->fill($data);
        $updated = $photo->update();
        if (!$updated) {
            return redirect()->route('admin.photos.index')
            ->with('failure', 'Salvataggio della foto ' . $photo->id . ' fallito');
        }

        return redirect()->route('admin.photos.show', $photo->id)
        ->with('success', 'Modifica foto ' . $photo->id . ' riuscita');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $autore = $photo->user_id;
        $user = Auth::id();

        if ($autore != $user) {
            return redirect()->route('admin.photos.index')
            ->with('failure', 'Non sei autorizzato ad eliminare la foto ' . $photo->id);
        }
        $photo->pages()->detach();

        $deleted = $photo->delete();
        if (!$deleted) {
            return redirect()->route('admin.photos.index')
            ->with('failure', 'Eliminazione foto ' . $photo->id . ' non riuscita');
        }
        // dd($photo['path']);

        $path_deleted = Storage::disk('public')->delete($photo['path']);
        if (!$path_deleted) {
            return redirect()->route('admin.photos.index')
            ->with('failure', 'Eliminazione foto path ' . $photo->id . ' non riuscito');
        }


        return redirect()->route('admin.photos.index')
        ->with('success', 'Eliminazione foto ' . $photo->id . ' riuscita');
    }
}

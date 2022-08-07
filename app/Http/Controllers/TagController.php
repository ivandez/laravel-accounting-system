<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section = "Tags";

        $tags = Tag::paginate(15);

        $tagsCount = Tag::count();

        return view('tag.index', compact('section', 'tagsCount', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $section = "Crear tags";

        return view('tag.create', compact('section'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = new Tag();

        $tag->name = $request->nombre;

        $tag->save();

        return redirect()->route('tag.index')->with('success', 'Tag creado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        $section = 'Editar tag';

        return view('tag.edit', compact(['tag', 'section']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'nombre' => 'required|max:254'
        ]);

        $tag->name = $request->nombre;

        $tag->save();

        return redirect()->route('tag.index')->with('success', 'Tag actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();
        } catch (\Exception $e) {
            return redirect()->route('tag.index')->with('fail', 'No se puede eliminar el tag porque tiene productos asociados');
        }

        return redirect()->route('tag.index')->with('success', 'Tag eliminado exitosamente!');
    }
}

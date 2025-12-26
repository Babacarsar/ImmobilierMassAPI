<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::with('category')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.properties.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'location'    => ['required', 'string', 'max:255'],
            'surface'     => ['nullable', 'integer', 'min:0'],
            'rooms'       => ['nullable', 'integer', 'min:0'],
            'status'      => ['required', 'in:disponible,loué,vendu'],
            'featured'    => ['nullable', 'boolean'],
        ]);

        $data['featured'] = $request->boolean('featured');
        $data['slug'] = Str::slug($data['title']).'-'.uniqid();

        Property::create($data);

        // Upload des images si présentes
if ($request->hasFile('images')) {
    foreach ($request->file('images') as $index => $file) {
        $path = $file->store('properties', 'public');

        Image::create([
            'property_id' => $property->id,
            'path'        => $path,
            'is_main'     => $index === 0, // première image = principale
        ]);
    }
}


        return redirect()
            ->route('admin.properties.index')
            ->with('success', 'Bien créé avec succès.');
    }

    public function edit(Property $property)
    {
        $categories = Category::all();
        return view('admin.properties.edit', compact('property', 'categories'));
    }

    public function update(Request $request, Property $property)
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'location'    => ['required', 'string', 'max:255'],
            'surface'     => ['nullable', 'integer', 'min:0'],
            'rooms'       => ['nullable', 'integer', 'min:0'],
            'status'      => ['required', 'in:disponible,loué,vendu'],
            'featured'    => ['nullable', 'boolean'],
        ]);

        $data['featured'] = $request->boolean('featured');
        $data['slug'] = Str::slug($data['title']).'-'.$property->id;

        $property->update($data);


        // Ajout d'images supplémentaires
if ($request->hasFile('images')) {
    foreach ($request->file('images') as $file) {
        $path = $file->store('properties', 'public');

        Image::create([
            'property_id' => $property->id,
            'path'        => $path,
            'is_main'     => false,
        ]);
    }
}

        return redirect()
            ->route('admin.properties.index')
            ->with('success', 'Bien mis à jour.');
    }

    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()
            ->route('admin.properties.index')
            ->with('success', 'Bien supprimé.');
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::with(['category', 'mainImage'])
            ->where('status', 'disponible'); // seulement les biens disponibles

        // Filtres
        if ($request->category_slug) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category_slug);
            });
        }
        if ($request->price_min) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->price_max) {
            $query->where('price', '<=', $request->price_max);
        }
        if ($request->location) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
        if ($request->featured) {
            $query->where('featured', true);
        }

        $properties = $query->paginate(12);

        return response()->json($properties);
    }

    public function store(Request $request)
    {
        $property = Property::create($request->validated());
        return response()->json($property, 201);
    }

    public function show(Property $property)
    {
        $property->load(['category', 'images']);
        return response()->json($property);
    }

    public function update(Request $request, Property $property)
    {
        $property->update($request->validated());
        $property->load(['category', 'images']);
        return response()->json($property);
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return response()->json(['message' => 'Bien supprimé']);
    }
}

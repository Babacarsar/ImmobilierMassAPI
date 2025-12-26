@extends('layouts.admin')

@section('title', 'Ajouter un bien')

@section('content')
<h1 class="h3 mb-4">Ajouter un bien</h1>

<form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data">

    @csrf

    <div class="mb-3">
        <label class="form-label">Catégorie</label>
        <select name="category_id" class="form-select">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Titre</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        @error('title') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
        @error('description') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="row">
        <div class="mb-3 col-md-4">
            <label class="form-label">Prix</label>
            <input type="number" name="price" class="form-control" value="{{ old('price') }}">
            @error('price') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label">Surface (m²)</label>
            <input type="number" name="surface" class="form-control" value="{{ old('surface') }}">
            @error('surface') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label">Pièces</label>
            <input type="number" name="rooms" class="form-control" value="{{ old('rooms') }}">
            @error('rooms') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Localisation</label>
        <input type="text" name="location" class="form-control" value="{{ old('location') }}">
        @error('location') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Statut</label>
        <select name="status" class="form-select">
            <option value="disponible">Disponible</option>
            <option value="loué">Loué</option>
            <option value="vendu">Vendu</option>
        </select>
        @error('status') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1">
        <label class="form-check-label" for="featured">Mettre en avant</label>
    </div>

    <div class="mb-3">
    <label class="form-label">Photos du bien</label>
    <input type="file" name="images[]" class="form-control" multiple>
    <small class="text-muted">Vous pouvez sélectionner plusieurs images.</small>
    @error('images') <div class="text-danger">{{ $message }}</div> @enderror
</div>


    <button class="btn btn-primary">Enregistrer</button>
    <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@endsection

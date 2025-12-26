@extends('layouts.admin')

@section('title', 'Modifier le bien')

@section('content')
    <h1 class="h3 mb-4">Modifier le bien : {{ $property->title }}</h1>

    <form action="{{ route('admin.properties.update', $property) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Catégorie</label>
            <select name="category_id" class="form-select">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        @selected(old('category_id', $property->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text"
                   name="title"
                   class="form-control"
                   value="{{ old('title', $property->title) }}">
            @error('title') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description"
                      class="form-control"
                      rows="4">{{ old('description', $property->description) }}</textarea>
            @error('description') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="mb-3 col-md-4">
                <label class="form-label">Prix</label>
                <input type="number"
                       name="price"
                       class="form-control"
                       value="{{ old('price', $property->price) }}">
                @error('price') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3 col-md-4">
                <label class="form-label">Surface (m²)</label>
                <input type="number"
                       name="surface"
                       class="form-control"
                       value="{{ old('surface', $property->surface) }}">
                @error('surface') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3 col-md-4">
                <label class="form-label">Pièces</label>
                <input type="number"
                       name="rooms"
                       class="form-control"
                       value="{{ old('rooms', $property->rooms) }}">
                @error('rooms') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Localisation</label>
            <input type="text"
                   name="location"
                   class="form-control"
                   value="{{ old('location', $property->location) }}">
            @error('location') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Statut</label>
            <select name="status" class="form-select">
                <option value="disponible" @selected(old('status', $property->status) === 'disponible')>Disponible</option>
                <option value="loué" @selected(old('status', $property->status) === 'loué')>Loué</option>
                <option value="vendu" @selected(old('status', $property->status) === 'vendu')>Vendu</option>
            </select>
            @error('status') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input"
                   type="checkbox"
                   name="featured"
                   id="featured"
                   value="1"
                   @checked(old('featured', $property->featured))>
            <label class="form-check-label" for="featured">
                Mettre en avant
            </label>
        </div>

        {{-- Photos existantes --}}
        @if($property->images->count())
            <div class="mb-3">
                <label class="form-label d-block">Photos existantes</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($property->images as $image)
                        <div style="width: 140px;">
                            <img src="{{ asset('storage/'.$image->path) }}"
                                 class="img-fluid mb-1 border"
                                 alt="">
                            @if($image->is_main)
                                <span class="badge bg-success">Principale</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Ajouter de nouvelles photos --}}
        <div class="mb-4">
            <label class="form-label">Ajouter de nouvelles photos</label>
            <input type="file" name="images[]" class="form-control" multiple>
            <small class="text-muted">Vous pouvez ajouter plusieurs images, elles s’ajouteront à la galerie existante.</small>
        </div>

        <button class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection

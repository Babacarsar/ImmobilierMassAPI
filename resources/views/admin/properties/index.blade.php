@extends('layouts.admin')

@section('title', 'Biens immobiliers')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Biens immobiliers</h1>
        <a href="{{ route('admin.properties.create') }}" class="btn btn-primary">
            Ajouter un bien
        </a>
    </div>

    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Prix</th>
                <th>Statut</th>
                <th>Mis en avant</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($properties as $property)
                <tr>
                    <td>{{ $property->id }}</td>
                    <td>{{ $property->title }}</td>
                    <td>{{ optional($property->category)->name }}</td>
                    <td>{{ number_format($property->price, 0, ',', ' ') }} F</td>
                    <td>{{ ucfirst($property->status) }}</td>
                    <td>{{ $property->featured ? 'Oui' : 'Non' }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.properties.edit', $property) }}" class="btn btn-sm btn-secondary">
                            Modifier
                        </a>
                        <form action="{{ route('admin.properties.destroy', $property) }}" method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Supprimer ce bien ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">
                        Aucun bien pour le moment.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $properties->links() }}
@endsection

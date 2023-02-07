@extends('layouts.app');

@section('content')
<div class="container">
    @if (session('success_delete'))
        <div class="alert alert-warning" role="alert">
            The category with name "{{ session('success_delete')->name }}" was delite!
        </div>
    @endif

    <h1>Categoires</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Slug</th>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->slug }}</td>

                    <td>
                        <a href="{{ route('admin.categories.show', ['category' => $category]) }}" class="btn btn-primary">Show</a>
                        <a href="{{ route('admin.categories.edit', ['category' => $category]) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.categories.destroy', ['category' => $category]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-delete-me">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
</div>
@endsection

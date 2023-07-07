@extends('layouts.app')
@section('title', 'Categories')
@section('content')

    <div class="flex flex-col items-center justify-center">
        <h1 class="my-5 text-3xl font-semibold">Spend Categories</h1>

        <div class="w-full flex flex-col p-6">

            <table class="table">
                <thead>
                <tr>
                    <th class="px-4 text-2xl font-semibold py-2">Name</th>
                    <th class="px-4 text-2xl font-semibold py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td class="text-1xl">{{ $category->name }}</td>
                        <td class="flex gap-4 py-2">
                            <a href="{{ route('spend-categories.edit', $category) }}" >
                                <button class="btn btn-circle ring-2 ring-offset-2">
                                    Edit
                                </button>
                            </a>
                            <form action="{{ route('spend-categories.destroy', $category) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="delete {{ $category->name }}" class="btn btn-circle ring-2 ring-offset-2">
                                    <i class="fa-solid fa-2x fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                <a title="add a new category" href="{{ route('spend-categories.create') }}" class="m-3">
                    <button class="btn btn-circle ring-2 ring-offset-2">
                        <i class="fa-solid fa-2x fa-plus"></i>
                    </button>
                </a>
        </div>
        @if (session('success'))
            <div class="alert rounded alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>


@endsection

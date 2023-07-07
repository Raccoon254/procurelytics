@extends('layouts.app')
@section('title', 'Edit Category')
@section('content')

    <div class="flex flex-col items-center">
        <h1 class="my-5 text-3xl font-semibold">Edit Category</h1>

        <form action="{{ route('categories.update', $category) }}" method="POST" class="w-full flex items-center gap-4 justify-center">
            @csrf
            @method('PUT')

            <input type="text" id="name" name="name" value="{{ $category->name }}" class="max-w-xs input input-bordered ring-1 ring-offset-2 ring-gray-300">

            <div>
                <input type="submit" value="✔️" class="btn btn-circle ring ring-offset-2">
            </div>
        </form>
    </div>

@endsection

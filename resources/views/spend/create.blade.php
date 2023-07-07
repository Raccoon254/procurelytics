@extends('layouts.app')
@section('title', 'Create Category')
@section('content')

    <div class="flex flex-col items-center">
        <h1 class="my-5 text-3xl font-semibold">Create Category</h1>

        <form action="{{ route('spend-categories.store') }}" method="POST" class="w-full max-w-3xl mx-3">
            @csrf

            <div class="space-y-1">
                <label for="name" class="text-sm font-medium">Category Name:</label>
                <input type="text" id="name" name="name" class="w-full form-input rounded ring-1 ring-gray-300">
            </div>

            <div>
                <input type="submit" value="Create" class="btn btn-primary">
            </div>
        </form>
    </div>

@endsection

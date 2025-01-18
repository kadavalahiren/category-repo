@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">{{ isset($category) ? 'Edit' : 'Create' }} Category</h1>
    <form action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}" method="POST">
        @csrf
        @if(isset($category))
            @method('PUT')
        @endif

        <div class="row mb-3">
            <label for="name" class="col-md-3 col-form-label">Name:</label>
            <div class="col-md-9">
                <input type="text" id="name" name="name" class="form-control" value="{{ $category->name ?? '' }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="parent_id" class="col-md-3 col-form-label">Parent Category:</label>
            <div class="col-md-9">
                <select id="parent_id" name="parent_id" class="form-select">
                    <option value="">None</option>
                    @foreach($categories as $parent)
                        <option value="{{ $parent->id }}" {{ (isset($category) && $category->parent_id == $parent->id) ? 'selected' : '' }}>
                            {{ $parent->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">
                {{ isset($category) ? 'Update' : 'Create' }} Category
            </button>
        </div>
    </form>
</div>
@endsection

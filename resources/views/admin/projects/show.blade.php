@extends('layouts.app')

@section('title', config('app.name').' - '.$project->title)

@section('content')
<div class="container">
    <div class="row text-center">
        <div class="alert alert-{{ session('alert-type') }}">
            {{ session('message') }}
        </div>
        <div class="card col">
            <div class="card-header">
                <h5 class="card-title">{{ $project->title }}</h5>
            </div>
            <div class="card-body">
                <p class="card-text">{{ $project->description }}</p>
                <p class="card-text">{{ $project->date }}</p>
                <div>
                    @foreach ($project->technologies as $technology)
                    <span style="color: {{ $technology->color }}">{{ $technology->name }}</span>
                    @endforeach
                </div>
                <p style="color: {{ $project->type->color }}"> {{ $project->type->name }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Index</a>
                <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning">Edit</a>
                <form class="form-deleter d-inline" action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" data-element-name="{{ $project->title }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div> 
    </div>
</div>
@endsection
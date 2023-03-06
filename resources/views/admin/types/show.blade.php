@extends('layouts.app')

@section('title', config('app.name').' - '.$type->name)

@section('content')
<div class="container">
    <div class="row text-center">
        <div class="alert alert-{{ session('alert-type') }}">
            {{ session('message') }}
        </div> 
    </div>

    <h1 style="color: {{ $type->color }}">{{ $type->name }}</h1>
    @foreach ($type->projects as $project )
    <div class="card col">
        <div class="card-body">
            <h5 class="card-title">{{ $project->title }}</h5>
            <h6 class="card-subtitle">{{ $project->technologies }}</h6>
            <p class="card-text">{{ $project->description }}</p>
            <p class="card-text">{{ $project->date }}</p>
        </div>
        <div class="card-footer">
            <form class="form-deleter" action="{{ route('admin.projects.clear.type', $project) }}" method="POST" data-element-name="{{ $project->title }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Remove from {{ $type->name }}</button>
            </form>
        </div>
    </div> 
    @endforeach
</div>
@endsection
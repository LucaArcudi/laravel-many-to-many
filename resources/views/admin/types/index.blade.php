@extends('layouts.app')

@section('title', config('app.name').' - Types')

@section('content')
<div class="container">
    <div id="as" class="row">

        @if (session('message'))
        <div class="col-12">
            <div class="alert alert-{{ session('alert-type') }} mb-3">
                    {{ session('message') }}
            </div>
        </div>
        @endif

        <div class="col-12">
            
        </div>
        <div class="col-12">
            <table class="table table-bordered table-hover text-center">
                <thead class="align-middle">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">name</th>
                        <th scope="col">color</th>
                        <th scope="col">n. of projects</th>
                        <th scope="col">
                            <a href="{{ route('admin.types.create') }}" class="btn btn-lg btn-primary my-3 w-100">Add a new type</a>
                        </th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($types as $type)
                    <tr>
                        <th scope="row">{{ $type->id }}</th>
                        <td>{{ $type->name }}</td>
                        <td style="background-color: {{ $type->color }}">{{ $type->color }}</td>
                        <td>{{ count($type->projects) }}</td>
                        <td>
                            <a href="{{ route('admin.types.show', $type->id ) }}" class="btn btn-primary btn-sm w-100">Show</a>
                            <a href="{{ route('admin.types.edit', $type->id) }}" class="btn btn-warning btn-sm w-100">Edit</a>
                            <form class="form-deleter" action="{{ route('admin.types.destroy', $type->id) }}" method="POST" data-element-name="{{ $type->name }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm w-100">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
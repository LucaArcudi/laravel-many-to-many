@extends('layouts.app')

@section('title', config('app.name')." - Edit $type->name")

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 py-5 ">
            <h1>Update a type</h1>
        </div>
        <div class="col">
            @include('admin.types.partials.form', ['route' => 'admin.types.update' , 'type' => $type, 'method' => 'PUT', 'buttonName' => 'Edit'])
        </div>
    </div>
</div>
@endsection
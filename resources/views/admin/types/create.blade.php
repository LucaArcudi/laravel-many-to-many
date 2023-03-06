@extends('layouts.app')

@section('title', config('app.name').' - Add a new type')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 py-5 ">
            <h1>Add a new type</h1>
        </div>
        <div class="col">
            @include('admin.types.partials.form', ['route' => 'admin.types.store' , 'type' => $type, 'method' => 'POST', 'buttonName' => 'Create'])
        </div>
    </div>
</div>
@endsection
<form action=" {{ route($route, $type->id) }} " method="POST">
    @csrf
    @method($method)

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error )
                <li>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
    @endif
    

    <div class="mb-3">
        <label class="form-label">name</label>
        <input type="text" class="form-control" value="{{ old('name', $type->name) }}" name="name">
    </div>
    <div class="mb-3">
        <label class="form-label">color</label>
        <input type="color" class="form-control" value="{{ old('color', $type->color) }}" name="color">
    </div>
    <button type="submit" class="btn btn-primary">{{ $buttonName }}</button>
</form>
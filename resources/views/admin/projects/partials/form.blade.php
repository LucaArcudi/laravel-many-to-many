<form action=" {{ route($route, $project->id) }} " method="POST">
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
            @foreach ($technologies as $technology )
                <input type="checkbox" class="form-check-input" name="technologies[]" value="{{$technology->id}}"
                @if ($errors->any())
                    @checked(in_array($technology->id, old('technologies', [])))
                @else
                    @checked($project->technologies->contains($technology->id))
                @endif>
                <label class="form-check-label" for="technology_name">{{$technology->name}}</label>    
            @endforeach
    </div>
    <div class="mb-3">
        <label class="form-label">title</label>
        <input type="text" class="form-control" value="{{ old('title', $project->title) }}" name="title">
    </div>
    <div class="mb-3">
        <label class="form-label">description</label>
        <textarea class="form-control" name="description" rows="5" cols="33">{{ old('description', $project->description) }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">date</label>
        <input type="date" class="form-control" value="{{ old('date', $project->date) }}" name="date">
    </div>
    <div class="mb-3">
        <label for="type_name">type</label>
        <select class="form-control" id="type_name" name="type_id" >
            @foreach ($types as $type )
            <option value="{{ $type->id }}">{{ $type->name }}</option>    
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">{{ $buttonName }}</button>
</form>
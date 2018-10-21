<h3 class="col mb-md-4">Create new Meal</h3>
<form method="POST" action="{{ route('meals.store') }}">
    @csrf
    <div class="form-group row">
        <label for="inputNmame" class="col-sm-2 col-form-label">Title</label>
        <div class="col-sm-10">
            <input id="inputNmame" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>

            @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Category</label>
        <div class="col-sm-10">
            <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                <option value="">---</option>
                @foreach($categoryes as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
            @if ($errors->has('category_id'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('category_id') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPrice" class="col-sm-2 col-form-label">Price</label>
        <div class="col-sm-10">
            <input id="inputPrice" type="number" step="any" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price') }}" required autofocus>

            @if ($errors->has('price'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </div>
</form>

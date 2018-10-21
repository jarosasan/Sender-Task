<h3 class="col mb-md-4">Create new Side Dish</h3>
<form method="POST" action="{{ route('side-dishes.store') }}">
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
    <fieldset class="form-group">
        <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Type</legend>
            <div class="col-sm-10 text-left">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" id="gridRadios1" value="hot" >
                    <label class="form-check-label" for="gridRadios1">
                        Hot
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" id="gridRadios2" value="could">
                    <label class="form-check-label" for="gridRadios2">
                        Could
                    </label>
                </div>
            </div>
            @if ($errors->has('type'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
            @endif
        </div>
    </fieldset>
    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </div>
</form>

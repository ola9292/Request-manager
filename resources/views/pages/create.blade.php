@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/request" method="post">
            @csrf
             <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" name="text" class="form-control" id="exampleFormControlInput1" placeholder="Title">
              </div>
              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Body</label>
                <textarea class="form-control" name="body" id="" rows="3"></textarea>
              </div>
              <div>
                <button type="submit" class="btn btn-warning">Create</button>
              </div>
        </form>

    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('request.update', $item->id) }}" method="post">
            @csrf
            @method('PUT')
             <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" name="text" class="form-control" value="{{$item->text}}" placeholder="Title">
              </div>
              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Body</label>
                <textarea class="form-control" name="body" id="" rows="3">{{$item->body}}</textarea>
              </div>
              <div>
                <button type="submit" class="btn btn-warning">Update</button>
              </div>
        </form>

    </div>
@endsection

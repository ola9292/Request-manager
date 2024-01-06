@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Items List</h1>
    @if(session('success'))
    <div class="alert alert-info">
        {{ session('success') }}
    </div>
@endif
<div class="list-group">
    @if (count($items) > 0)
        @foreach ($items as $item)
            <a href="/request/{{$item->id}}/edit" class="list-group-item list-group-item-action" aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{$item->text}}</h5>

                    {{-- @isset($item->created_at)
                        <small>{{$item->created_at}}</small>
                    @endisset --}}
                    <form action="{{route('request.destroy',$item->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </div>

                <p class="mb-1">{{$item->body}}</p>

                <small>And some small print.</small>

            </a>
        @endforeach
    @else
            <p>No items to show, create a new item. 😉</p>
    @endif

  </div>
</div>


@endsection

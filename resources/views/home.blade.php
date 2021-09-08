@extends('layouts.template')

@section('content')
    <div class="shoeList">
        <h3 class="title mb-5">Daftar Sepatu</h3>
        <div class="row">
            @foreach ($shoes as $shoe)
                <div class="col-4 mb-5">
                    <div class="item card">
                        <img class="card-img-top" src="img/item/{{ $shoe->type }} {{ $shoe->shoeDetails->first()->color }}.jpg" alt="Shoes">
                        <div class="card-body">
                            <h5 class="card-title"> {{ $shoe->type }} </h5>
                            <p class="card-text"> {{ $shoe->excerpt }} </p>
                            <a href="/details/{{ $shoe->id }}&{{ $shoe->shoeDetails->first()->color }}&{{  $shoe->shoeDetails->first()->size }}"
                             class=" btn btn-primary">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection()

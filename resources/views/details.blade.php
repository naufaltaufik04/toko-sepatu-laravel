@extends('layouts.template')

@section('content')
    <div class="card details">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">
                    <img width=100% src="/img/item/{{ $shoeDetails->shoe->type }} {{ $shoeDetails->color }}.jpg" />
                    <!-- image by: https://www.adidas.com/us/ -->
                </div>

                <div class="details col-md-6 p-4">
                    <h1 class=" product-title">Adidas Type {{ $shoeDetails->shoe->type }}</h1>
                    <p class="product-description">{{ $shoeDetails->shoe->description }} </p>
                    <h4 class="price">Price: <span>{{ $shoeDetails->price }}</span></h4>
                    <h4 class="stocks">
                        <h4 style="color:#7ec17e;">Stock: {{ $shoeDetails->stock }}</h4>
                    </h4>

                    <div class="color">
                        <h5 class="title" style="padding-top:1rem">Color:
                            <div class="dropdown">
                                <button class="btn dropdown-toggle btn-success mt-2" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $shoeDetails->color }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    @foreach ($listOfColor as $color)
                                        <a class="dropdown-item"
                                            href="/details/{{ $shoeDetails->shoe_id . '&' . $color->color . '&' . $shoeDetails->size }}">
                                            {{ $color->color }}</a>
                                    @endforeach
                                </ul>
                            </div>
                        </h5>
                    </div>

                    <div class="size">
                        <h5 class="title" style="padding-top:1rem">Size:
                            <div class="dropdown">
                                <button class="btn dropdown-toggle btn-success mt-2" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $shoeDetails->size }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    @foreach ($listOfSize as $size)
                                        <a class="dropdown-item "
                                            href="/details/{{ $shoeDetails->shoe_id . '&' . $shoeDetails->color . '&' . $size->size }}">{{ $size->size }}</a>
                                    @endforeach
                                </ul>
                            </div>
                        </h5>
                    </div>

                    <div class="addToCart">
                        <button 
                            href="#" 
                            style="margin-top:40px;" 
                            class="btn btn-primary" 
                            role="button" 
                            aria-disabled="true"
                            @if($shoeDetails->stock == 0)
                                disabled
                            @endif>
                            Tambah Ke Keranjang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </body>


@endsection

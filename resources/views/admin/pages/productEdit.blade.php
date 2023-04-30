@extends('admin/layout/app')

@section('content')
    <main class="relative mt-[5rem] min-h-[400px] flex flex-col items-center justify-center">
        @if ($errors->any())
            <div class="error">
                <span>Error : </span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/product/update/{{$data->id}}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <label for="productName">Product Name</label>
            <input class="border" type="text" name="productName" value="{{ $data->productName }}"><br>
            <label for="price">Price</label>
            <input class="border-2" type="number" name="price" value="{{ $data->price }}"><br>
            <label for="description">Description</label>
            <input class="border-2" type="text" name="description" value="{{ $data->description }}"><br>
            <label for="category">Category</label>
            <select name="category">
                <option value="hijab" {{ $data->category == 'hijab' ? 'selected' : '' }}>Hijab</option>
                <option value="top" {{ $data->category == 'top' ? 'selected' : '' }}>Top</option>
                <option value="dress" {{ $data->category == 'dress' ? 'selected' : '' }}>Dress</option>
                <option value="bottom" {{ $data->category == 'bottom' ? 'selected' : '' }}>Bottom</option>
                <option value="blouse" {{ $data->category == 'blouse' ? 'selected' : '' }}>Blouse</option>
                <option value="goodies" {{ $data->category == 'goodies' ? 'selected' : '' }}>Goodies</option>
            </select><br>
            <label for="stock">Stock</label>
            <input class="border-2" type="number" name="stock" value="{{ $data->stock }}"><br>
            <label for="photo">Photo</label>
            <div class="w-10 h-10 bg-cover bg-center" style="background-image: url({{ url('storage/data-product/'.$data->photo) }});"></div>
            {{-- <form action="/product/delete/main-photo/{{ $data->id }}" method="post">
                @method('delete')
                @csrf
                <input type="submit" value="Delete">
            </form> --}}
            <input class="border-2" type="file" name="mainPhoto"><br><br>
            <input class="border-2" type="submit" value="Save">
        </form>
            <br>

            @for($i = 0; $i < 5; $i++)
                <label for="photo">Photo {{$i+1}}</label>    
                @if (isset($data->productPhoto[$i]))
                    <div class="w-10 h-10 bg-cover bg-center" style="background-image: url({{ url('storage/data-product/'.$data->productPhoto[$i]->photo) }});"></div>
                    <br>
                    <form action="/product/update/product-photo/{{ $data->productPhoto[$i]->id }}" method="POST" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <input class="border-2" type="file" name="photo">
                        <input type="submit" value="Update">
                    </form>
                    <form action="/product/delete/product-photo/{{ $data->productPhoto[$i]->id }}" method="POST">
                        @method('delete')
                        @csrf
                        <input type="submit" value="Delete">
                    </form>
                    <br>
                @else                
                    <form action="/product/store/product-photo/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input class="border-2" type="file" name="photo">
                        <input type="submit" value="Add">
                    </form>
                    <br>
                @endif
            @endfor
            {{-- <label for="photo">Photo 2</label>
            <input class="border-2" type="file" name="photo[]"><br>
            <label for="photo">Photo 3</label>
            <input class="border-2" type="file" name="photo[]"><br>
            <label for="photo">Photo 4</label>
            <input class="border-2" type="file" name="photo[]"><br>
            <label for="photo">Photo 5</label>
            <input class="border-2" type="file" name="photo[]"><br> --}}

            
    </main>
@endsection
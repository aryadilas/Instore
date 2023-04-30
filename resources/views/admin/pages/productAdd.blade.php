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
        <form action="/product/add" method="post" enctype="multipart/form-data">
            @csrf
            <label for="productName">Product Name</label>
            <input class="border" type="text" name="productName"><br>
            <label for="price">Price</label>
            <input class="border-2" type="number" name="price"><br>
            <label for="description">Description</label>
            <input class="border-2" type="text" name="description"><br>
            <label for="category">Category</label>
            <select name="category">
                <option value="hijab">Hijab</option>
                <option value="top">Top</option>
                <option value="dress">Dress</option>
                <option value="bottom">Bottom</option>
                <option value="blouse">Blouse</option>
                <option value="goodies">Goodies</option>
            </select><br>
            <label for="stock">Stock</label>
            <input class="border-2" type="number" name="stock"><br>
            <label for="photo">Photo</label>
            <input class="border-2" type="file" name="mainPhoto"><br><br>

            <label for="photo">Photo 1</label>
            <input class="border-2" type="file" name="photo[]"><br>
            <label for="photo">Photo 2</label>
            <input class="border-2" type="file" name="photo[]"><br>
            <label for="photo">Photo 3</label>
            <input class="border-2" type="file" name="photo[]"><br>
            <label for="photo">Photo 4</label>
            <input class="border-2" type="file" name="photo[]"><br>
            <label for="photo">Photo 5</label>
            <input class="border-2" type="file" name="photo[]"><br>

            <input class="border-2" type="submit" value="Save">
        </form>
    </main>
@endsection
@extends('admin/layout/app')

@section('content')
    <main class="relative mt-[5rem] min-h-[400px] flex flex-col items-center justify-center">
        <a href="/product/add" class="text-blue-500">Add Product</a>
        <table class="border w-[48rem]">
            <tr class="border">
                <th>No</th>
                <th>Product Name</th>
                <th>Photo</th>
                <th>Price</th>
                <th>Description</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            @foreach ($data as $i => $product)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{$product->productName}}</td>
                    <td>
                        <div class="w-5 h-5 bg-cover" style="background-image: url({{ url('storage/data-product/'.$product->photo) }})"></div>
                        @foreach ($product->productPhoto as $photo)
                            <div class="w-5 h-5 bg-cover" style="background-image: url({{ url('storage/data-product/'.$photo->photo) }})"></div>
                        @endforeach
                    </td>
                    <td>{{ money($product->price, "Rp") }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ ucfirst($product->category) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->deleted_at ? 'Deleted' : 'Listed' }}</td>
                    <td>
                        
                        <a href="/product/edit/{{$product->id}}">Edit</a>

                        @if ($product->deleted_at)
                        
                            <form action="/product/restore/{{$product->id}}" method="POST">
                                @method('patch')
                                @csrf
                                <input type="submit" value="Restore">
                            </form>
                        
                        @else
                        
                            <form action="/product/delete/{{$product->id}}" method="POST">
                                @method('patch')
                                @csrf
                                <input type="submit" value="Delete">
                            </form>
                        
                        @endif
                    </td>
                </tr>    
            @endforeach
            
        </table>
    </main>
@endsection
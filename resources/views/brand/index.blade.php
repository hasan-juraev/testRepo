<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">            
            All Brand             
        </h2>
    </x-slot>

    <div class="py-12">
        
        <!-- Table -->
        <div class="container">
            
            <div class="row">
                <div class="col-md-8">
                    <div class="card">

                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> {{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="card-header">
                               All Brand 
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Serial Number</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody> 
                                <!-- @php($i = 1) -->
                                <!-- foreach loop to display brand name and brand image -->
                                @foreach($brands as $brand)
                                <tr>
                                    <th scope="row"> {{ $brands->firstItem()+$loop->index }} </th>
                                    <td> {{ $brand->brand_name }}  </td>
                                    <td> <img src="{{ asset($brand->brand_image) }}" style="height: 40px; width: 30px;" alt=""></td>
                                    <!-- Used, Query Builder. Carbon\Carbon::parse is added -->
                                    <td>
                                        @if($brand->created_at == NULL)
                                        <span class='text-danger'> No Date Set</span>
                                        @else
                                        {{ Carbon\Carbon::parse($brand ->created_at)->diffForHumans() }}
                                        @endif
                                    </td>   
                                    
                                    <!-- edit, update using Eloquent ORM -->
                                    <td>
                                        <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-success">Edit</a>
                                        <a href="{{ url('brand/delete/'. $brand->id)}}" class="btn btn-danger">Delete</a>
                                    </td>

                                </tr>
                                @endforeach           

                            </tbody>
                        </table>
                        {{ $brands->links()}}

                    </div>
                </div>
                <!-- !col-md-8 -->

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">  Add Brand </div>
                        <div class="card-body">

                            <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    
                                </div>

                                <button type="submit" class="btn bg-primary btn-primary">Add Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- !Table -->



        <!-- Trash List began -->
        <!-- Trash List -->
       

</x-app-layout>

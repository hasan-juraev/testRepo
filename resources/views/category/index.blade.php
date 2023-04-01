<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            
            All Category 
            
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
                               All Category 
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Serial Number</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody> 
                                <!-- @php($i = 1) -->
                                @foreach($categories as $category)
                                <tr>
                                    <th scope="row"> {{ $categories->firstItem()+$loop->index }} </th>
                                    <td> {{ $category->category_name }}</td>
                                    <td> {{ $category->user-> name }}</td>
                                    <!-- Used, Query Builder. Carbon\Carbon::parse is added -->
                                    <td>
                                        @if($category->created_at == NULL)
                                        <span class='text-danger'> No Date Set</span>
                                        @else
                                        {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                                        @endif
                                    </td>   
                                    
                                    <!-- edit, update using Eloquent ORM -->
                                    <td>
                                        <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-success">Edit</a>
                                        <a href="{{ url('softdelete/category/'. $category->id)}}" class="btn btn-danger">Delete</a>
                                    </td>

                                </tr>
                                @endforeach           

                            </tbody>
                        </table>
                        {{ $categories->links()}}

                    </div>
                </div>
                <!-- !col-md-8 -->

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">  Add Category </div>
                        <div class="card-body">
                            <form action="{{ route('store.category') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category Name</label>
                                    <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    
                                </div>
                            
                                <button type="submit" class="btn bg-primary btn-primary">Add Category</button>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- !Table -->





        <!-- Trash List began -->
        <!-- Trash List -->
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

                        <div class="card-header">Trash List </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Serial Number</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody> 
                                <!-- @php($i = 1) -->
                                @foreach($trashCat as $category)
                                <tr>
                                    <th scope="row"> {{ $categories->firstItem()+$loop->index }} </th>
                                    <td> {{ $category->category_name }}</td>
                                    <td> {{ $category->user-> name }}</td>
                                    <!-- Used, Query Builder. Carbon\Carbon::parse is added -->
                                    <td>
                                        @if($category->created_at == NULL)
                                        <span class='text-danger'> No Date Set</span>
                                        @else
                                        {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                                        @endif
                                    </td>   
                                    
                                    <!-- edit, update using Eloquent ORM -->
                                    <td>
                                        <a href="{{ url('category/restore/'.$category->id) }}" class="btn btn-success">Restore</a>
                                        <a href="{{ url('pdelete/category/'.$category->id) }}" class="btn btn-danger">P Delete</a>
                                    </td>

                                </tr>
                                @endforeach           

                            </tbody>
                        </table>
                        {{ $trashCat->links()}}

                    </div>
                </div>
                <!-- !col-md-8 -->

                <div class="col-md-4">
                    
                </div>
                
            </div>
        </div>
        <!-- !Trash List -->

    </div>
</x-app-layout>

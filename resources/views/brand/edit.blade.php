<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">            
            Edit Brand            
        </h2>
    </x-slot>

 

    <div class="py-12">
        
        <!-- Table -->
        <div class="container">

        
            
            <div class="row"> 
                 
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">  Edit Brand </div>
                        <div class="card-body">
                        <!-- success message -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong> {{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                            <!-- update category name -->
                            <form action=" {{ url('brand/update/' .$brands->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{ $brands->brand_image }}">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Update Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" 
                                    aria-describedby="emailHelp" value="{{ $brands-> brand_name }}">

                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Update Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control" id="exampleInputEmail1" 
                                    aria-describedby="emailHelp" value="{{ $brands-> brand_image }}">

                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    
                                </div>

                                <div class="form-group">
                                    <img src="{{ asset($brands->brand_image) }}" style="width:400px; height:200px;" >
                                </div>
                            
                                <button type="submit" class="btn bg-primary btn-primary">Update Brand</button>
                            </form>

                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
        <!-- !Table -->

    </div>
</x-app-layout>

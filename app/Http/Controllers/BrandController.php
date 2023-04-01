<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Carbon;




class BrandController extends Controller
{   
    public function AllBrand(){
        
        $brands = Brand::latest()->paginate(5);       
        return view('brand.index', compact('brands'));
    }

    
    public function StoreBrand(Request $request){
        
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
            
        ],
        [
            'brand_name.required' => 'Please Input Brand Name',
            'brand_image.min' => 'Brand Longer than 4 chars',
            
        ]);

        $brand_image = $request->file('brand_image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $upload_location = 'image/brand/';
        $last_img = $upload_location.$img_name;
        $brand_image->move($upload_location, $img_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'brand inserted successfully!');
        

    }

    public function Edit($id){
        $brands = Brand::find($id);
        return view('brand.edit', compact('brands'));
    }

    // update function
    public function Update(Request $request, $id){

        $validated = $request->validate([
            'brand_name' => 'required|min:4',            
        ],
        [
            'brand_name.required' => 'Please Input Brand Name',
            'brand_image.min' => 'Brand Longer than 4 chars',
            
        ]);

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');
        
        if($brand_image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $upload_location = 'image/brand/';
            $last_img = $upload_location.$img_name;
            $brand_image->move($upload_location, $img_name);
    
           
            unlink($old_image); //problem is here
            // Storage::delete($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now()
            ]);
    
            return Redirect()->back()->with('success', 'brand updated successfully!');

        } else{
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,                
                'created_at' => Carbon::now()
            ]);
    
            return Redirect()->back()->with('success', 'brand updated successfully!');
            

        }

       
    }

}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SliderModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
   public function index(){
      $sliders = SliderModel::all();
      return view('admin.Home.slider',compact('sliders'));
   }

   public function storeSlider(Request $request){
      $validateData = $request->validate([
         'top_sub_heading' => 'required',
         'heading' => 'required|string',
         'buttomSubHeading' => 'required|string',
         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
         'moreInfoLink' => 'required|url'
      ]);

      Log::info('Validated data:', $validateData);

      $imagePath = null;
      if($request->hasFile('image')){
         $imagePath = $request->file('image')->store('slider','public');
      }

      SliderModel::create([
         'top_sub_heading' => $validateData['top_sub_heading'],
         'heading' => $validateData['heading'],
         'bottom_sub_heading' => $validateData['buttomSubHeading'],
         'image_link' => $imagePath,
         'more_info_link' => $validateData['moreInfoLink']
      ]);

      return redirect()->back()->with('success','Slide added successfully.');
   }

   public function updateSlider(Request $request){
      $validateData = $request->validate([
         'top_sub_heading' => 'required',
         'heading' => 'required|string',
         'bottom_sub_heading' => 'required|string',
         'moreInfoLink' => 'required|url',
      ]);

      if($request->hasFile('image')){
         $imagePath = $request->file('image')->store('slider','public');
      }

      $update = SliderModel::find($request->slider_id);
      $update->top_sub_heading = $validateData['top_sub_heading'];
      $update->heading = $validateData['heading'];
      $update->bottom_sub_heading = $validateData['bottom_sub_heading'];
      $update->more_info_link = $validateData['moreInfoLink'];

      if($request->hasFile('image')){
         $update->image_link = $imagePath;
      }
      $update->save();
         return redirect()->back()->with('success','Slide updated successfully.');
   }

   public function destroy($id)
   {
      $slider = SliderModel::find($id);
      if (!$slider) {
         return redirect()->back()->with('error', 'Slider not found.');
      }

      if ($slider->image_link) {
        Storage::disk('public')->delete($slider->image_link);
    }

      $slider->delete();

      return redirect()->back()->with('success', 'Slider deleted successfully.');
   }

}

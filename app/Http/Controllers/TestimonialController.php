<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    // Fetch testimonial
    public function getTestimonial(){
        $testimonials = Testimonial::all();

        if ($testimonials) {
            return response()->json($testimonials);
        }        
    }

    // Create and update testimonial
    public function createTestimonial(Request $request){
        $Testimonial = new Testimonial;

        $testimonialName = $request->input('name');
        $testimonialText = $request->input('text');
        $testimonialFlag = $request->input('flag');

        if($request->id){
            $Testimonial = Testimonial::find($request->id);
            $testimonialName = $testimonialName ? $testimonialName : $Testimonial->name;
            $testimonialText = $testimonialText ? $testimonialText : $Testimonial->text;
            $testimonialFlag = $testimonialFlag ? $testimonialFlag : $Testimonial->flag;
        }
   
        $Testimonial->name = $testimonialName;
        $Testimonial->text = $testimonialText;
        $Testimonial->flag = $testimonialFlag;
        $Testimonial->save();

        if($Testimonial){
            return response()->json(['data' => $Testimonial, 'message' => 'Testimonial created successfully'], 201);
        }
    }

    // Delete testimonial
    public function deleteTestimonial($id){
        $Testimonial = Testimonial::find($id);
        $Testimonial->delete();
        return response()->json(['message' => 'Testimonial deleted successfully'], 201);
    }
}

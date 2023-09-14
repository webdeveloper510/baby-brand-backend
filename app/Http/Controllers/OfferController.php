<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use URL;

class OfferController extends Controller
{
    // Fetch offer page content
    public function getOfferPageContent(){
        $offerPageContent = Offer::with('category')->get();

        if ($offerPageContent) {
            return response()->json($offerPageContent);
        }        
    }

    // Create and update offer page content
    public function createOfferPageContent(Request $request){
        $url = URL::to('/'); 
        $customizedProductUrl = '';

        $offerPageContent = new Offer;
        
        // Upload product image to public upload/OfferPage folder
        if ($request->hasFile('product_image')) {
            $product_image = $request->file('product_image');
            $productFileName = $product_image->getClientOriginalName();
            $customizedProductUrl = $url . '/upload/OfferPage/' . $productFileName;
            $product_image->move(public_path('upload/OfferPage/'), $productFileName);
        }

        $productTitle = $request->input('product_title');
        $productText = $request->input('product_text');
        $category_id = $request->input('category_id');

        if($request->id){
            $offerPageContent = Offer::find($request->id);
            $productTitle = $productTitle ? $productTitle : $offerPageContent->product_title;
            $productText = $productText ? $productText : $offerPageContent->product_text;
            $customizedProductUrl = $customizedProductUrl ? $customizedProductUrl : $offerPageContent->product_image;
            $category_id = $category_id ? $category_id : $offerPageContent->category_id;
        }
   
        $offerPageContent->product_title = $productTitle;
        $offerPageContent->product_text = $productText;
        $offerPageContent->product_image = $customizedProductUrl;
        $offerPageContent->category_id = $category_id; 
        $offerPageContent->save();

        if($offerPageContent){
            return response()->json(['data' => $offerPageContent, 'message' => 'Product created successfully'], 201);
        }
    }

    // Delete offer page content
    public function deleteOfferPageContent($id){
        $offerPageContent = Offer::find($id);
        $offerPageContent->delete();
        return response()->json(['message' => 'Product deleted successfully'], 201);
    }
}

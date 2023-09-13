<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use URL;

class BannerController extends Controller
{
    // Fetch banner content
    public function getBannerContent(){
        $bannerContent = Banner::all();

        if ($bannerContent) {
            return response()->json($bannerContent);
        }        
    }

    // Create and update banner content
    public function createBannerContent(Request $request){  
        $url = URL::to('/');      
        $customizedBannerUrl = '';          
        
        $bannerContent = new Banner;

        // Upload banner image to public upload/Banner folder
        if ($request->hasFile('banner_image')) {
            $banner_image = $request->file('banner_image');
            $bannerFileName = $banner_image->getClientOriginalName();
            $customizedBannerUrl = $url . '/upload/Banner/' . $bannerFileName;
            $banner_image->move(public_path('upload/Banner/'), $bannerFileName);
        }
        
        $bannerTitle = $request->input('banner_title');
        $bannerText = $request->input('banner_text');
        $bannerFlag = $request->input('flag');

        if($request->id){
            $bannerContent = Banner::find($request->id);
            $bannerTitle = $bannerTitle ? $bannerTitle : $bannerContent->banner_title;
            $bannerText = $bannerText ? $bannerText : $bannerContent->banner_text;
            $customizedBannerUrl = $customizedBannerUrl ? $customizedBannerUrl : $bannerContent->banner_image;
            $bannerFlag = $bannerFlag ? $bannerFlag : $bannerContent->flag;
        }
   
        $bannerContent->banner_title = $bannerTitle;
        $bannerContent->banner_text = $bannerText;
        $bannerContent->banner_image = $customizedBannerUrl;  
        $bannerContent->flag = $bannerFlag;      
        $bannerContent->save();

        if($bannerContent){
            return response()->json(['data' => $bannerContent, 'message' => 'Banner content created successfully'], 201);
        }
    }

    // Delete banner content
    public function deleteBannerContent($id){
        $bannerContent = Banner::find($id);
        $bannerContent->delete();
        return response()->json(['message' => 'Banner content deleted successfully'], 201);
    }
}

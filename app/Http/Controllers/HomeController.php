<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomePageContent;
use URL;

class HomeController extends Controller
{
    // Fetch home page content
    public function getHomePageContent(){
        $homePageContent = HomePageContent::all();

        if ($homePageContent) {
            return response()->json($homePageContent);
        }        
    }

    // Create and update home page content
    public function createHomePageContent(Request $request){
        $url = URL::to('/');        
        $customizedPeekapooUrl = '';
        $customizedStoryUrl = '';
        $customizedWinnerUrlImage ='';

        $homePageContent = new HomePageContent;
        
        // Upload multiple winner image to public/HomePage folder
        $uploadedImageNames = [];
        if ($request->hasFile('winner_image')) {
            $winner_images = $request->file('winner_image');

            foreach ($winner_images as $winner_image) {
                $winnerfilename = $winner_image->getClientOriginalName();
                $customizedWinnerUrl = $url . '/upload/HomePage/' . $winnerfilename;
                $winner_image->move(public_path('upload/HomePage/'), $winnerfilename);
                $uploadedImageNames[] = $customizedWinnerUrl;
            }
            $customizedWinnerUrlImage = json_encode($uploadedImageNames);
        }
       
        // Upload peekapoo image to public/HomePage folder
        if ($request->hasFile('peekapoo_image')) {     
            $peekapoo_image = $request->file('peekapoo_image');
            $peekapoofilename = $peekapoo_image->getClientOriginalName();
            $customizedPeekapooUrl = $url . '/upload/HomePage/' . $peekapoofilename;
            $peekapoo_image->move(public_path('upload/HomePage/'), $peekapoofilename);
        }

        // Upload story image to public/HomePage folder
        if ($request->hasFile('story_image')) {
            $story_image = $request->file('story_image');
            $storyfilename = $story_image->getClientOriginalName();
            $customizedStoryUrl = $url . '/upload/HomePage/' . $storyfilename;
            $story_image->move(public_path('upload/HomePage/'), $storyfilename);
        } 

        $banner_time = $request->input('banner_time');
        $peekapoo_title = $request->input('peekapoo_title');
        $peekapoo_text = $request->input('peekapoo_text');
        $story_title = $request->input('story_title');
        $story_text = $request->input('story_text');

        if($request->id){
            $homePageContent = HomePageContent::find($request->id);
            $banner_time = $banner_time ? $banner_time : $homePageContent->banner_time;
            $customizedWinnerUrlImage = $uploadedImageNames ? $customizedWinnerUrlImage : $homePageContent->winner_image;
            $peekapoo_title = $peekapoo_title ? $peekapoo_title : $homePageContent->peekapoo_title; 
            $peekapoo_text = $peekapoo_text ? $peekapoo_text : $homePageContent->peekapoo_text;
            $customizedPeekapooUrl = $customizedPeekapooUrl ? $customizedPeekapooUrl : $homePageContent->peekapoo_image;
            $story_title = $story_title ? $story_title : $homePageContent->story_title;            
            $story_text = $story_text ? $story_text : $homePageContent->story_text;            
            $customizedStoryUrl = $customizedStoryUrl ? $customizedStoryUrl : $homePageContent->story_imag;         
        }
   
        $homePageContent->banner_time = $banner_time;
        $homePageContent->winner_image = $customizedWinnerUrlImage;
        $homePageContent->peekapoo_title = $peekapoo_title;
        $homePageContent->peekapoo_text = $peekapoo_text;
        $homePageContent->peekapoo_image = $customizedPeekapooUrl;
        $homePageContent->story_title = $story_title;
        $homePageContent->story_text = $story_text;
        $homePageContent->story_image = $customizedStoryUrl;
        $homePageContent->save();

        if($homePageContent){
            return response()->json(['data' => $homePageContent, 'message' => 'Home page content created successfully'], 201);
        }
    }

    // Delete home page content
    public function deleteHomePageContent($id){
        $homePageContent = HomePageContent::find($id);
        $homePageContent->delete();
        return response()->json(['message' => 'Home page content deleted successfully'], 201);
    } 

}

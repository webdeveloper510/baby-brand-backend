<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use URL;

class BlogController extends Controller
{
    // Fetch blog page content
    public function getBlogPageContent(){
        $blogPageContent = Blog::all();

        if ($blogPageContent) {
            return response()->json($blogPageContent);
        }        
    }

    // Create and update blog page content
    public function createBlogPageContent(Request $request){
        $url = URL::to('/');      
        $customizedBlogPostUrl = ''; 

        $blogPageContent = new Blog;
        
        // Upload blog post image to public upload/BlogPage folder
        if ($request->hasFile('blog_post_image')) {
            $blog_post_image = $request->file('blog_post_image');
            $blogPostFileName = $blog_post_image->getClientOriginalName();
            $customizedBlogPostUrl = $url . '/upload/BlogPage/' . $blogPostFileName;
            $blog_post_image->move(public_path('upload/BlogPage/'), $blogPostFileName);
        }

        $blog_post_title = $request->input('blog_post_title');
        $blog_post_text = $request->input('blog_post_text');

        if($request->id){
            $blogPageContent = Blog::find($request->id);
            $blog_post_title = $blog_post_title ? $blog_post_title : $blogPageContent->blog_post_title;
            $blog_post_text = $blog_post_text ? $blog_post_text : $blogPageContent->blog_post_text;
            $customizedBlogPostUrl = $customizedBlogPostUrl ? $customizedBlogPostUrl : $blogPageContent->blog_post_image;
        }
         
        $blogPageContent->blog_post_title = $blog_post_title;
        $blogPageContent->blog_post_text = $blog_post_text;
        $blogPageContent->blog_post_image = $customizedBlogPostUrl;
        $blogPageContent->save();

        if($blogPageContent){
            return response()->json(['data' => $blogPageContent, 'message' => 'Blog post created successfully'], 201);
        }
    }

    // Delete blog page content
    public function deleteBlogPageContent($id){
        $blogPageContent = Blog::find($id);
        $blogPageContent->delete();
        return response()->json(['message' => 'Blog post deleted successfully'], 201);
    }
}

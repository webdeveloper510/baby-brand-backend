<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Fetch category
    public function getCategory(){
        $category = Category::all();

        if ($category) {
            return response()->json($category);
        }        
    }

    // Create and update category
    public function createCategory(Request $request){
        $category = new Category;     

        $categoryName = $request->input('name');

        if($request->id){
            $category = Category::find($request->id);            
            $categoryName = $categoryName ? $categoryName : $category->name;
        }
   
        $category->name = $categoryName;
        $category->save();

        if($category){
            return response()->json(['data' => $category, 'message' => 'Category created successfully'], 201);
        }
    }

    // Delete category
    public function deleteCategory($id){
        $category = Category::find($id);
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully'], 201);
    }
}

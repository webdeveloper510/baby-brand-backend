<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distributor;

class DistributorController extends Controller
{
    // Fetch distributor page content
    public function getDistributorPageContent(){
        $distributorPageContent = Distributor::all();

        if ($distributorPageContent) {
            return response()->json($distributorPageContent);
        }        
    }

    // Create and update distributor page content
    public function createDistributorPageContent(Request $request){
        $distributorPageContent = new Distributor;

        $faq_title = $request->input('faq_title');
        $faq_text = $request->input('faq_text');

        if($request->id){
            $distributorPageContent = Distributor::find($request->id);
            $faq_title = $faq_title ? $faq_title : $distributorPageContent->faq_title;
            $faq_text = $faq_text ? $faq_text : $distributorPageContent->faq_text;
        }
   
        $distributorPageContent->faq_title = $faq_title;
        $distributorPageContent->faq_text = $faq_text;
        $distributorPageContent->save();

        if($distributorPageContent){
            return response()->json(['data' => $distributorPageContent, 'message' => 'Distributor page content created successfully'], 201);
        }
    }

    // Delete distributor page content
    public function deleteDistributorPageContent($id){
        $distributorPageContent = Distributor::find($id);
        $distributorPageContent->delete();
        return response()->json(['message' => 'Distributor page content deleted successfully'], 201);
    }
}

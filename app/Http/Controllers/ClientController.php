<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\Client;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;

class ClientController extends Controller
{
    // Fetch client page content
    public function getClientPageContent(){
        $clientPageContent = Client::all();

        if ($clientPageContent) {
            return response()->json($clientPageContent);
        }        
    }

    // Create and update client page content
    public function createClientPageContent(Request $request){
        $clientPageContent = new Client;

        $faq_title = $request->input('faq_title');
        $faq_text = $request->input('faq_text');

        if($request->id){
            $clientPageContent = Client::find($request->id);
            $faq_title = $faq_title ? $faq_title : $clientPageContent->faq_title;
            $faq_text = $faq_text ? $faq_text : $clientPageContent->faq_text;
        }
   
        $clientPageContent->faq_title = $faq_title;
        $clientPageContent->faq_text = $faq_text;
        $clientPageContent->save();

        if($clientPageContent){
            return response()->json(['data' => $clientPageContent, 'message' => 'Client page content created successfully'], 201);
        }
    }

    // Delete client page content
    public function deleteClientPageContent($id){
        $clientPageContent = Client::find($id);
        $clientPageContent->delete();
        return response()->json(['message' => 'Client page content deleted successfully'], 201);
    }

    // Create contact us page content and send an email to admin
    public function contactUs(Request $request){ 
        $data = $request->all();

        $ContactUs = new ContactUs;
        $ContactUs->first_name = $request->input('first_name');
        $ContactUs->last_name = $request->input('last_name');
        $ContactUs->email = $request->input('email');
        $ContactUs->phone_number = $request->input('phone_number');
        $ContactUs->company_name = $request->input('company_name');
        $ContactUs->subject = $request->input('subject');     
        $ContactUs->save();

        $contactUsMail = new ContactUsMail(
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['phone_number'],
            $data['company_name'],
            $data['subject']
        );

        if ($data) {
            Mail::to('amit@codenomad.net')->send($contactUsMail);
        
            return response()->json(['data' => $data, 'message' => 'Your contact request has been submitted successfully.'], 201);
        }       
    }
}

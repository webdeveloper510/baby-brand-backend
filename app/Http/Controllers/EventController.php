<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LatestEvent;
use App\Models\UpcomingEvent;
use URL;

class EventController extends Controller
{
    // Fetch latest event
    public function getLatestEvent(){
        $latestEvent = LatestEvent::all();

        if ($latestEvent) {
            return response()->json($latestEvent);
        }        
    }

    // Create and update latest event
    public function createLatestEvent(Request $request){
        $url = URL::to('/'); 
        $customizedLatestEventFileName = '';

        $latestEvent = new LatestEvent;

        // Upload latest event image to public upload/EventPage folder
        if ($request->hasFile('latest_event_image')) {
            $latest_event_image = $request->file('latest_event_image');
            $latestEventFileName = $latest_event_image->getClientOriginalName();
            $customizedLatestEventFileName = $url . '/upload/EventPage/' . $latestEventFileName;
            $latest_event_image->move(public_path('upload/EventPage/'), $latestEventFileName);
        }

        $latest_event_title = $request->input('latest_event_title');
        $latest_event_text = $request->input('latest_event_text');

        if($request->id){
            $latestEvent = LatestEvent::find($request->id);
            $latest_event_title = $latest_event_title ? $latest_event_title : $latestEvent->latest_event_title;
            $latest_event_text = $latest_event_text ? $latest_event_text : $latestEvent->latest_event_text;
            $customizedLatestEventFileName = $customizedLatestEventFileName ? $customizedLatestEventFileName : $latestEvent->latest_event_image;
        }
          
        $latestEvent->latest_event_title = $latest_event_title;
        $latestEvent->latest_event_text = $latest_event_text;
        $latestEvent->latest_event_image = $customizedLatestEventFileName;
        $latestEvent->save();

        if($latestEvent){
            return response()->json(['data' => $latestEvent, 'message' => 'Latest event created successfully'], 201);
        }
    }

    // Delete latest event
    public function deleteLatestEvent($id){
        $latestEvent = LatestEvent::find($id);
        $latestEvent->delete();
        return response()->json(['message' => 'Latest event deleted successfully'], 201);
    }

    // Fetch upcoming event
    public function getUpcomingEvent(){
        $upcomingEvent = UpcomingEvent::all();

        if ($upcomingEvent) {
            return response()->json($upcomingEvent);
        }        
    }

    // Create and update upcoming event
    public function createUpcomingEvent(Request $request){
        $url = URL::to('/'); 
        $customizedUpcomingEventFileName = '';

        $upcomingEvent = new UpcomingEvent;

        // Upload upcoming event image to public upload/EventPage folder
        if ($request->hasFile('upcoming_event_image')) {
            $upcoming_event_image = $request->file('upcoming_event_image');
            $upcomingEventFileName = $upcoming_event_image->getClientOriginalName();
            $customizedUpcomingEventFileName = $url . '/upload/EventPage/' . $upcomingEventFileName;
            $upcoming_event_image->move(public_path('upload/EventPage/'), $upcomingEventFileName);
        }

        $upcoming_event_title = $request->input('upcoming_event_title');
        $upcoming_event_text = $request->input('upcoming_event_text');

        if($request->id){
            $upcomingEvent = UpcomingEvent::find($request->id);
            $upcoming_event_title = $upcoming_event_title ? $upcoming_event_title : $upcomingEvent->upcoming_event_title;
            $upcoming_event_text = $upcoming_event_text ? $upcoming_event_text : $upcomingEvent->upcoming_event_text;
            $customizedUpcomingEventFileName = $customizedUpcomingEventFileName ? $customizedUpcomingEventFileName : $upcomingEvent->upcoming_event_image;
        }
            
        $upcomingEvent->upcoming_event_title = $upcoming_event_title;
        $upcomingEvent->upcoming_event_text = $upcoming_event_text;
        $upcomingEvent->upcoming_event_image = $customizedUpcomingEventFileName;
        $upcomingEvent->save();

        if($upcomingEvent){
            return response()->json(['data' => $upcomingEvent, 'message' => 'Upcoming event created successfully'], 201);
        }
    }

    // Delete upcoming event
    public function deleteUpcomingEvent($id){
        $upcomingEvent = UpcomingEvent::find($id);
        $upcomingEvent->delete();
        return response()->json(['message' => 'Upcoming event deleted successfully'], 201);
    }
}

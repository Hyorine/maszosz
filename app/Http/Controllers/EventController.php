<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\event;

class EventController extends Controller
{
    public function showEvent()
    {
        $events = Event::latest('created_at')->paginate(10);
        return view('main', ['events' => $events])->with('modul','event');
    }
    public function EditEvent(Request $request)
    {
        $event = Event::find($request->ID);
        if ($event) {
            $event->title = $request->title;
            $event->content = $request->content;
            $event->save();
        
            return redirect()->back()->with('eventUpdateSuccess', __('messages.admineventEditSucces'));
        } else {
            return redirect()->back()->with('eventUpdateError', __('messages.admineventEditError'));
        }
    }

    public function deletEvent(Request $request)
    {
          // Find the event by id
          $event = Event::find($request->EventDeletIDData);

          // Check if the event exists
          if ($event) {
              // Delete the event
              $event->delete();
  
              return redirect()->back()->with('success', 'Event has been deleted.');
          } else {
              return redirect()->back()->with('error', 'Event not found.');
          }
    }
}
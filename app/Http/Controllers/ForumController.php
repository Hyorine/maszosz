<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Thread;
use App\Models\ModeratorLog;
use App\Models\ReportedContentLog;
use Illuminate\Support\Facades\Validator;

class ForumController extends Controller
{
    public function showall()
    {
        $categories = Category::all();
        $news = Thread::where('is_approved', 1)->orderBy('created_at', 'desc')->limit(3)->get(); // Fetch threads ordered by creation date, descending
        $threads = Thread::where('is_approved', 1)->orderBy('created_at', 'desc')->paginate(10);
        $modul ="forum";
        $user = Auth::user();
        $user->load('Just1Role');
        return view('main', compact('categories', 'news', 'threads', 'user', 'modul'));
    }
    public function hendler(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'FormOperation' => 'required|numeric', // Assuming FormOperation is required and numeric
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Process the request based on the FormOperation
        switch ($request->FormOperation) {
            case 1:
                $validator = Validator::make($request->all(), [
                    'category' => 'required|numeric', // Assuming category is required  and numeric
                    'address' => 'required|max:255', // Assuming address is required and has a maximum length of 255 characters
                    'comment' => 'required', // Assuming comment is required
                ]);
        
                // Check if the validation fails
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $uniqueIdentifier = $this->encrypter($request->address);
                // Create a new thread
                $thread = Thread::create([
                    'user_id' => Auth::id(),
                    'category_id' => $request->category,
                    'title' => $request->address,
                    'content' => $request->comment,
                    'url_base' =>$uniqueIdentifier
                ]);
                return redirect()->back()->with('ForumSuccess', 'Thread created successfully.');
            break;
            case 2:
                    $thread = Thread::find($request->postid);
                    if ($thread) {
                        $thread->update(['is_approved' => 0]);
                        $ModeratorLog = ModeratorLog::create([
                            'moderator_id' => Auth::id(),
                            'action' => 'ban',
                            'target_id' =>  $request->postid,
                            'target_type_id' => 1,
                        ]);
                        // Success message or further processing
                    } else {
                        // Thread not found, handle error
                    }
            break; 
            case 3:
                $existingReport = ReportedContentLog::where('user_id', Auth::id())
                                    ->where('content_id', $request->ReportedTreadID)
                                    ->where('target_type_id', 1)
                                    ->exists();
                if ($existingReport) {
                    return redirect()->back()->with('ReportTreadError',  __('messages.ReportTreadError'));
                }
                else{
                    $ReportedContentLog = ReportedContentLog::create([
                        'user_id' => Auth::id(),
                        'content_id'  =>  $request->ReportedTreadID,
                        'target_type_id' => 1,
                        'comment' =>  $request->comment,
                    ]);
                    return redirect()->back();
                }
            break; 
            default:
                return redirect()->back()->with('ForumError', 'Invalid FormOperation.');
        }
    }
    private function encrypter( $postTitle){

        // Hash the concatenated string using SHA-256
        $hashedValue = hash('sha256', $postTitle);

        return $hashedValue;
    }
}
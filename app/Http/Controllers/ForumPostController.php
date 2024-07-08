<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Thread;
use App\Models\Post;
use App\Models\ModeratorLog;
use App\Models\ReportedContentLog;

class ForumPostController extends Controller
{
    public function show($postId, $createdAt, $uniqueIdentifier)
    {
        // Retrieve the post based on the provided parameters
        $Thread = Thread::where('id', $postId)
        ->where('created_at', $createdAt)
        ->where('url_base', $uniqueIdentifier)
        ->first();

        // Check if the post exists
        if (!$Thread) {
            // Handle case where post is not found
            abort(404);
        }
        $Post = Post::where('thread_id',$Thread->id)->where('is_approved',1)->paginate(10);
        $user = Auth::user();
        return view('main', ['Thread' => $Thread,'posts' => $Post, 'modul' => 'forumPost', 'user' => $user]);
    }
    public function postOperation(Request $Request){
        switch ($Request->postOperation) {
            case 1:
                $Post = Post::create([
                    'user_id' => Auth::id(),
                    'thread_id' => $Request->thread_id,
                    'content' => $Request->newMessage,
                    'is_approved' => 1,
                    'requires_approval' => 0,
                ]);
                return redirect()->back();
            break;
            case 2:
                $Post = Post::find($Request->postid);
                if($Post){
                    $Post->update(['is_approved' => 0]);
                    $ModeratorLog = ModeratorLog::create([
                        'moderator_id' => Auth::id(),
                        'action' => 'ban',
                        'target_id' =>  $Request->postid,
                        'target_type_id' => 2,
                    ]);
                }
                else{
                    $Post = Post::find($Request->postid);
                }
            break;
            case 3:
                $existingReport = ReportedContentLog::where('user_id', Auth::id())
                ->where('content_id', $request->ReportedcommentID)
                ->where('target_type_id', 2)
                ->first();
                if (!$existingReport) {
                    $ReportedContentLog = ReportedContentLog::create([
                        'user_id' => Auth::id(),
                        'content_id'  =>  $Request->ReportedcommentID,
                        'target_type_id' => 2,
                        'comment' =>  $Request->comment,
                    ]);
                    return redirect()->back();
                }else {
                    // A report already exists for this content, handle accordingly
                    return redirect()->back()->with('error', 'Content has already been reported.');
                }


               
            break;
            default:
                return redirect()->back()->with('ForumError', 'Invalid postOperation.');
        }
    }
}
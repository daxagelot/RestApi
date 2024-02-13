<?php

namespace App\Http\Controllers\Jpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use Auth;

class ChatController extends Controller
{
    // public function index(){
    //     return view('jpanel.chat.chat');
    // }
    public function index()
    {
        $recipient_name = "John Doe"; // Replace with the actual recipient's name
        $chats = Chat::all(); // Assuming you're retrieving all chats
        return view('jpanel.chat.chat', compact('chats', 'recipient_name'));
    }
    


    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        
        $message = new Chat();
        $message->content = $request->input('content');
        $message->recipient_id = $request->input('recipient_id'); // Assuming you have recipient_id in your chat table
        $message->sender_id = $user->id; // Adjusted column name
        $message->save();

        return response()->json(['success' => true]);
    }
    
}

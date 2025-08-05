<?php
namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Models\Inquiries;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Twilio\Rest\Client;

class InquiryController extends Controller
{

    public function messageList()
    {
        $read    = Inquiries::where('replied', true)->orderBy('created_at', 'desc')->get();
        $deleted = Inquiries::onlyTrashed()->orderBy('created_at', 'desc')->get();
        $unread  = Inquiries::where('replied', false)->orderBy('created_at', 'desc')->get();
        return view('FileManager.Inquiries.index', compact('read', 'unread', 'deleted'));
    }
    public function ReplyInquiry(Request $request, $id)
    {
        $inquiry = Inquiries::findOrFail($id);
        return view('FileManager.Inquiries.response', compact('inquiry'));
    }
    public function store(Request $request, $id)
    {
        $inquiry = Inquiries::findOrFail($id);
        $data    = $request->validate([
            'replyvia' => 'required',
            'response' => 'required|min:5|max:200',
        ]);

        $inquiry->repliedBy = Auth::user()->id;
        $inquiry->replied   = true;
        $inquiry->reply     = $request->response;
        $inquiry->status    = 'Read';
        $inquiry->repliedOn = Carbon::now();
        $saved              = $inquiry->save();

        //  return redirect()->route('inquiry.list')->with('success','Reply has been sent to'. $inquiry->email);

        if ($saved and $request->replyvia == 'tel') {
            // send sms

            $receiverNumber = $inquiry->telephone;
            $message        = $request->response;

//            $Sid   = env('TWILIO_ACCOUNT_SID');
//            $Token = env('TWILIO_AUTH_TOKEN');
//            $FROM  = env('TWILIO_FROM_NUMBER');
            $Sid   = config('services.twilio.sid');
            $Token = config('services.twilio.token');
            $FROM  = config('services.twilio.from');

            try {
                $client = new Client($Sid, $Token);
                $client->messages->create($receiverNumber, [
                    'from' => $FROM,
                    'body' => $message,
                ]);

                return redirect()->route('inquiry.list')->with('success', 'SMS sent ' . $inquiry->telephone . ' successfully!');
            } catch (\Exception $e) {
                return redirect()->route('inquiry.list')->with('error', $e->getMessage());
            }

        } else if ($saved and $request->replyvia == 'email') {
            // send email
            $email   = $inquiry->email;
            $subject = $inquiry->subject;
            $body    = 'Hello ' . $inquiry->fullname . ' ' .
            $request->response .
                ' Thank you For contacting us
            MINISTRY OF PUBLIC SERVICE ';
            Mail::raw($body, function ($message) use ($email, $subject) {
                $message->to($email)
                    ->subject($subject);
            });
            return redirect()->route('inquiry.list')->with('success', 'Reply has been sent to ' . $inquiry->email);
        }

    }
    public function SoftDeleteInquiry(Request $request, $id)
    {
        $inquiry         = Inquiries::findOrFail($id);
        $inquiry->status = 'Deleted';
        $inquiry->delete();
        return redirect()->route('inquiry.list')->with('success', 'File moved to Bin successfully');
    }

    public function DeleteInquiry($id)
    {
        $inquiry = Inquiries::findOrFail($id);
        $inquiry->forceDelete();
        return redirect()->route('inquiry.list')->with('success', 'File moved to Bin successfully');
    }
}

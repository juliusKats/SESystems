<?php
namespace App\Http\Controllers\SMS;

use App\Http\Controllers\Controller;
use Exception;
use Twilio\Rest\Client;
// make sure to import the Twilio client

class TwilioController extends Controller
{
    //
    public function SendSMS()
    {
        {
            $receiverNumber = '+256759958181'; // Replace with the recipient's phone number
            $message        = 'hi testing';    // Replace with your desired message

            $sid        = env('TWILIO_SID');
            $token      = env('TWILIO_TOKEN');
            $fromNumber = env('TWILIO_FROM');

            try {
                $client = new Client($sid, $token);
                $client->messages->create($receiverNumber, [
                    'from' => $fromNumber,
                    'body' => $message,
                ]);

                return 'SMS Sent Successfully.';
            } catch (Exception $e) {
                return 'Error: ' . $e->getMessage();
            }
        }
    }

}

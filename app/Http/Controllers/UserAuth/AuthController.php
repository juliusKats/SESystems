<?php
namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use App\Models\EDBRTeam;
use App\Models\PasswordReset;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function topFive(Request $request){

    }

    public function EmailVerifyForm()
    {
        return view("FileManager.FrontEnd.Auth.verify_email");
    }

    public function VerificationSend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Verification link sent!');
    }
    // option 1
    public function EmailVerification(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('dashboard');
    }
    // option 2
    public function EmailVerifications ($id, $hash, Request $request) {
         $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
        // Verify if the hash is correct
        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return response()->json(['message' => 'Invalid verification link.'], 403);
        }
        // Mark email as verified
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return response()->json(['message' => 'Email verified successfully!']);
    }
    public function showLoginForm()
    {
        return view("FileManager.FrontEnd.Auth.login");
    }
    public function Login()
    {
        return view('FileManager.FrontEnd.Auth.Login');
    }
     public function Register()
    {
        return view('FileManager.FrontEnd.Auth.Register');
    }
    public function showForgetPasswordForm()
    {
        return view("FileManager.FrontEnd.Auth.forgot-password");
    }
    public function ForgetPassword(Request $request)
    {
        $data = $request->validate([
            'email'                 => 'required|email|exists:users',
            'password'              => 'required|string|min:6|confirmed|same:password_confirmation',
            'password_confirmation' => 'required',
        ]);
        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token,
            ])
            ->first();

        if (! $updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect('/login')->with('message', 'Your password has been changed!');

    }
    public function showResetPasswordForm(Request $request, $token)
    // public function showResetPasswordForm(Request $request)
    {
        return view("FileManager.FrontEnd.Auth.reset-password", ['token' => $token]);
    }
    public function submitResetPasswordForm(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        //generate token
        $token = Str::random(64);
        //Create Password Reset Token
        PasswordReset::create([
            'email'     => $request->email,
            'token'     => $token,
            'create_at' => Carbon::now(),
        ]);
        $user = User::where('email', $request->email)->first();
        Mail::send('FileManager.FrontEnd.Auth.emailed_forgetPassword', ['token' => $token, 'user'], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return back()->with('message', 'We have e-mailed your password reset link!');
    }
    public function UserProfile(Request $request, $id)
    {
        $id             = Auth::user()->id;
        $activesessions = DB::table('sessions')->select('*')->where('user_id', '=', Auth::user()->id)->get();
        $user           = User::find($id);
        return view('FileManager.USERS.profile', compact('user', 'activesessions'));
    }
    public function UserToken(Request $request, $id)
    {
        $id   = Auth::user()->id;
        $user = User::find($id);
        return view('FileManager.FrontEnd.Auth.APITOKEN', compact('user'));
    }
    public function UpdateProfile(Request $request)
    {
        $authuser = Auth::user()->id;
        $user     = User::find($authuser);
        // dd($user);
        $data = $request->validate([
            'fname'     => 'required|string|max:50',
            'sname'     => 'required|string|max:50',
            'oname'     => 'nullable|string|max:50',
            // 'email'     => 'required|email|unique:users,email',
            'userphoto' => 'nullable|mimes:jpeg,jpg,png',
        ]);

        if ($request->hasFile('userphoto')) {
            $orig        = $request->file('userphoto')->getClientOriginalName();
            $photo       = $request->file('userphoto');
            $filename    = time() . $orig;
            $user->sname = $request->sname;
            $user->fname = $request->fname;
            $user->oname = $request->oname;
            // $user->email              = $request->email;
            $user->profile_photo_path = $filename;
            $finaluser                = $user->save();
            if ($finaluser) {
                $path = $photo->move(public_path('storage/profile'), $filename);
            }

            return redirect()->route('user-profile', $user)->with('success', 'Profile Updated Succesfully');
        } else {
            $user->sname = $request->sname;
            $user->fname = $request->fname;
            $user->oname = $request->oname;
            // $user->email = $request->email;
            $finaluser = $user->save();
            return redirect()->route('user-profile', $user)->with('success', 'Profile Updated Succesfully');

        }

    }
    public function UpdatePassword(Request $request)
    {
        $authuser = Auth::user()->id;
        $user     = User::find($authuser);
        // dd($request->all());
        $data = $request->validate([
            'userpass'         => 'required|min:5',
            'newpass'          => 'required|min:5|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        //get user with the selected id and password
        $exist = User::where('id', '=', $authuser)->where('password', '=', Hash::check($request->currentpassword, $user->password))->exists();
        if ($exist) {
            $user->password = Hash::make($request->newpass);
            $saved          = $user->save();
            if ($saved) {
                $activesession = DB::table('sessions')->select('*')->where('user_id', '=', $authuser)->get();
                foreach ($activesession as $active) {
                    $p = $active->id;
                    $p->delete();
                }
            }
            // $session->delete();
            return redirect()->route('user-profile', $authuser)->with('success', 'Password updated Successfully');

        } else {
            return redirect()->route('user-profile', $authuser)->with('error', 'Something went wrong. Try again.');
        }

    }
    public function LogoutSession(Request $request)
    {
        $request->validate(['password' => 'required|current_password']);
        //    Auth::logoutCurrentDevice();
        $user = Auth::logoutOtherDevices($request->password);

        //    $user->logoutOtherDevices($request->password);

        return back()->with('success', 'Logode out');
        //    auth()->logoutOtherBrowserSessions($request->password);
    }
    public function RemovePhoto(Request $request)
    {
        $authuser = Auth::user()->id;
        $user     = User::find($authuser);

        $file_path = public_path('storage/profile/' . $user->profile_photo_path);

        if (File::exists($file_path)) {
            File::delete($file_path);
            $user->profile_photo_path = null;
            $user->save();
        }

        return redirect()->route('user-profile', $user->id)->with('success', 'Profile Updated Succesfully');
    }

    public function AddUser(Request $request)
    {
        return view('FileManager.USERS.add');
    }

    public function SaveAddUser(Request $request)
    {
        $userinfo = $request->validate([
            'userphoto'       => 'nullable|mimes:jpeg,jpg,png|max:2048',
            'fullname'        => 'required|min:7',
            'email'           => 'required', 'email|unique:users,email',
            'password'        => 'string|required|min:5|same:confirmpassword',
            'confirmpassword' => 'required',
            'status'          => 'required',
            'role'            => 'required',
        ]);
        // dd($userinfo);
        $superadmin = User::where('role', 'superadmin')->count();
        $exist      = User::where('email', $request->email)->exists();
        if ($exist) {
            return redirect()->route('user.list')->with('error', 'Use with the email exists');
        }
        if ($request->role == 'superadmin' and $superadmin > 0) {
            return redirect()->route('user.list')->with('error', 'Only One Superadmin required');
        }
        else if(!Str::contains($request->fullname,' ')){
            return redirect()->route('add.user')->with('error', 'Add a space between first and surname');
        }
        elseif(Str::length(explode(' ',$request->fullname)[0])<2){
            return redirect()->route('add.user')->with('error', 'First name must be greater than 2 characters');
        }
        elseif(Str::length(explode(' ',$request->fullname)[1])<2){
            return redirect()->route('add.user')->with('error', 'Second name must be greater than 2 characters');
        }

        else {

            if ($request->hasFile('userphoto')) {
                $orig     = $request->file('userphoto')->getClientOriginalName();
                $photo    = $request->file('userphoto');
                $filename = time() . $orig;
                $user     = User::create([
                    'fname'              => $request->fname,
                    'sname'              => $request->sname,
                    'oname'              => $request->oname,
                    'email'              => $request->email,
                    'password'           => Hash::make($request->password),
                    'status'             => $request->status,
                    'role'               => $request->role,
                    'current_team_id'    => 1,
                    'profile_photo_path' => $filename,
                ]);

                 $path = $photo->move(public_path('storage/profile'), $filename);
                // add user team:
                if($user and $user->role =='ps') {
                    EDBRTeam::create([
                        'user_id'       => $user->id,
                        'status'          => $user->status,
                    ]);

                }

                if ($user) {
                    Team::create([
                        'user_id'       => $user->id,
                        'name'          => $user->name,
                        'personal_team' => true,
                    ]);
                    return redirect()->route('user.list')->with('success', 'User Account Added successfully');
                } else {
                    return redirect()->route('add.user')->with('error', 'Something went wrong');
                }

            } else {
                $user1 = User::create([
                    'fname'            => explode(' ',$request->fullname)[0],
                    'sname'            => explode(' ',$request->fullname)[1],
                    'email'           => $request->email,
                    'password'        => Hash::make($request->password),
                    'status'          => $request->status,
                    'role'            => $request->role,
                    'current_team_id' => 1,
                    'created_at'      => now(),
                    'updated_at'      => Carbon::now(),
                ]);
                if($user1 and $user1->role =='ps') {
                    EDBRTeam::create([
                        'user_id'       => $user1->id,
                        'status'          => $user1->status,
                    ]);

                }
                if ($user1) {
                    Team::create([
                        'user_id'       => $user1->id,
                        'name'          => $user1->sname,
                        'personal_team' => true,
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now(),
                    ]);
                    return redirect()->route('user.list')->with('success', 'User Account Added successfully');

                } else {
                    return redirect()->route('add.user')->with('error', 'Something went wrong');
                }
            }
        }
    }
    public function DeleteUser(Request $request, $id)
    {
        $user      = User::find($id);
        $userrole  = $user->role;
        $userid    = $user->id;
        $authid    = Auth::user()->id;
        $file_path = public_path('storage/profile/' . $user->profile_photo_path);

        if ($userrole == "superadmin") {
            return redirect()->route('user.list')->with('error', 'You cannot Delete Super Admin Account');
        } elseif ($authid == $userid) {
            return redirect()->route('user.list')->with('error', 'You Cannot delete yourself');
        } else {

            if (File::exists($file_path)) {
                File::delete($file_path);
                $user->delete();
                return redirect()->route('user.list')->with('success', 'Account deleted Successfully');
            } else {
                return redirect()->route('user.list')->with('error', 'Something went wrong');
            }
        }
    }
}

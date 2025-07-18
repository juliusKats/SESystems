<?php
use App\Http\Controllers\Ajax\AjaxController;
use App\Http\Controllers\Auditing\AuditController;
use App\Http\Controllers\Dashboard\UserDashboardController;
use App\Http\Controllers\File\EstablishmentController;
use App\Http\Controllers\File\JobDescriptionController;
use App\Http\Controllers\File\LineMinistryController;
use App\Http\Controllers\File\RapexController;
use App\Http\Controllers\File\SchemeController;
use App\Http\Controllers\File\VoteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserAuth\AuthController;
use App\Http\Middleware\AllowOnlyAdmin;
use App\Models\Carders;
use App\Models\CardMinistries;
use App\Models\Entities;
use App\Models\GovEntities;
use App\Models\Institutions;
use App\Models\ServiceCenter;
use App\Models\User;
use App\Models\Version;
use App\Models\VoteDetails;
use App\Models\YearMonths;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use OwenIt\Auditing\Models\Audit;

Route::get('/', function () {
    $yearz = "yearz";
    $votes = VoteDetails::all();
    $years = User::distinct()->get(['created_at'])->groupBy('created_at');
    $yrs   = VoteDetails::selectRaw('extract(year FROM created_at) AS year')
        ->distinct()
        ->orderBy('year', 'desc')
        ->get();
    $yearfinal = User::select([DB::raw('extract(year FROM created_at) AS year')])
        ->get()
        ->unique('year')
        ->sortBy('year');
    $entities = Entities::all();
    $months   = YearMonths::all();
    $user     = User::selectRaw('DATE_FORMAT(created_at,"%M") as month,sum((status)=0) as Active,sum((status)=1) as Inactive ,DATE_FORMAT(created_at,"%Y-%m") as period')
        ->groupBy('period')
        ->groupBy('month')
        ->orderBy('period', 'asc')
        ->get();
    $data['periods']   = $user->pluck('period');
    $data['inactives'] = $user->pluck('Inactive');
    $data['actives']   = $user->pluck('Active');
    $data['months']    = $user->pluck('month');

    return view('welcome', $data, compact('votes', 'months', 'years', 'yrs', 'yearfinal', 'entities'));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        if ((Auth::user()->role == 'superadmin' && Auth::user()->status == 1) || (Auth::user()->role == 'admin' and Auth::user()->status == 1) || (Auth::user()->role == 'ps' and Auth::user()->status == 1) || Auth::user()->status == 1) {
            return redirect()->route('user.dashboard')->with('success', 'You are welcome');

        } else {
            $user = Auth::user();
            return view('FileManager.Authentication.LoginError', compact('user'));
        }
    })->name('dashboard');
});

Route::prefix('user/authentication')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/forget/password', 'showForgetPasswordForm')->name('forget.password.get');
        Route::post('/forget-password', 'ForgetPassword')->name('forget.password.post');
        //   Route::get('/reset/password','showResetPasswordForm')->name('reset.password.get');
        Route::get('/reset-password/{token}', 'showResetPasswordForm')->name('reset.password.get');
        Route::post('/reset-password', 'submitResetPasswordForm')->name('reset.password.post');
        Route::get('/add/user', 'AddUser')->name('add.user');
        Route::post('/save/user', 'SaveAddUser')->name('save.user');
        Route::delete('/delete/{id}/user', 'DeleteUser')->name('delete.user');
        Route::get('/user/{id}/profile/', 'UserProfile')->name('user-profile');
        Route::put('/user/{id}/profile/', 'UpdateProfile')->name('update-profile');
        Route::put('/user/{id}/password/update/', 'UpdatePassword')->name('update.password');
        Route::put('/user/{id}/profile/image/', 'RemovePhoto')->name('remove-user-photo');
        Route::delete('/logout/sessions', 'LogoutSession')->name('logout.sessions');
        Route::get('/user/{id}/token/', 'UserToken')->name('user-token');
        Route::get('/email/verify', 'EmailVerifyForm')->name('verification.notice');
        Route::post('/email/verify/send', 'VerificationSend')->middleware(['throttle:6,1'])->name('verification.send');
        Route::get('/email/verify/{id}/{hash}', 'EmailVerification')->middleware(['auth', 'signed'])->name('verification.verify');
    //     Route::get('/email/verification/{id}/{hash}','EmailVerifications')->middleware(['auth', 'signed'])->name('verification.verify');
    });
});

Route::prefix('edbrs.com')->group(function () {
    Route::controller(AuditController::class)->group(function () {
        Route::get('/audit/log', 'index')->name('audit-log')->middleware('auth', AllowOnlyAdmin::class);
        Route::get('/audit/user/location', 'location')->name('audit.log.location')->middleware('auth', AllowOnlyAdmin::class);
        Route::get('/manage/users', 'userlist')->name('user.list');
        Route::put('/activate/{id}/users', 'ActivateUser')->name('user.activate');
        Route::get('main/dashboard', 'dashboard')->name('main.dashboard');

    });
});
Route::prefix('edbrs.com')->group(function () {
    Route::controller(HomeController::class)->group(function () {

        Route::get('/index/home', 'index')->name('home.dashboard');
        Route::get('/establishment', 'Establishment')->name('establishment');
        Route::get('/job/description', 'JobDescription')->name('jobdescription');
        Route::get('/Service/Schemes', 'ServiceSchemes')->name('servicescheme');
        Route::get('/RAPEX/documents', 'RapexDocuments')->name('rapexdocuments');
        Route::get('/system/faq', 'FrequentQuestions')->name('faq');
        Route::post('Ask/Your/Question', 'AskQuestion')->name('ask.question');
        Route::get('/contact/us', 'ContactUS')->name('contact-us');
        Route::post('/contact/us/save/','ContactUsSave')->name('save.contact.us');
        Route::get('/gallery', 'Gallery')->name('gallery');

        Route::get('/preview/{id}/uploaded/excel', 'previewExcel')->name('preview.excel.file');
        Route::get('/download/{id}/approved/excel', 'downloadExcel')->name('download.excel.file');
        //   pdf actions
        Route::get('/preview/{id}/approved/pdf', 'previewPDF')->name('preview.ps.file');
        Route::get('/download/{id}/approved/pdf', 'downloadPDF')->name('download.ps.file');

        Route::get('/viewing/{id}/file_details', 'ViewVote')->name('vote.view');

    });
});

// Ajax Routes
Route::prefix('ajax')->group(function () {
    Route::controller(AjaxController::class)->group(function () {
        Route::get('fetch/votes', 'FetchVote')->name('fetch-vote');
        Route::get('fetch/institution', 'FetchInstitution')->name('fetch-institution');
        Route::get('fetch/barchat', 'getGraph')->name('fetch-chart');
        Route::get('fetch/test/chat', 'TestingChart')->name('fetch-test');
        Route::get('fetch/multiple/institution', 'FetchMultipleInstitution')->name('fetch-multiple-institution');

    });
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::prefix('edbrs.com')->group(function () {
        Route::controller(VoteController::class)->group(function () {
            Route::get('Manage/vote', 'index')->name('vote.list');
            Route::get('vote/add', 'create')->name('vote.create');
            Route::post('vote/store', 'store')->name('vote.store');
            Route::put('vote/{id}/activate', 'changeStatus')->name('vote.active');
            Route::delete('vote/{id}/delete', 'destroy')->name('vote.delete');

        });

        // institution and line ministry

        Route::controller(LineMinistryController::class)->group(function () {
            Route::get('Line/Ministry/List', 'LineIndex')->name('line.ministy.list');
            Route::post('Line/Ministry/Save', 'LineStore')->name('line.ministry.save');
            Route::put('Line/Ministry/{id}/Activate', 'LineActivate')->name('line.activate');

            Route::get('Institution/Index', 'InstitutionIndex')->name('institution.list');
            Route::post('Institution/Save', 'InstitutionStore')->name('line.ministy.save');
            Route::put('Institution/{id}/Activate', 'InstituteActivate')->name('institute.activate');
        });
        // file controller
        Route::controller(EstablishmentController::class)->group(function () {
            // Route::get('/dashboard', 'Dashboard')->name('dashboard');
            Route::get('Manage/Establishment/File', 'index')->name('file.list');
            Route::get('Upload/Establishment/file', 'create')->name('file.create');
            Route::post('file/store', 'store')->name('file.store');
            Route::put('file/{id}/approve', 'ApproveFile')->name('file.approve');
            Route::get('file/{id}/reject', 'RejectFile')->name('file.reject');
            Route::put('file/{id}/reject', 'RejectSave')->name('file.reject.save');
            Route::delete('file/{id}/delete/all/vote', 'deleteVote')->name('delete.vote');
            Route::delete('file/{id}/delete/all', 'deleteAll')->name('delete.file.all');
            Route::delete('file/{id}/pdf/delete', 'deletePDF')->name('delete.file.pdf');
            Route::delete('file/{id}/excel/delete', 'deleteExcel')->name('delete.file.excel');

            Route::delete('/temporary{id}/delete', 'SoftDelete')->name('soft.delete');
            Route::post('/restore/{id}/soft', 'Restore')->name('vote.restore');

        });
        Route::controller(JobDescriptionController::class)->group(function () {
            Route::get('Manage/Job/Description/Files', 'index')->name('job.file.list');
            Route::get('job/description/create', 'create')->name('job.file.create');
            Route::post('job/description/store', 'store')->name('job.file.store');
            Route::delete('job/temporary{id}/delete', 'SoftDelete')->name('job.soft.delete');
            Route::post('job/restore/{id}/soft', 'Restore')->name('job.restore');
            Route::delete('job/{id}/delete/all/job/documents', 'deleteVote')->name('delete.jobs');

        });
        Route::controller(RapexController::class)->group(function () {
            Route::get('Manage/RAPEX/Files', 'index')->name('rapex.file.list');
            Route::get('rapex/create', 'create')->name('rapex.file.create');
            Route::post('rapex/store', 'store')->name('rapex.file.store');
        });
        Route::controller(SchemeController::class)->group(function () {
            Route::get('scheme/service', 'index')->name('scheme.service.list');
            Route::get('scheme/upload/service', 'create')->name('scheme.service.upload');
            Route::post('scheme/store/service', 'store')->name('scheme.service.store');
        });

        #Dashboard
        Route::controller(UserDashboardController::class)->group(function () {
            Route::get('/user/dashboard', 'index')->name('user.dashboard');
            Route::get('/user/dashboard/graphics', 'Graphics')->name('user.graphs');
        });

    });
});

Route::get('/checking', function (Request $request) {

    return view('Test.calendar');
})->name('login.test');

Route::get('/trying', function () {
    // $user  = User::selectRaw('sum((status)=0) as Active,sum((status)=1) as Inactive ,DATE_FORMAT(created_at,"%Y-%m") as month')
    // ->groupBy('month')
    // ->orderBy('month','asc')
    // ->get();
    $user = User::selectRaw('DATE_FORMAT(created_at,"%M") as month,sum((status)=0) as Active,sum((status)=1) as Inactive ,DATE_FORMAT(created_at,"%Y-%m") as period')
        ->groupBy(groups: 'period')
        ->groupBy('month')
        ->orderBy('period', 'asc')
        ->get();
    $data['periods']   = $user->pluck('period');
    $data['inactives'] = $user->pluck('Inactive');
    $data['actives']   = $user->pluck('Active');
    $data['months']    = $user->pluck('month');

    return view('Test.userdashboard', $data);
})->name('trying.test');

Route::get('new/admin', function () {

    $inactiveusers = User::orderBy('created_at', 'desc')->where('status', false)->get();
    $activeusers   = User::orderBy('created_at', 'desc')->where('status', true)->get();

    $activevotes   = VoteDetails::orderBy('updated_at', 'desc')->where('Active', true)->get();
    $inactivevotes = VoteDetails::orderBy('updated_at', 'desc')->where('Active', false)->get();

    $audits   = Audit::with('user')->orderBy('created_at', 'desc')->get();
    $location = Audit::with('user')->orderBy('created_at', 'desc')->get();

    $activeverse   = Version::orderBy('created_at', 'desc')->where('status', true)->get();
    $inactiveverse = Version::orderBy('created_at', 'desc')->where('status', false)->get();

    $activecenters  = ServiceCenter::orderBy('created_at', 'desc')->where('status', true)->get();
    $inactivecenters = ServiceCenter::orderBy('created_at', 'desc')->where('status', false)->get();

    $linesActive   = GovEntities::orderBy("created_at", "desc")->where('status', true)->get();
    $linesInactive = GovEntities::orderBy("created_at", "desc")->where('status', false)->get();

    $instituteActive = Institutions::select('institutions.id', 'gov_entities.entityName', 'institutions.institution', 'institutions.status', 'institutions.updated_at')
        ->join('gov_entities', 'gov_entities.id', '=', 'institutions.entity')
        ->orderBy('institutions.updated_at', "desc")
        ->where('institutions.status', true)->get();
    $instituteInactive = Institutions::select('institutions.id', 'gov_entities.entityName', 'institutions.institution', 'institutions.status', 'institutions.updated_at')
        ->join('gov_entities', 'gov_entities.id', '=', 'institutions.entity')
        ->orderBy('institutions.updated_at', "desc")
        ->where('institutions.status', false)->get();

    $activeCardMin   = CardMinistries::orderBy("created_at", "desc")->where('status', true)->get();
    $inactiveCardMin = CardMinistries::orderBy("created_at", "desc")->where('status', false)->get();

    $activeCard   =    Carders::select('carders.id', 'card_ministries.carderName as govmin', 'carders.cardname as carders', 'carders.status')
    ->join ('card_ministries','card_ministries.id','=','carders.ministry')
    ->where('carders.status', true);

    $inactiveCard = Carders::select('carders.id', 'card_ministries.carderName as govmin', 'carders.cardname as carders', 'carders.status')
    ->join ('card_ministries','card_ministries.id','=','carders.ministry')
    ->where('carders.status', false);

    return view('newadmin',
        compact(
            'inactiveusers', 'activeusers',
            'activeCardMin', 'inactiveCardMin',
            'activeCard', 'inactiveCard',
            'activevotes', 'inactivevotes',
            'audits', 'location',
            'activeverse', 'inactiveverse',
            'activecenters', 'inactivecenters',
            'instituteActive', 'instituteInactive',
            'linesActive', 'linesInactive'
        )
    );
});

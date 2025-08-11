<?php
use App\Http\Controllers\Ajax\AjaxController;
use App\Http\Controllers\Auditing\AuditController;
use App\Http\Controllers\Dashboard\UserDashboardController;
use App\Http\Controllers\File\EmailController;
use App\Http\Controllers\File\EstablishmentController;
use App\Http\Controllers\File\FrontEndController;
use App\Http\Controllers\File\InquiryController;
use App\Http\Controllers\File\JobDescriptionController;
use App\Http\Controllers\File\LineMinistryController;
use App\Http\Controllers\File\ProductivityController;
use App\Http\Controllers\File\RapexController;
use App\Http\Controllers\File\ReformController;
use App\Http\Controllers\File\ResearchController;
use App\Http\Controllers\File\SchemeController;
use App\Http\Controllers\File\ServiceUgandaController;
use App\Http\Controllers\File\VoteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserAuth\AuthController;
use App\Http\Middleware\AllowOnlyAdmin;
use App\Models\Carders;
use App\Models\CardMinistries;
use App\Models\CountryCodes;
use App\Models\EDBRTeam;
use App\Models\GovEntities;
use App\Models\Institutions;
use App\Models\ServiceCenter;
use App\Models\Services;
use App\Models\User;
use App\Models\Version;
use App\Models\VoteDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use OwenIt\Auditing\Models\Audit;





Route::get('/', function () {
    $country     = CountryCodes::all();
    $services    = Services::all()->where('status', true);
    $teammembers = EDBRTeam::select('e_d_b_r_teams.id', 'users.sname', 'users.fname', 'users.oname', 'users.profile_photo_path', 'e_d_b_r_teams.title', 'e_d_b_r_teams.about', 'e_d_b_r_teams.twitter', 'e_d_b_r_teams.facebook', 'e_d_b_r_teams.instagram', 'e_d_b_r_teams.linkedin', 'e_d_b_r_teams.updated_at', 'e_d_b_r_teams.deleted_at')
        ->join('users', 'users.id', '=', 'e_d_b_r_teams.user_id')
        ->where('e_d_b_r_teams.status', true)->get();
    return view('FileManager.FrontEnd.entryPage', compact('teammembers', 'services', 'country'));
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
        Route::get('/enduser/register', 'Register')->name('front.user.register');
        Route::get('/enduser/login', 'Login')->name('front.user.login');
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

// Ajax Routes
Route::prefix('ajax')->group(function () {
    Route::controller(AjaxController::class)->group(function () {
        Route::get('fetch/votes', 'FetchVote')->name('fetch-vote');
        Route::get('fetch/institution', 'FetchInstitution')->name('fetch-institution');
        Route::get('fetch/barchat', 'getGraph')->name('fetch-chart');
        Route::get('fetch/test/chat', 'TestingChart')->name('fetch-test');
        Route::get('fetch/multiple/institution', 'FetchMultipleInstitution')->name('fetch-multiple-institution');
        Route::get('fetch/carder', 'FetchCarder')->name('fetch-carder');
        Route::get('fetch/establishment', 'Fetchestablishment')->name('fetch-establishment');
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

        Route::controller(EmailController::class)->group(function () {
            Route::get('/inbox', 'MailInbox')->name('mail.inbox');
            Route::get('/compose', 'MailCompose')->name('mail.compose');
            Route::get('/read', 'MailRead')->name('mail.read');

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
            Route::get('Manage/establishment/File', 'index')->name('file.list');
            Route::get('Upload/establishment/file', 'create')->name('file.create');
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
            Route::get('file/{id}/view', 'show')->name('file.view');
            Route::put('file/update/{id}/establish','update')->name('file.update');


        });
        Route::controller(JobDescriptionController::class)->group(function () {
            Route::get('Manage/Job/Description/Files', 'index')->name('job.file.list');
            Route::get('job/description/create', 'create')->name('job.file.create');
            Route::post('job/description/store', 'store')->name('job.file.store');

            Route::delete('job/temporary{id}/delete', 'SoftDelete')->name('job.soft.delete');
            Route::post('job/restore/{id}/soft', 'Restore')->name('job.restore');
            Route::delete('job/{id}/delete/all/job/documents', 'deleteVote')->name('delete.jobs');
            Route::put('job/{id}/approve', 'ApproveFile')->name('job.approve');
            Route::get('job/{id}/reject', 'RejectFile')->name('job.reject');
            Route::put('job/{id}/reject', 'RejectSave')->name('job.reject.save');

        });
        Route::controller(RapexController::class)->group(function () {
            Route::get('Manage/RAPEX/Files', 'index')->name('rapex.file.list');
            Route::get('rapex/create', 'create')->name('rapex.file.create');
            Route::post('rapex/store', 'store')->name('rapex.file.store');
            Route::get('rapex/{id}/view', 'show')->name('rapex.file.show');
            Route::delete('rapex/image/delete','deleteImages')->name('delete.selected.images');

        });
        Route::controller(SchemeController::class)->group(function () {
            Route::get('scheme/service', 'index')->name('scheme.service.list');
            Route::get('scheme/upload/service', 'create')->name('scheme.service.upload');
            Route::post('scheme/store/service', 'store')->name('scheme.service.store');

            Route::delete('scheme/temporary{id}/delete', 'SoftDelete')->name('scheme.soft.delete');
            Route::post('scheme/restore/{id}/soft', 'Restore')->name('scheme.restore');
            Route::delete('scheme/{id}/delete/all/scheme/documents', 'deleteVote')->name('delete.schemes');
            Route::put('scheme/{id}/approve', 'ApproveFile')->name('scheme.approve');
            Route::get('scheme/{id}/reject', 'RejectFile')->name('scheme.reject');
            Route::put('scheme/{id}/reject', 'RejectSave')->name('scheme.reject.save');

        });

        Route::controller(ServiceUgandaController::class)->group(function () {
            Route::get('Manage/ServiceUganda/Files', 'index')->name('su.file.list');
            Route::get('ServiceUganda/create', 'create')->name('su.file.create');
            Route::post('ServiceUganda/store', 'store')->name('su.file.store');

        });

        # Productivity
         Route::controller(ProductivityController::class)->group(function () {
            Route::get('Manage/Productivity/Files', 'index')->name('productivity.file.list');
        });

         # Research
         Route::controller(ResearchController::class)->group(function () {
            Route::get('Manage/Research/Files', 'index')->name('research.file.list');
        });

         # Research
         Route::controller(ReformController::class)->group(function () {
            Route::get('Manage/Reform/Files', 'index')->name('reform.file.list');
        });

        #Dashboard
        Route::controller(UserDashboardController::class)->group(function () {
            Route::get('/user/dashboard', 'index')->name('user.dashboard');
            Route::get('/user/dashboard/graphics', 'Graphics')->name('user.graphs');
        });

    });
});

Route::get('/checking', function (Request $request) {

    return view('FileManager.MENT/Actions.Delete');
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

    $activecenters   = ServiceCenter::orderBy('created_at', 'desc')->where('status', true)->get();
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

    $activeCard = Carders::select('carders.id', 'card_ministries.carderName as govmin', 'carders.cardname as carders', 'carders.status')
        ->join('card_ministries', 'card_ministries.id', '=', 'carders.ministry')
        ->where('carders.status', true);

    $inactiveCard = Carders::select('carders.id', 'card_ministries.carderName as govmin', 'carders.cardname as carders', 'carders.status')
        ->join('card_ministries', 'card_ministries.id', '=', 'carders.ministry')
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
Route::controller(FrontEndController::class)->group(function () {
    Route::post('user/inquiry', 'UserInquiry')->name('user.inquiry');
    Route::get('/user/entry', 'index')->name('user.entry.page');
    Route::get('/user/contact/us', 'contactus')->name('user.entry.contact');
    Route::post('/contact/us/save/', 'ContactUsSave')->name('save.contact.us');
    Route::get('/user/frequent/question', 'FrequentQuestion')->name('user.frequent.question');
    Route::get('/user/view/Establishment', 'Establishment')->name('user.establishment.documents');
    Route::get('/user/view/Jobs/Description', 'Jobs')->name('user.jobs.documents');
    Route::get('/user/view/Service/Schemes', 'Schemes')->name('user.scheme.documents');
    Route::get('/user/view/RAPEX/information', 'Rapex')->name('user.rapex.documents');
    Route::get('/user/view/Service/Uganda', 'ServiceUg')->name('user.serviceug.documents');

    Route::get('/user/view/gallery', 'BlogFive')->name('user.blog');

    Route::get('/preview/{id}/uploaded/excel', 'previewExcel')->name('preview.excel.file');
    Route::get('/download/{id}/approved/excel', 'downloadExcel')->name('download.excel.file');
    //   pdf actions
    Route::get('/preview/{id}/approved/pdf', 'previewPDF')->name('preview.ps.file');
    Route::get('/download/{id}/approved/pdf', 'downloadPDF')->name('download.ps.file');

    Route::get('/viewing/{id}/file_details', 'ViewVote')->name('vote.view');

    Route::get('/job/preview/{id}/approved/pdf', 'previewJobPDF')->name('job.description.preview');
    Route::get('job/download/{id}/approved/pdf', 'downloadJobPDF')->name('job.description.download');

    Route::get('/download/{id}/attachement/zip', 'createZip')->name('create.rapex.zip');
    Route::get('/download/{id}/attachement/zip', 'createZipSU')->name('create.su.zip');
    Route::get('/download/{string}/attachement/file', 'downloadSUfile')->name('su.download.file');
    Route::get('/preview/{string}/attachement/pdf', 'previewSUPdf')->name('su.pdf.view');

     Route::get('Manage/Productivity/Files', 'ProductivityIndex')->name('user.productivity.documents');
         Route::get('Manage/Research/Files', 'ResearchIndex')->name('user.research.documents');
             Route::get('Manage/Reform/Files', 'ReformIndex')->name('user.reform.documents');




});
Route::prefix('edbrs.com')->group(function () {
    Route::controller(InquiryController::class)->group(function () {
        Route::get('inquiry/list','messageList')->name('inquiry.list');
        Route::get('inquiry/{id}/reply','ReplyInquiry')->name('inquiry.reply');
        Route::put('inquiry/save/{id}/reply','store')->name('inquiry.store');
        Route::delete('inquiry/{id}/archive','SoftDeleteInquiry')->name('inquiry.soft.delete');
        Route::delete('inquiry/{id}/delete','DeleteInquiry')->name('inquiry.delete');
    });
});

Route::prefix('edbrs.com')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/index/home', 'index')->name('home.dashboard');
        Route::get('/system/faq', 'FrequentQuestions')->name('faq');
        Route::post('Ask/Your/Question', 'AskQuestion')->name('ask.question');
        Route::get('/contact/us', 'ContactUS')->name('contact-us');

//  job.description.download
    });

});

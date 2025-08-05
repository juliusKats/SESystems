<?php
namespace Database\Seeders;

use App\Models\Carders;
use App\Models\CardMinistries;
use App\Models\DocStatus;
use App\Models\Services;
use App\Models\GovEntities;
use App\Models\ImageCategory;
use App\Models\Institutions;
use App\Models\Questions;
use App\Models\ServiceCenter;
use App\Models\Team;
use App\Models\User;
use App\Models\Version;
use App\Models\VoteDetails;
use App\Models\CountryCodes;
// use App\Models\ImageCategory;
use App\Models\YearMonths;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class DefaultSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $imgcat1 = ImageCategory::create(['Category' => 'General', 'status' => false]);
        $imgcat2 = ImageCategory::create(['Category' => 'Life Style', 'status' => false]);
        $imgcat3 = ImageCategory::create(['Category' => 'Travel', 'status' => false]);
        $imgcat4 = ImageCategory::create(['Category' => 'Design', 'status' => false]);
        $imgcat5 = ImageCategory::create(['Category' => 'Creative', 'status' => false]);
        $imgcat6 = ImageCategory::create(['Category' => 'Education', 'status' => false]);
        $imgcat7 = ImageCategory::create(['Category' => 'Meetings', 'status' => false]);
        $imgcat8 = ImageCategory::create(['Category' => 'Others', 'status' => false]);
         $imgcat8 = ImageCategory::create(['Category' => 'Finance', 'status' => false]);


        $status7 = DocStatus::create(['statusName' => 'None']);
        $status1 = DocStatus::create(['statusName' => 'Pending']);
        $status2 = DocStatus::create(['statusName' => 'Active']);
        $status4 = DocStatus::create(['statusName' => 'Reject']);
        $status5 = DocStatus::create(['statusName' => 'Deleted']);
        $status6 = DocStatus::create(['statusName' => 'Restored']);

        $v1 = Version::create(['versionname' => 'Version 1', 'versionabbrev' => 'V.1']);
        $v1 = Version::create(['versionname' => 'Version 2', 'versionabbrev' => 'V.2']);
        $v1 = Version::create(['versionname' => 'Version 3', 'versionabbrev' => 'V.3']);
        $v1 = Version::create(['versionname' => 'Version 4', 'versionabbrev' => 'V.4']);
        $v1 = Version::create(['versionname' => 'Version 5', 'versionabbrev' => 'V.5']);
        //Entities
        $entity1 = Services::create(['serviceName' => 'Establishment']);
        $entity2 = Services::create(['serviceName' => 'Scheme Of Service']);
        $entity3 = Services::create(['serviceName' => 'Job Description']);
        $entity4 = Services::create(['serviceName' => 'RAPEX Documents']);
        //Default Months
        $month1  = YearMonths::create(['mName' => 'January']);
        $month2  = YearMonths::create(['mName' => 'February']);
        $month3  = YearMonths::create(['mName' => 'March']);
        $month4  = YearMonths::create(['mName' => 'April']);
        $month5  = YearMonths::create(['mName' => 'May']);
        $month6  = YearMonths::create(['mName' => 'June']);
        $month7  = YearMonths::create(['mName' => 'July']);
        $month8  = YearMonths::create(['mName' => 'August']);
        $month9  = YearMonths::create(['mName' => 'September']);
        $month10 = YearMonths::create(['mName' => 'October']);
        $month11 = YearMonths::create(['mName' => 'November']);
        $month12 = YearMonths::create(['mName' => 'December']);

        // CREATE DEFAULT USER
        $superadm = User::create([
            'fname'           => 'Super',
            'sname'           => 'Amin',
            'email'           => 'superadmin@gchs.com',
            'password'        => Hash::make('password'),
            'is_admin'        => true,
            'status'          => true,
            'is_email_verified'=>true,
            'email_verified_at'=>Carbon::now(),
            'role'            => 'superadmin',
            'current_team_id' => 1,
            'created_at'      => now(),
            'updated_at'      => Carbon::now(),
        ]);
        $superteam2 = Team::create([
            'user_id'       => $superadm->id,
            'name'          => $superadm->sname,
            'personal_team' => true,
            'created_at'    => \Carbon\Carbon::now(),
            'updated_at'    => \Carbon\Carbon::now(),
        ]);
        $superadmin = User::create([
            'sname'           => 'Mops',
            'fname'           => 'Admin',
            'email'           => 'superadmin@mops.com',
            'password'        => Hash::make('password'),
            'is_admin'        => true,
            'status'          => true,
            'is_email_verified'=>true,
            'email_verified_at'=>Carbon::now(),
            'role'            => 'superadmin',
            'current_team_id' => 1,
            'created_at'      => now(),
            'updated_at'      => Carbon::now(),
        ]);
        $superteam = Team::create([
            'user_id'       => $superadmin->id,
            'name'          => $superadmin->sname,
            'personal_team' => true,
            'created_at'    => \Carbon\Carbon::now(),
            'updated_at'    => \Carbon\Carbon::now(),
        ]);

        $admin = User::create([
            'fname'           => 'Tumbs',
            'sname'           => 'Allan',
            'email'           => 'admin@mops.com',
            'password'        => Hash::make('password'),
            'is_admin'        => true,
            'status'          => true,
            'is_email_verified'=>true,
            'email_verified_at'=>Carbon::now(),
            'role'            => 'admin',
            'current_team_id' => 1,
            'created_at'      => \Carbon\Carbon::now(),
            'updated_at'      => \Carbon\Carbon::now(),
        ]);
        $adminteam = Team::create([
            'user_id'       => $admin->id,
            'name'          => $admin->sname,
            'personal_team' => true,
            'created_at'    => \Carbon\Carbon::now(),
            'updated_at'    => \Carbon\Carbon::now(),
        ]);
        $user = User::create([
            'fname'           => 'User',
            'sname'           => 'First',
            'email'           => 'user@mops.com',
            'password'        => Hash::make('password'),
            'is_admin'        => false,
            'status'          => false,
            'is_email_verified'=>true,
            'email_verified_at'=>Carbon::now(),
            'role'            => 'user',
            'current_team_id' => 1,
            'created_at'      => \Carbon\Carbon::now(),
            'updated_at'      => \Carbon\Carbon::now(),
        ]);
        $userteam = Team::create([
            'user_id'       => $user->id,
            'name'          => $user->sname,
            'personal_team' => true,
            'created_at'    => \Carbon\Carbon::now(),
            'updated_at'    => \Carbon\Carbon::now(),
        ]);

        $user1 = User::create([
            'fname'           => 'User',
            'sname'           => 'Second',
            'email'           => 'user1@mops.com',
            'password'        => Hash::make('password'),
            'is_admin'        => false,
            'status'          => false,
            'is_email_verified'=>true,
            'email_verified_at'=>Carbon::now(),
            'role'            => 'user',
            'current_team_id' => 1,
            'created_at'      => \Carbon\Carbon::now(),
            'updated_at'      => \Carbon\Carbon::now(),
        ]);
        $userteam1 = Team::create([
            'user_id'       => $user1->id,
            'name'          => $user1->sname,
            'personal_team' => true,
            'created_at'    => \Carbon\Carbon::now(),
            'updated_at'    => \Carbon\Carbon::now(),
        ]);

        // CREATE DEFAULT QUESTIONS
        $qn1 = Questions::create(['mobile' => "+256772100100", 'question' => 'Can I Upload The Vote Without A Permanent Secrete Approval File', 'reply' => 'No. PS Approval File is required', 'is_replied' => true, 'repliedOn' => now(), 'active' => true, 'repliedBy' => $superadmin->id]);
        $qn2 = Questions::create(['mobile' => "+256772100100", 'question' => "I Can't Upload PS Files.", 'reply' => 'PS Approval File Must be a pdf file', 'is_replied' => true, 'repliedOn' => now(), 'active' => true, 'repliedBy' => $superadmin->id]);
        $qn3 = Questions::create(['mobile' => '+256772100100', 'question' => "I Can't See My uploaded files in the list.", 'reply' => 'Yes. You can only View Your Files when they are approved by the Administrator', 'is_replied' => true, 'repliedOn' => now(), 'active' => true, 'repliedBy' => $superadmin->id]);
        $qn4 = Questions::create(['mobile' => '+256772100100', 'question' => 'I have Failed To Upload Files when I have attached all the files.', 'reply' => 'Confirm Wherther you have Selected the vote code and Selected the PS PDF approval date', 'is_replied' => true, 'repliedOn' => now(), 'active' => true, 'repliedBy' => $superadmin->id]);
        $qn5 = Questions::create(['mobile' => '+256772100100', 'question' => 'File has failed to upload.', 'reply' => "Check whether the PS PDF File approve date is not above current date (Today's Date)", 'is_replied' => true, 'repliedOn' => now(), 'active' => true, 'repliedBy' => $superadmin->id]);
        $qn6 = Questions::create(['mobile' => '+256772100100', 'question' => 'I cannot delete or update files.', 'reply' => 'Yes. You can only Edit or delete the files you have uploaded. Unless you are the System Administrator', 'is_replied' => true, 'repliedOn' => now(), 'active' => true, 'repliedBy' => $superadmin->id]);
        $qn7 = Questions::create(['mobile' => '+256772100100', 'question' => 'I cannot login to upload files', 'reply' => 'This happens when the administror has deactivated your account. Contact the administrator to activate your Account', 'is_replied' => true, 'repliedOn' => now(), 'active' => true, 'repliedBy' => $superadmin->id]);

        // CREATE DEFAULT VOTES

        $code1   = VoteDetails::create(['votecode' => '001', 'votename' => 'OFFICE OF THE PRESIDENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code2   = VoteDetails::create(['votecode' => '002', 'votename' => 'STATE HOUSE', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code3   = VoteDetails::create(['votecode' => '003', 'votename' => 'OFFICE OF THE PRIME MINISTER', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code4   = VoteDetails::create(['votecode' => '004', 'votename' => 'MINISTRY OF DEFENCE AND VETERAN AFFAIRS', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code5   = VoteDetails::create(['votecode' => '005', 'votename' => 'MINISTRY OF PUBLIC SERVICE', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code6   = VoteDetails::create(['votecode' => '006', 'votename' => 'MINISTRY OF FOREIGN AFFAIRS', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code7   = VoteDetails::create(['votecode' => '007', 'votename' => 'MINISTRY OF JUSTICE AND CONSTITUTIONAL AFFAIRS', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code8   = VoteDetails::create(['votecode' => '008', 'votename' => 'MINISTRY OF FINANCE, PLANNING AND ECONOMIC DEVELOPMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code9   = VoteDetails::create(['votecode' => '009', 'votename' => 'MINISTRY OF INTERNAL AFFAIRS', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code10  = VoteDetails::create(['votecode' => '010', 'votename' => 'MINISTRY OF AGRICULTURE, ANIMAL INDUSTRY AND FISHERIES', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code11  = VoteDetails::create(['votecode' => '011', 'votename' => 'MINISTRY OF LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code12  = VoteDetails::create(['votecode' => '012', 'votename' => 'MINISTRY OF LANDS, HOUSING AND URBAN DEVELOPMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code13  = VoteDetails::create(['votecode' => '013', 'votename' => 'MINISTRY OF EDUCATION AND SPORTS', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code14  = VoteDetails::create(['votecode' => '014', 'votename' => 'MINISTRY OF HEALTH', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code15  = VoteDetails::create(['votecode' => '015', 'votename' => 'MINISTRY OF TRADE, INDUSTRY AND CO-OPERATIVES', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code16  = VoteDetails::create(['votecode' => '016', 'votename' => 'MINISTRY OF WORKS, AND TRANSPORT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code17  = VoteDetails::create(['votecode' => '017', 'votename' => 'MINISTRY OF ENERGY AND MINERAL DEVELOPMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code18  = VoteDetails::create(['votecode' => '018', 'votename' => 'MINISTRY OF GENDER, LABOUR AND SOCIAL DEVELOPMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code19  = VoteDetails::create(['votecode' => '019', 'votename' => 'MINISTRY OF WATER AND ENVIRONMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code20  = VoteDetails::create(['votecode' => '020', 'votename' => 'MINISTRY OF INFORMATION COMMUNICATION TECHNOLOGY AND NATIONAL GUIDANCE', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code21  = VoteDetails::create(['votecode' => '021', 'votename' => 'MINISTRY OF EAST AFRICAN COMMUNITY AFFAIRS', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code22  = VoteDetails::create(['votecode' => '022', 'votename' => 'MINISTRY OF TOURISM, WILDLIFE AND ANTIQUITIES', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code23  = VoteDetails::create(['votecode' => '101', 'votename' => 'COURTS OF JUDICATURE', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code24  = VoteDetails::create(['votecode' => '104', 'votename' => 'PARLIAMENTARY COMMISSION (PARL)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code25  = VoteDetails::create(['votecode' => '105', 'votename' => 'UGANDA LAW REFORM COMMISSION (ULRC)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code26  = VoteDetails::create(['votecode' => '107', 'votename' => 'UGANDA AIDS COMMISSION (UAC)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code27  = VoteDetails::create(['votecode' => '108', 'votename' => 'NATIONAL PLANNING AUTHORITY (NPA)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code28  = VoteDetails::create(['votecode' => '112', 'votename' => 'DIRECTORATE OF ETHICS AND INTEGRITY (DEI)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code29  = VoteDetails::create(['votecode' => '115', 'votename' => 'UGANDA HEART INSTITUTE (UHI)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code30  = VoteDetails::create(['votecode' => '120', 'votename' => 'NATIONAL CITIZENSHIP AND IMMIGRATION CONTROL (NCIC)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code31  = VoteDetails::create(['votecode' => '122', 'votename' => 'KAMPALA CAPITAL CITY AUTHORITY (KCCA)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code32  = VoteDetails::create(['votecode' => '124', 'votename' => 'EQUAL OPPORTUNITIES COMMISSION', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code33  = VoteDetails::create(['votecode' => '126', 'votename' => 'NATIONAL INFORMATION TECHNOLOGY AUTHORITY', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code34  = VoteDetails::create(['votecode' => '306', 'votename' => 'MUNI UNIVERSITY', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code35  = VoteDetails::create(['votecode' => '132', 'votename' => 'EDUCATION SERVICE COMMISSION (ESC)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code36  = VoteDetails::create(['votecode' => '134', 'votename' => 'HEALTH SERVICE COMMISSION (HSC)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code37  = VoteDetails::create(['votecode' => '301', 'votename' => 'MAKERERE UNIVERSITY', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code38  = VoteDetails::create(['votecode' => '304', 'votename' => 'KYAMBOGO UNIVERSITY', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code39  = VoteDetails::create(['votecode' => '144', 'votename' => 'UGANDA POLICE FORCE', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code40  = VoteDetails::create(['votecode' => '146', 'votename' => 'PUBLIC SERVICE COMMISSION (PSC)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code41  = VoteDetails::create(['votecode' => '147', 'votename' => 'LOCAL GOVERNMENT FINANCE COMMISSION (LGFC)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code42  = VoteDetails::create(['votecode' => '148', 'votename' => 'JUDICIAL SERVICE COMMISSION (JSC)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code43  = VoteDetails::create(['votecode' => '150', 'votename' => 'NATIONAL ENVIRONMENT MANAGEMENT AUTHORITY (NEMA)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code44  = VoteDetails::create(['votecode' => '151', 'votename' => 'UGANDA BLOOD TRANSFUSION SERVICES (UBTS)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code45  = VoteDetails::create(['votecode' => '156', 'votename' => 'UGANDA LAND COMMISSION (ULC)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code46  = VoteDetails::create(['votecode' => '401', 'votename' => 'MULAGO NATIONAL REFERRAL HOSPITAL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code47  = VoteDetails::create(['votecode' => '410', 'votename' => 'MBALE REGIONAL REFERRAL HOSPITAL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code48  = VoteDetails::create(['votecode' => '310', 'votename' => 'LIRA UNIVERSITY', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code49  = VoteDetails::create(['votecode' => '127', 'votename' => 'UGANDA VIRUS RESEARCH INSTITUTE (UVRI)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code50  = VoteDetails::create(['votecode' => '135', 'votename' => 'DIRECTORATE OF GOVERNMENT ANALYTICAL LABORATORY (DGAL)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code51  = VoteDetails::create(['votecode' => '307', 'votename' => 'KABALE UNIVERSITY', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code52  = VoteDetails::create(['votecode' => '308', 'votename' => 'SOROTI UNIVERSITY', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code53  = VoteDetails::create(['votecode' => '838', 'votename' => 'JINJA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code54  = VoteDetails::create(['votecode' => '880', 'votename' => 'LIRA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code55  = VoteDetails::create(['votecode' => '891', 'votename' => 'MBALE DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code56  = VoteDetails::create(['votecode' => '892', 'votename' => 'MBARARA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code57  = VoteDetails::create(['votecode' => '897', 'votename' => 'MPIGI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code58  = VoteDetails::create(['votecode' => '933', 'votename' => 'WAKISO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code59  = VoteDetails::create(['votecode' => '705', 'votename' => 'ENTEBBE MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code60  = VoteDetails::create(['votecode' => '703', 'votename' => 'BUSHENYI-ISHAKA MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code61  = VoteDetails::create(['votecode' => '023', 'votename' => 'MINISTRY OF KAMPALA CAPITAL CITY AND METROPOLITAN AFFAIRS', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code62  = VoteDetails::create(['votecode' => '102', 'votename' => 'ELECTORAL COMMISSION (EC)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code63  = VoteDetails::create(['votecode' => '103', 'votename' => 'INSPECTOR GENERAL OF GOVERNMENT’S OFFICE (IGG)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code64  = VoteDetails::create(['votecode' => '106', 'votename' => 'UGANDA HUMAN RIGHTS COMMISSION (UHRC)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code65  = VoteDetails::create(['votecode' => '311', 'votename' => 'LAW DEVELOPMENT CENTRE.', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code66  = VoteDetails::create(['votecode' => '110', 'votename' => 'UGANDA INDUSTRIAL RESEARCH INSTITUTE (UIRI)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code67  = VoteDetails::create(['votecode' => '305', 'votename' => 'BUSITEMA UNIVERSITY', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code68  = VoteDetails::create(['votecode' => '113', 'votename' => 'UGANDA NATIONAL ROADS AUTHORITY (UNRA)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code69  = VoteDetails::create(['votecode' => '114', 'votename' => 'UGANDA CANCER INSTITUTE (UCI)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code70  = VoteDetails::create(['votecode' => '116', 'votename' => 'UGANDA NATIONAL MEDICAL STORES', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code71  = VoteDetails::create(['votecode' => '117', 'votename' => 'UGANDA TOURISM BOARD (UTB)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code72  = VoteDetails::create(['votecode' => '118', 'votename' => 'UGANDA ROAD FUND (RF)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code73  = VoteDetails::create(['votecode' => '119', 'votename' => 'UGANDA REGISTRATION SERVICES BUREAU (URSB)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code74  = VoteDetails::create(['votecode' => '121', 'votename' => 'DIARY DEVELOPMENT AUTHORITY (DDA)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code75  = VoteDetails::create(['votecode' => '125', 'votename' => 'NATIONAL ANIMAL GENETIC RESOURCE CENTRE AND DATA BANK', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code76  = VoteDetails::create(['votecode' => '128', 'votename' => 'UGANDA NATIONAL EXAMINATION BOARD (UNEB)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code77  = VoteDetails::create(['votecode' => '129', 'votename' => 'FINANCIAL INTELLIGENCE AUTHORITY (FIA)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code78  = VoteDetails::create(['votecode' => '130', 'votename' => 'TREASURY OPERATIONS (TOP)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code79  = VoteDetails::create(['votecode' => '131', 'votename' => 'OFFICE OF THE AUDITOR GENERAL (OAG)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code80  = VoteDetails::create(['votecode' => '133', 'votename' => 'DIRECTORATE OF PUBLIC PROSECUTIONS(DPP)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code81  = VoteDetails::create(['votecode' => '302', 'votename' => 'MBARARA UNIVERSITY', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code82  = VoteDetails::create(['votecode' => '303', 'votename' => 'MAKERERE UNIVERSITY BUSINESS SCHOOL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code83  = VoteDetails::create(['votecode' => '312', 'votename' => 'UGANDA MANAGEMENT INSTITUTE', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code84  = VoteDetails::create(['votecode' => '142', 'votename' => 'NATIONAL AGRICULTURAL RESEARCH ORGANIZATION(NARO)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code85  = VoteDetails::create(['votecode' => '143', 'votename' => 'UGANDA BUREAU OF STATISTICS (UBOS)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code86  = VoteDetails::create(['votecode' => '145', 'votename' => 'UGANDA PRISONS SERVICES', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code87  = VoteDetails::create(['votecode' => '309', 'votename' => 'GULU UNIVERSITY', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code88  = VoteDetails::create(['votecode' => '152', 'votename' => 'NATIONAL AGRICULTURAL ADVISORY SERVICES (NAADS)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code89  = VoteDetails::create(['votecode' => '153', 'votename' => 'PUBLIC PROCUREMENT AND DISPOSAL OF PUBLIC ASSETS AUTHORITY', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code90  = VoteDetails::create(['votecode' => '154', 'votename' => 'UGANDA NATIONAL BUREAU OF STANDARDS (UNBS)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code91  = VoteDetails::create(['votecode' => '155', 'votename' => 'COTTON DEVELOPMENT ORGANIZATION', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code92  = VoteDetails::create(['votecode' => '157', 'votename' => 'NATIONAL FORESTRY AUTHORITY (NFA)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code93  = VoteDetails::create(['votecode' => '158', 'votename' => 'INTERNAL SECURITY ORGANIZATION (ISO)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code94  = VoteDetails::create(['votecode' => '159', 'votename' => 'EXTERNAL SECURITY ORGANIZATION (ESO)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code95  = VoteDetails::create(['votecode' => '160', 'votename' => 'UGANDA COFFEE DEVELOPMENT AUTHORITY (UCDA)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code96  = VoteDetails::create(['votecode' => '402', 'votename' => 'BUTABIKA NATIONAL REFERRAL MENTAL HOSPITAL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code97  = VoteDetails::create(['votecode' => '403', 'votename' => 'ARUA REGIONAL REFERRAL HOSPITAL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code98  = VoteDetails::create(['votecode' => '404', 'votename' => 'FORT PORTAL REGIONAL REFERRAL HOSPITAL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code99  = VoteDetails::create(['votecode' => '405', 'votename' => 'GULU REGIONAL REFERRAL HOSPITAL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code100 = VoteDetails::create(['votecode' => '406', 'votename' => 'HOIMA REGIONAL REFERRAL HOSPITAL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code101 = VoteDetails::create(['votecode' => '407', 'votename' => 'JINJA REGIONAL REFERRAL HOSPITAL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code102 = VoteDetails::create(['votecode' => '408', 'votename' => 'KABALE REGIONAL REFERRAL HOSPITAL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code103 = VoteDetails::create(['votecode' => '409', 'votename' => 'MASAKA REGIONAL REFERRAL HOSPITAL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code104 = VoteDetails::create(['votecode' => '411', 'votename' => 'SOROTI REGIONAL REFERRAL HOSPITAL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code105 = VoteDetails::create(['votecode' => '412', 'votename' => 'LIRA REGIONAL REFERRAL HOSPITAL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code106 = VoteDetails::create(['votecode' => '413', 'votename' => 'MBARARA REGIONAL REFERRAL HOSPITAL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code107 = VoteDetails::create(['votecode' => '414', 'votename' => 'MUBENDE REGIONAL REFERRAL HOSPITAL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code108 = VoteDetails::create(['votecode' => '415', 'votename' => 'MOROTO REGIONAL REFERRAL HOSPITAL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code109 = VoteDetails::create(['votecode' => '416', 'votename' => 'CHINA-UGANDA FRIENDSHIP HOSPITAL NAGURU', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code110 = VoteDetails::create(['votecode' => '417', 'votename' => 'KIRUDDU SPECIALISED NATIONAL REFERRAL HOSPITAL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code111 = VoteDetails::create(['votecode' => '418', 'votename' => 'KAWEMPE SPECIALISED NATIONAL REFERRAL HOSPITAL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code112 = VoteDetails::create(['votecode' => '419', 'votename' => 'ENTEBBE REGIONAL REFERRAL HOSPITAL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code113 = VoteDetails::create(['votecode' => '420', 'votename' => 'MULAGO SPECIALIZED WOMEN AND NEONATAL HOSPITAL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code114 = VoteDetails::create(['votecode' => '109', 'votename' => 'UGANDA NATIONAL METEOROLOGICAL AUTHORITY (UNMA)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code115 = VoteDetails::create(['votecode' => '111', 'votename' => 'NATIONAL CURRICULUM DEVELOPMENT CENTRE (NCDC)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code116 = VoteDetails::create(['votecode' => '136', 'votename' => 'UGANDA EXPORT PROMOTION BOARD (UEPB)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code117 = VoteDetails::create(['votecode' => '137', 'votename' => 'NATIONAL IDENTIFICATION AND REGISTRATION AUTHORITY (NIRA)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code118 = VoteDetails::create(['votecode' => '138', 'votename' => 'UGANDA INVESTMENT AUTHORITY (UIA)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code119 = VoteDetails::create(['votecode' => '139', 'votename' => 'PETROLEUM AUTHORITY OF UGANDA (PAU)', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code120 = VoteDetails::create(['votecode' => '140', 'votename' => 'CAPITAL MARKETS AUTHORITY', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code121 = VoteDetails::create(['votecode' => '123', 'votename' => 'NATIONAL LOTTERIES AND GAMING REGULATORY BOARD', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code122 = VoteDetails::create(['votecode' => '149', 'votename' => 'NATIONAL POPULATION COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code123 = VoteDetails::create(['votecode' => '161', 'votename' => 'UGANDA FREE ZONES AUTHORITY', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code124 = VoteDetails::create(['votecode' => '162', 'votename' => 'UGANDA MICROFINANCE REGULATORY AUTHORITY', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code125 = VoteDetails::create(['votecode' => '163', 'votename' => 'UGANDA RETIREMENTS BENEFITS REGULATORY AUTHORITY', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code126 = VoteDetails::create(['votecode' => '164', 'votename' => 'NATIONAL COUNCIL FOR HIGHER EDUCATION', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code127 = VoteDetails::create(['votecode' => '165', 'votename' => 'UGANDA BUSINESS AND TECHNICAL EXAMINATION BOARD', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code128 = VoteDetails::create(['votecode' => '166', 'votename' => 'NATIONAL COUNCIL OF SPORTS', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code129 = VoteDetails::create(['votecode' => '802', 'votename' => 'ADJUMANI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code130 = VoteDetails::create(['votecode' => '809', 'votename' => 'APAC DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code131 = VoteDetails::create(['votecode' => '810', 'votename' => 'ARUA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code132 = VoteDetails::create(['votecode' => '813', 'votename' => 'BUGIRI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code133 = VoteDetails::create(['votecode' => '822', 'votename' => 'BUNDIBUGYO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code134 = VoteDetails::create(['votecode' => '824', 'votename' => 'BUSHENYI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code135 = VoteDetails::create(['votecode' => '825', 'votename' => 'BUSIA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code136 = VoteDetails::create(['votecode' => '833', 'votename' => 'GULU DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code137 = VoteDetails::create(['votecode' => '834', 'votename' => 'HOIMA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code138 = VoteDetails::create(['votecode' => '836', 'votename' => 'IGANGA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code139 = VoteDetails::create(['votecode' => '840', 'votename' => 'KABALE DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code140 = VoteDetails::create(['votecode' => '841', 'votename' => 'KABAROLE DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code141 = VoteDetails::create(['votecode' => '842', 'votename' => 'KABERAMAIDO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code142 = VoteDetails::create(['votecode' => '846', 'votename' => 'KALANGALA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code143 = VoteDetails::create(['votecode' => '849', 'votename' => 'KAMULI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code144 = VoteDetails::create(['votecode' => '850', 'votename' => 'KAMWENGE DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code145 = VoteDetails::create(['votecode' => '851', 'votename' => 'KANUNGU DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code146 = VoteDetails::create(['votecode' => '852', 'votename' => 'KAPCHORWA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code147 = VoteDetails::create(['votecode' => '856', 'votename' => 'KASESE DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code148 = VoteDetails::create(['votecode' => '857', 'votename' => 'KATAKWI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code149 = VoteDetails::create(['votecode' => '858', 'votename' => 'KAYUNGA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code150 = VoteDetails::create(['votecode' => '860', 'votename' => 'KIBALE DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code151 = VoteDetails::create(['votecode' => '861', 'votename' => 'KIBOGA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code152 = VoteDetails::create(['votecode' => '866', 'votename' => 'KISORO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code153 = VoteDetails::create(['votecode' => '868', 'votename' => 'KITGUM DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code154 = VoteDetails::create(['votecode' => '871', 'votename' => 'KOTIDO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code155 = VoteDetails::create(['votecode' => '872', 'votename' => 'KUMI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code156 = VoteDetails::create(['votecode' => '877', 'votename' => 'KYENJOJO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code157 = VoteDetails::create(['votecode' => '882', 'votename' => 'LUWERO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code158 = VoteDetails::create(['votecode' => '888', 'votename' => 'MASAKA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code159 = VoteDetails::create(['votecode' => '889', 'votename' => 'MASINDI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code160 = VoteDetails::create(['votecode' => '890', 'votename' => 'MAYUGE DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code161 = VoteDetails::create(['votecode' => '895', 'votename' => 'MOROTO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code162 = VoteDetails::create(['votecode' => '896', 'votename' => 'MOYO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code163 = VoteDetails::create(['votecode' => '898', 'votename' => 'MUBENDE DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code164 = VoteDetails::create(['votecode' => '899', 'votename' => 'MUKONO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code165 = VoteDetails::create(['votecode' => '901', 'votename' => 'NAKAPIRIPIRI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code166 = VoteDetails::create(['votecode' => '903', 'votename' => 'NAKASONGOLA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code167 = VoteDetails::create(['votecode' => '908', 'votename' => 'NEBBI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code168 = VoteDetails::create(['votecode' => '911', 'votename' => 'NTUNGAMO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code169 = VoteDetails::create(['votecode' => '917', 'votename' => 'PADER DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code170 = VoteDetails::create(['votecode' => '919', 'votename' => 'PALLISA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code171 = VoteDetails::create(['votecode' => '920', 'votename' => 'RAKAI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code172 = VoteDetails::create(['votecode' => '924', 'votename' => 'RUKUNGIRI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code173 = VoteDetails::create(['votecode' => '926', 'votename' => 'SEMBABULE DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code174 = VoteDetails::create(['votecode' => '929', 'votename' => 'SIRONKO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code175 = VoteDetails::create(['votecode' => '930', 'votename' => 'SOROTI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code176 = VoteDetails::create(['votecode' => '932', 'votename' => 'TORORO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code177 = VoteDetails::create(['votecode' => '934', 'votename' => 'YUMBE DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code178 = VoteDetails::create(['votecode' => '826', 'votename' => 'BUTALEJA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code179 = VoteDetails::create(['votecode' => '835', 'votename' => 'IBANDA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code180 = VoteDetails::create(['votecode' => '839', 'votename' => 'KAABONG DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code181 = VoteDetails::create(['votecode' => '837', 'votename' => 'ISINGIRO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code182 = VoteDetails::create(['votecode' => '847', 'votename' => 'KALIRO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code183 = VoteDetails::create(['votecode' => '864', 'votename' => 'KIRUHURA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code184 = VoteDetails::create(['votecode' => '869', 'votename' => 'KOBOKO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code185 = VoteDetails::create(['votecode' => '805', 'votename' => 'AMOLATAR DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code186 = VoteDetails::create(['votecode' => '807', 'votename' => 'AMURIA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code187 = VoteDetails::create(['votecode' => '886', 'votename' => 'MANAFWA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code188 = VoteDetails::create(['votecode' => '819', 'votename' => 'BUKWA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code189 = VoteDetails::create(['votecode' => '894', 'votename' => 'MITYANA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code190 = VoteDetails::create(['votecode' => '902', 'votename' => 'NAKASEKE DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code191 = VoteDetails::create(['votecode' => '808', 'votename' => 'AMURU DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code192 = VoteDetails::create(['votecode' => '811', 'votename' => 'BUDAKA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code193 = VoteDetails::create(['votecode' => '916', 'votename' => 'OYAM DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code194 = VoteDetails::create(['votecode' => '801', 'votename' => 'ABIM DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code195 = VoteDetails::create(['votecode' => '906', 'votename' => 'NAMUTAMBA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code196 = VoteDetails::create(['votecode' => '831', 'votename' => 'DOKOLO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code197 = VoteDetails::create(['votecode' => '821', 'votename' => 'BULISA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code198 = VoteDetails::create(['votecode' => '887', 'votename' => 'MARACHA-TEREGO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code199 = VoteDetails::create(['votecode' => '817', 'votename' => 'BUKEDEA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code200 = VoteDetails::create(['votecode' => '812', 'votename' => 'BUDUDA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code201 = VoteDetails::create(['votecode' => '884', 'votename' => 'LYANTONDE DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code202 = VoteDetails::create(['votecode' => '806', 'votename' => 'AMUDAT DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code203 = VoteDetails::create(['votecode' => '816', 'votename' => 'BUIKWE DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code204 = VoteDetails::create(['votecode' => '830', 'votename' => 'BUYENDE DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code205 = VoteDetails::create(['votecode' => '876', 'votename' => 'KYEGEGWA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code206 = VoteDetails::create(['votecode' => '879', 'votename' => 'LAMWO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code207 = VoteDetails::create(['votecode' => '915', 'votename' => 'OTUKE DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code208 = VoteDetails::create(['votecode' => '935', 'votename' => 'ZOMBO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code209 = VoteDetails::create(['votecode' => '804', 'votename' => 'ALEBTONG DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code210 = VoteDetails::create(['votecode' => '820', 'votename' => 'BULAMBULI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code211 = VoteDetails::create(['votecode' => '829', 'votename' => 'BUVUMA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code212 = VoteDetails::create(['votecode' => '832', 'votename' => 'GOMBA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code213 = VoteDetails::create(['votecode' => '865', 'votename' => 'KIRYANDONGO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code214 = VoteDetails::create(['votecode' => '881', 'votename' => 'LUUKA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code215 = VoteDetails::create(['votecode' => '904', 'votename' => 'NAMAYINGO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code216 = VoteDetails::create(['votecode' => '910', 'votename' => 'NTOROKO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code217 = VoteDetails::create(['votecode' => '927', 'votename' => 'SERERE DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code218 = VoteDetails::create(['votecode' => '875', 'votename' => 'KYANKWANZI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code219 = VoteDetails::create(['votecode' => '848', 'votename' => 'KALUNGU DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code220 = VoteDetails::create(['votecode' => '883', 'votename' => 'LWENGO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code221 = VoteDetails::create(['votecode' => '818', 'votename' => 'BUKOMANSIMBI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code222 = VoteDetails::create(['votecode' => '893', 'votename' => 'MITOOMA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code223 = VoteDetails::create(['votecode' => '922', 'votename' => 'RUBIRIZI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code224 = VoteDetails::create(['votecode' => '909', 'votename' => 'NGORA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code225 = VoteDetails::create(['votecode' => '907', 'votename' => 'NAPAK DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code226 = VoteDetails::create(['votecode' => '862', 'votename' => 'KIBUKU DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code227 = VoteDetails::create(['votecode' => '912', 'votename' => 'NWOYA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code228 = VoteDetails::create(['votecode' => '870', 'votename' => 'KOLE DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code229 = VoteDetails::create(['votecode' => '827', 'votename' => 'BUTAMBALA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code230 = VoteDetails::create(['votecode' => '928', 'votename' => 'SHEEMA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code231 = VoteDetails::create(['votecode' => '815', 'votename' => 'BUHWEJU DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code232 = VoteDetails::create(['votecode' => '803', 'votename' => 'AGAGO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code233 = VoteDetails::create(['votecode' => '874', 'votename' => 'KWEEN DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code234 = VoteDetails::create(['votecode' => '843', 'votename' => 'KAGADI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code235 = VoteDetails::create(['votecode' => '844', 'votename' => 'KAKUMIRO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code236 = VoteDetails::create(['votecode' => '914', 'votename' => 'OMORO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code237 = VoteDetails::create(['votecode' => '921', 'votename' => 'RUBANDA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code238 = VoteDetails::create(['votecode' => '905', 'votename' => 'NAMISINDWA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code239 = VoteDetails::create(['votecode' => '918', 'votename' => 'PAKWACH DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code240 = VoteDetails::create(['votecode' => '828', 'votename' => 'BUTEBO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code241 = VoteDetails::create(['votecode' => '923', 'votename' => 'RUKIGA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code242 = VoteDetails::create(['votecode' => '878', 'votename' => 'KYOTERA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code243 = VoteDetails::create(['votecode' => '823', 'votename' => 'BUNYANGABU DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code244 = VoteDetails::create(['votecode' => '900', 'votename' => 'NABILATUK DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code245 = VoteDetails::create(['votecode' => '814', 'votename' => 'BUGWERI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code246 = VoteDetails::create(['votecode' => '855', 'votename' => 'KASANDA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code247 = VoteDetails::create(['votecode' => '873', 'votename' => 'KWANIA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code248 = VoteDetails::create(['votecode' => '853', 'votename' => 'KAPELEBYONG DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code249 = VoteDetails::create(['votecode' => '863', 'votename' => 'KIKUUBE DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code250 = VoteDetails::create(['votecode' => '913', 'votename' => 'OBONGI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code251 = VoteDetails::create(['votecode' => '859', 'votename' => 'KAZO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code252 = VoteDetails::create(['votecode' => '925', 'votename' => 'RWAMPARA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code253 = VoteDetails::create(['votecode' => '867', 'votename' => 'KITAGWENDA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code254 = VoteDetails::create(['votecode' => '885', 'votename' => 'MADI-OKOLLO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code255 = VoteDetails::create(['votecode' => '854', 'votename' => 'KARENGA DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code256 = VoteDetails::create(['votecode' => '845', 'votename' => 'KALAKI DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code257 = VoteDetails::create(['votecode' => '931', 'votename' => 'TEREGO DISTRICT LOCAL GOVERNMENT', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code258 = VoteDetails::create(['votecode' => '708', 'votename' => 'KABALE MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code259 = VoteDetails::create(['votecode' => '722', 'votename' => 'MOROTO MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code260 = VoteDetails::create(['votecode' => '731', 'votename' => 'TORORO MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code261 = VoteDetails::create(['votecode' => '711', 'votename' => 'KASESE MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code262 = VoteDetails::create(['votecode' => '724', 'votename' => 'MUKONO MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code263 = VoteDetails::create(['votecode' => '707', 'votename' => 'IGANGA MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code264 = VoteDetails::create(['votecode' => '720', 'votename' => 'MASINDI MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code265 = VoteDetails::create(['votecode' => '728', 'votename' => 'NTUNGAMO MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code266 = VoteDetails::create(['votecode' => '704', 'votename' => 'BUSIA MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code267 = VoteDetails::create(['votecode' => '729', 'votename' => 'RUKUNGIRI MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code268 = VoteDetails::create(['votecode' => '725', 'votename' => 'NANSANA MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code269 = VoteDetails::create(['votecode' => '719', 'votename' => 'MAKINDYE SSABAGABO MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code270 = VoteDetails::create(['votecode' => '712', 'votename' => 'KIRA MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code271 = VoteDetails::create(['votecode' => '713', 'votename' => 'KISORO MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code272 = VoteDetails::create(['votecode' => '721', 'votename' => 'MITYANA MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code273 = VoteDetails::create(['votecode' => '714', 'votename' => 'KITGUM MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code274 = VoteDetails::create(['votecode' => '715', 'votename' => 'KOBOKO MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code275 = VoteDetails::create(['votecode' => '723', 'votename' => 'MUBENDE MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code276 = VoteDetails::create(['votecode' => '717', 'votename' => 'KUMI MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code277 = VoteDetails::create(['votecode' => '718', 'votename' => 'LUGAZI MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code278 = VoteDetails::create(['votecode' => '709', 'votename' => 'KAMULI MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code279 = VoteDetails::create(['votecode' => '710', 'votename' => 'KAPCHORWA MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code280 = VoteDetails::create(['votecode' => '706', 'votename' => 'IBANDA MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code281 = VoteDetails::create(['votecode' => '727', 'votename' => 'NJERU MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code282 = VoteDetails::create(['votecode' => '701', 'votename' => 'APAC MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code283 = VoteDetails::create(['votecode' => '726', 'votename' => 'NEBBI MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code284 = VoteDetails::create(['votecode' => '702', 'votename' => 'BUGIRI MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code285 = VoteDetails::create(['votecode' => '730', 'votename' => 'SHEEMA MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code286 = VoteDetails::create(['votecode' => '716', 'votename' => 'KOTIDO MUNICIPAL COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code287 = VoteDetails::create(['votecode' => '601', 'votename' => 'ARUA CITY COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code288 = VoteDetails::create(['votecode' => '609', 'votename' => 'MBARARA CITY COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code289 = VoteDetails::create(['votecode' => '603', 'votename' => 'GULU CITY COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code290 = VoteDetails::create(['votecode' => '605', 'votename' => 'JINJA CITY COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code291 = VoteDetails::create(['votecode' => '602', 'votename' => 'FORT PORTAL CITY COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code292 = VoteDetails::create(['votecode' => '608', 'votename' => 'MBALE CITY COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code293 = VoteDetails::create(['votecode' => '607', 'votename' => 'MASAKA CITY COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code294 = VoteDetails::create(['votecode' => '606', 'votename' => 'LIRA CITY COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code295 = VoteDetails::create(['votecode' => '610', 'votename' => 'SOROTI CITY COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $code296 = VoteDetails::create(['votecode' => '604', 'votename' => 'HOIMA CITY COUNCIL', 'Active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);

        $ent1  = GovEntities::create(['id' => 1, 'entityName' => 'Ministry of Education and Sports']);
        $ent2  = GovEntities::create(['id' => 2, 'entityName' => 'Ministry of Tourism, Wildlife and Antiquities (MoTWA)']);
        $ent3  = GovEntities::create(['id' => 3, 'entityName' => 'Ministry of Public Service']);
        $ent4  = GovEntities::create(['id' => 4, 'entityName' => 'Ministry of Gender, Labour and Social Development (MoGLSD)']);
        $ent5  = GovEntities::create(['id' => 5, 'entityName' => 'Ministry of Trade, Industry and Cooperatives (MoTIC)']);
        $ent6  = GovEntities::create(['id' => 6, 'entityName' => 'Ministry of Internal Affairs (MoIA)']);
        $ent7  = GovEntities::create(['id' => 7, 'entityName' => 'Ministry of Works and Transport']);
        $ent8  = GovEntities::create(['id' => 8, 'entityName' => 'Ministry of Energy and Mineral Development (MEMD)']);
        $ent9  = GovEntities::create(['id' => 9, 'entityName' => 'Ministry of Information Technology and National Guidance (MoICT&NG)']);
        $ent10 = GovEntities::create(['id' => 10, 'entityName' => 'Ministry of Finance, Planning and Economic Development (MoFPED)']);
        $ent11 = GovEntities::create(['id' => 11, 'entityName' => 'Ministry of Justice and Constitutional Affairs (MoJCA)']);
        $ent12 = GovEntities::create(['id' => 12, 'entityName' => 'Ministry of Water and Environment (MoWE)']);
        $ent13 = GovEntities::create(['id' => 13, 'entityName' => 'Ministry of Agriculture, Animal Industry and Fisheries (MAAIF)']);
        $ent14 = GovEntities::create(['id' => 14, 'entityName' => 'Office of the Prime Minister']);

        // institutions
        $int1  = Institutions::create(['entity' => $ent1->id, 'lineMinistry' => 'Ministry of Education and Sports', 'institution' => 'Directorate of Industrial Training', 'status' => '0']);
        $int2  = Institutions::create(['entity' => $ent1->id, 'lineMinistry' => 'Ministry of Education and Sports', 'institution' => 'Higher Education Students Financing Board (HESFB)', 'status' => '0']);
        $int3  = Institutions::create(['entity' => $ent1->id, 'lineMinistry' => 'Ministry of Education and Sports', 'institution' => 'Kyambogo Teacher Curriculum', 'status' => '0']);
        $int4  = Institutions::create(['entity' => $ent1->id, 'lineMinistry' => 'Ministry of Education and Sports', 'institution' => 'Management Training and Advisory Centre (MTAC)', 'status' => '0']);
        $int5  = Institutions::create(['entity' => $ent1->id, 'lineMinistry' => 'Ministry of Education and Sports', 'institution' => 'Nakawa Vocational Training College (NVTC)', 'status' => '0']);
        $int6  = Institutions::create(['entity' => $ent1->id, 'lineMinistry' => 'Ministry of Education and Sports', 'institution' => 'National Library of Uganda', 'status' => '0']);
        $int7  = Institutions::create(['entity' => $ent1->id, 'lineMinistry' => 'Ministry of Education and Sports', 'institution' => 'Uganda Allied Health Examinations Board', 'status' => '0']);
        $int8  = Institutions::create(['entity' => $ent1->id, 'lineMinistry' => 'Ministry of Education and Sports', 'institution' => 'Uganda Business, Technical and Vocational Examinat', 'status' => '0']);
        $int9  = Institutions::create(['entity' => $ent1->id, 'lineMinistry' => 'Ministry of Education and Sports', 'institution' => 'Uganda National Commission for UNESCO (UNATCOM)', 'status' => '0']);
        $int10 = Institutions::create(['entity' => $ent1->id, 'lineMinistry' => 'Ministry of Education and Sports', 'institution' => 'Uganda Nurses and Midwives Examinations Board', 'status' => '0']);
        $int11 = Institutions::create(['entity' => $ent2->id, 'lineMinistry' => 'Ministry of Tourism, Wildlife and Antiquities (MoTWA)', 'institution' => 'Uganda Wildlife Authority (UWA)', 'status' => '0']);
        $int12 = Institutions::create(['entity' => $ent2->id, 'lineMinistry' => 'Ministry of Tourism, Wildlife and Antiquities (MoTWA)', 'institution' => 'Uganda Wildlife Education Center (UWEC)', 'status' => '0']);
        $int13 = Institutions::create(['entity' => $ent3->id, 'lineMinistry' => 'Ministry of Public Service', 'institution' => 'National Records and Archives Centre (NRAC)', 'status' => '0']);
        $int14 = Institutions::create(['entity' => $ent4->id, 'lineMinistry' => 'Ministry of Gender, Labour and Social Development (MoGLSD)', 'institution' => 'National Children Authority', 'status' => '0']);
        $int15 = Institutions::create(['entity' => $ent4->id, 'lineMinistry' => 'Ministry of Gender, Labour and Social Development (MoGLSD)', 'institution' => 'National Council for Disability', 'status' => '0']);
        $int16 = Institutions::create(['entity' => $ent4->id, 'lineMinistry' => 'Ministry of Gender, Labour and Social Development (MoGLSD)', 'institution' => 'National Council for Older Persons', 'status' => '0']);
        $int17 = Institutions::create(['entity' => $ent4->id, 'lineMinistry' => 'Ministry of Gender, Labour and Social Development (MoGLSD)', 'institution' => "National Women's Council", 'status' => '0']);
        $int18 = Institutions::create(['entity' => $ent4->id, 'lineMinistry' => 'Ministry of Gender, Labour and Social Development (MoGLSD)', 'institution' => 'National Youth Council', 'status' => '0']);
        $int19 = Institutions::create(['entity' => $ent5->id, 'lineMinistry' => 'Ministry of Trade, Industry and Cooperatives (MoTIC)', 'institution' => 'Uganda Export Promotion Board (UEPB)', 'status' => '0']);
        $int20 = Institutions::create(['entity' => $ent5->id, 'lineMinistry' => 'Ministry of Trade, Industry and Cooperatives (MoTIC)', 'institution' => 'Uganda Free Zones Authority (UFZA) and', 'status' => '0']);
        $int21 = Institutions::create(['entity' => $ent5->id, 'lineMinistry' => 'Ministry of Trade, Industry and Cooperatives (MoTIC)', 'institution' => 'Uganda Warehouse Receipt System Authority (UWRS)', 'status' => '0']);
        $int22 = Institutions::create(['entity' => $ent6->id, 'lineMinistry' => 'Ministry of Internal Affairs (MoIA)', 'institution' => 'Bureau for Non-Governmental Organizations', 'status' => '0']);
        $int23 = Institutions::create(['entity' => $ent6->id, 'lineMinistry' => 'Ministry of Internal Affairs (MoIA)', 'institution' => 'National Identification Registration Authority (NI', 'status' => '0']);
        $int24 = Institutions::create(['entity' => $ent6->id, 'lineMinistry' => 'Ministry of Internal Affairs (MoIA)', 'institution' => 'Registration Function under the National Citizensh', 'status' => '0']);
        $int25 = Institutions::create(['entity' => $ent6->id, 'lineMinistry' => 'Ministry of Internal Affairs (MoIA)', 'institution' => 'Uganda Registration Services Bureau (URSB)', 'status' => '0']);
        $int26 = Institutions::create(['entity' => $ent7->id, 'lineMinistry' => 'Ministry of Works and Transport', 'institution' => 'National Roads Safety Board', 'status' => '0']);
        $int27 = Institutions::create(['entity' => $ent7->id, 'lineMinistry' => 'Ministry of Works and Transport', 'institution' => 'Transport Licensing Board', 'status' => '0']);
        $int28 = Institutions::create(['entity' => $ent7->id, 'lineMinistry' => 'Ministry of Works and Transport', 'institution' => 'Uganda National Roads Authority', 'status' => '0']);
        $int29 = Institutions::create(['entity' => $ent7->id, 'lineMinistry' => 'Ministry of Works and Transport', 'institution' => 'Uganda Road Fund', 'status' => '0']);
        $int30 = Institutions::create(['entity' => $ent8->id, 'lineMinistry' => 'Ministry of Energy and Mineral Development (MEMD)', 'institution' => 'Rural Electrification Agency', 'status' => '0']);
        $int31 = Institutions::create(['entity' => $ent8->id, 'lineMinistry' => 'Ministry of Energy and Mineral Development (MEMD)', 'institution' => 'Uganda Electricity Distribution Company Ltd', 'status' => '0']);
        $int32 = Institutions::create(['entity' => $ent8->id, 'lineMinistry' => 'Ministry of Energy and Mineral Development (MEMD)', 'institution' => 'Uganda Electricity Generation Company Ltd', 'status' => '0']);
        $int33 = Institutions::create(['entity' => $ent8->id, 'lineMinistry' => 'Ministry of Energy and Mineral Development (MEMD)', 'institution' => 'Uganda Electricity Transmission Company', 'status' => '0']);
        $int34 = Institutions::create(['entity' => $ent9->id, 'lineMinistry' => 'Ministry of Information Technology and National Guidance (MoICT&NG)', 'institution' => "National Information Technology - Uganda (NITA-U)", 'status' => '0']);
        $int35 = Institutions::create(['entity' => $ent10->id, 'lineMinistry' => 'Ministry of Finance, Planning and Economic Development (MoFPED)', 'institution' => "Departed Asians' Property Custodian Board", 'status' => '0']);
        $int36 = Institutions::create(['entity' => $ent10->id, 'lineMinistry' => 'Ministry of Finance, Planning and Economic Development (MoFPED)', 'institution' => 'Metropolitan Physical Planning Authority (MPPA)', 'status' => '0']);
        $int37 = Institutions::create(['entity' => $ent10->id, 'lineMinistry' => 'Ministry of Finance, Planning and Economic Development (MoFPED)', 'institution' => 'National Physical Planning Board (NPPB)', 'status' => '0']);
        $int38 = Institutions::create(['entity' => $ent10->id, 'lineMinistry' => 'Ministry of Finance, Planning and Economic Development (MoFPED)', 'institution' => 'National Planning Authority', 'status' => '0']);
        $int39 = Institutions::create(['entity' => $ent10->id, 'lineMinistry' => 'Ministry of Finance, Planning and Economic Development (MoFPED)', 'institution' => 'National Population Council', 'status' => '0']);
        $int40 = Institutions::create(['entity' => $ent10->id, 'lineMinistry' => 'Ministry of Finance, Planning and Economic Development (MoFPED)', 'institution' => 'Non-Performing Assets Recovery Tribunal', 'status' => '0']);
        $int41 = Institutions::create(['entity' => $ent10->id, 'lineMinistry' => 'Ministry of Finance, Planning and Economic Development (MoFPED)', 'institution' => 'Non-Performing Assets Recovery Trust', 'status' => '0']);
        $int42 = Institutions::create(['entity' => $ent10->id, 'lineMinistry' => 'Ministry of Finance, Planning and Economic Development (MoFPED)', 'institution' => 'Privatization Unit', 'status' => '0']);
        $int43 = Institutions::create(['entity' => $ent10->id, 'lineMinistry' => 'Ministry of Finance, Planning and Economic Development (MoFPED)', 'institution' => 'Town and Country Planning Board', 'status' => '0']);
        $int44 = Institutions::create(['entity' => $ent10->id, 'lineMinistry' => 'Ministry of Finance, Planning and Economic Development (MoFPED)', 'institution' => 'Uganda Micro - Finance Regulatory Authority', 'status' => '0']);
        $int45 = Institutions::create(['entity' => $ent11->id, 'lineMinistry' => 'Ministry of Justice and Constitutional Affairs (MoJCA)', 'institution' => 'Centre for Alternative Dispute Resolution,', 'status' => '0']);
        $int46 = Institutions::create(['entity' => $ent11->id, 'lineMinistry' => 'Ministry of Justice and Constitutional Affairs (MoJCA)', 'institution' => 'Electricity Dispute Tribunal', 'status' => '0']);
        $int47 = Institutions::create(['entity' => $ent11->id, 'lineMinistry' => 'Ministry of Justice and Constitutional Affairs (MoJCA)', 'institution' => 'Equal Opportunities Commission', 'status' => '0']);
        $int48 = Institutions::create(['entity' => $ent11->id, 'lineMinistry' => 'Ministry of Justice and Constitutional Affairs (MoJCA)', 'institution' => 'Tax Tribunal', 'status' => '0']);
        $int49 = Institutions::create(['entity' => $ent11->id, 'lineMinistry' => 'Ministry of Justice and Constitutional Affairs (MoJCA)', 'institution' => 'Uganda Human Rights Commission', 'status' => '0']);
        $int50 = Institutions::create(['entity' => $ent11->id, 'lineMinistry' => 'Ministry of Justice and Constitutional Affairs (MoJCA)', 'institution' => 'Uganda Law Reform Commission (ULRC) And', 'status' => '0']);
        $int51 = Institutions::create(['entity' => $ent12->id, 'lineMinistry' => 'Ministry of Water and Environment (MoWE)', 'institution' => 'National Forestry Authority', 'status' => '0']);
        $int52 = Institutions::create(['entity' => $ent12->id, 'lineMinistry' => 'Ministry of Water and Environment (MoWE)', 'institution' => 'Uganda National Meteorological Authority', 'status' => '0']);
        $int53 = Institutions::create(['entity' => $ent13->id, 'lineMinistry' => 'Ministry of Agriculture, Animal Industry and Fisheries (MAAIF)', 'institution' => 'Agricultural Chemicals Board', 'status' => '0']);
        $int54 = Institutions::create(['entity' => $ent13->id, 'lineMinistry' => 'Ministry of Agriculture, Animal Industry and Fisheries (MAAIF)', 'institution' => 'Diary Development Authority', 'status' => '0']);
        $int55 = Institutions::create(['entity' => $ent13->id, 'lineMinistry' => 'Ministry of Agriculture, Animal Industry and Fisheries (MAAIF)', 'institution' => 'National Agricultural Advisory Services (NAADS)', 'status' => '0']);
        $int56 = Institutions::create(['entity' => $ent13->id, 'lineMinistry' => 'Ministry of Agriculture, Animal Industry and Fisheries (MAAIF)', 'institution' => 'Uganda Coffee Development Authority (UCDA)', 'status' => '0']);
        $int57 = Institutions::create(['entity' => $ent13->id, 'lineMinistry' => 'Ministry of Agriculture, Animal Industry and Fisheries (MAAIF)', 'institution' => 'Uganda Cotton Authority (UCO)', 'status' => '0']);
        $int58 = Institutions::create(['entity' => $ent13->id, 'lineMinistry' => 'Ministry of Agriculture, Animal Industry and Fisheries (MAAIF)', 'institution' => 'Uganda Trypanasomiasis Control Council (UTCC)', 'status' => '0']);
        $int59 = Institutions::create(['entity' => $ent14->id, 'lineMinistry' => 'Office of the Prime Minister', 'institution' => 'Karamoja Development Agency (KDA)', 'status' => '0']);

        $carder1  = CardMinistries::create(['carderName' => 'Office of the President ']);
        $carder2  = CardMinistries::create(['carderName' => 'Office of the Prime Minister']);
        $carder3  = CardMinistries::create(['carderName' => 'Ministry of Defence & Veteran Affairs']);
        $carder4  = CardMinistries::create(['carderName' => 'Ministry of Public Service']);
        $carder5  = CardMinistries::create(['carderName' => 'Ministry of Foreign Affairs']);
        $carder6  = CardMinistries::create(['carderName' => 'Ministry of Finance, Planning and Economic Development']);
        $carder7  = CardMinistries::create(['carderName' => 'Ministry of Internal Affairs']);
        $carder8  = CardMinistries::create(['carderName' => 'Ministry of Agriculture, Animal Industry and Fisheries ']);
        $carder9  = CardMinistries::create(['carderName' => 'Ministry of Local Government']);
        $carder10 = CardMinistries::create(['carderName' => ' Ministry of Education and Sports ']);
        $carder11 = CardMinistries::create(['carderName' => 'Ministry of Health']);
        $carder12 = CardMinistries::create(['carderName' => 'Ministry of Trade, Industry and cooperatives']);
        $carder13 = CardMinistries::create(['carderName' => 'Ministry of Works and Transport']);
        $carder14 = CardMinistries::create(['carderName' => 'Ministry of Gender, Labour and Social Development']);
        $carder15 = CardMinistries::create(['carderName' => 'Ministry of Water and Environment']);
        $carder16 = CardMinistries::create(['carderName' => 'Ministry of Information Communications Technology and National Guidance']);
        $carder17 = CardMinistries::create(['carderName' => 'Ministry of Lands, Housing and Urban Development']);
        $carder18 = CardMinistries::create(['carderName' => 'Ministry of East African Community Affairs']);
        $carder19 = CardMinistries::create(['carderName' => 'Ministry of Energy and Mineral Development']);
        $carder20 = CardMinistries::create(['carderName' => 'Ministry of Science Technology and Innovation']);
        $carder21 = CardMinistries::create(['carderName' => 'Ministry of Tourism wildlife and antiquities']);
        $carder22 = CardMinistries::create(['carderName' => 'Judiciary']);
        $carder23 = CardMinistries::create(['carderName' => 'Ministry of Justice and Constitutional Affairs']);
        $carder24 = CardMinistries::create(['carderName' => ' Directorate of Public Prosecutions (DPP)']);

        $carderMin1   = Carders::create(['ministry' => 1, 'cardname' => ' Policy Analysts']);
        $carderMin2   = Carders::create(['ministry' => 1, 'cardname' => ' Presidential Advisors']);
        $carderMin3   = Carders::create(['ministry' => 1, 'cardname' => ' Presidential Assistants']);
        $carderMin4   = Carders::create(['ministry' => 1, 'cardname' => ' Presidential Envoys ']);
        $carderMin5   = Carders::create(['ministry' => 1, 'cardname' => ' Resident District Commissioners']);
        $carderMin6   = Carders::create(['ministry' => 1, 'cardname' => ' Administrative officers at the Centre']);
        $carderMin7   = Carders::create(['ministry' => 1, 'cardname' => ' Security Officers (ISO & ESO)']);
        $carderMin8   = Carders::create(['ministry' => 2, 'cardname' => ' Economists (Monitoring and evaluation) ']);
        $carderMin9   = Carders::create(['ministry' => 2, 'cardname' => ' Economists(strategic coordination)']);
        $carderMin10  = Carders::create(['ministry' => 2, 'cardname' => ' Policy Analysts(strategic coordination)']);
        $carderMin11  = Carders::create(['ministry' => 2, 'cardname' => ' Settlement Officers']);
        $carderMin12  = Carders::create(['ministry' => 2, 'cardname' => ' Disaster Management Officers']);
        $carderMin13  = Carders::create(['ministry' => 2, 'cardname' => ' Disaster preparedness officers']);
        $carderMin14  = Carders::create(['ministry' => 3, 'cardname' => ' Uganda Peoples Defence Forces (UPDF)']);
        $carderMin15  = Carders::create(['ministry' => 3, 'cardname' => ' Officers']);
        $carderMin16  = Carders::create(['ministry' => 3, 'cardname' => ' Rehabilitation officers']);
        $carderMin17  = Carders::create(['ministry' => 3, 'cardname' => ' Resettlement officers']);
        $carderMin18  = Carders::create(['ministry' => 4, 'cardname' => ' Human Resource officers']);
        $carderMin19  = Carders::create(['ministry' => 4, 'cardname' => ' Management analysts']);
        $carderMin20  = Carders::create(['ministry' => 4, 'cardname' => ' Records officers']);
        $carderMin21  = Carders::create(['ministry' => 4, 'cardname' => ' Archivists']);
        $carderMin22  = Carders::create(['ministry' => 4, 'cardname' => ' Office supervisors']);
        $carderMin23  = Carders::create(['ministry' => 4, 'cardname' => ' Secretarial ']);
        $carderMin24  = Carders::create(['ministry' => 4, 'cardname' => ' Telephone operators']);
        $carderMin25  = Carders::create(['ministry' => '5', 'cardname' => ' Foreign Service officers']);
        $carderMin26  = Carders::create(['ministry' => '6', 'cardname' => ' Economists']);
        $carderMin27  = Carders::create(['ministry' => '6', 'cardname' => ' Planners ']);
        $carderMin28  = Carders::create(['ministry' => '6', 'cardname' => ' Statistician']);
        $carderMin29  = Carders::create(['ministry' => '6', 'cardname' => ' Procurement Officers']);
        $carderMin30  = Carders::create(['ministry' => '6', 'cardname' => ' Internal Auditors']);
        $carderMin31  = Carders::create(['ministry' => '6', 'cardname' => ' Inventory Management Officers']);
        $carderMin32  = Carders::create(['ministry' => '6', 'cardname' => ' Accountants']);
        $carderMin33  = Carders::create(['ministry' => '6', 'cardname' => ' Finance officers']);
        $carderMin34  = Carders::create(['ministry' => '7', 'cardname' => ' Immigration officers']);
        $carderMin35  = Carders::create(['ministry' => '7', 'cardname' => ' Government Analysts']);
        $carderMin36  = Carders::create(['ministry' => '7', 'cardname' => ' Laboratory technicians']);
        $carderMin37  = Carders::create(['ministry' => '7', 'cardname' => ' Uganda Police Force (UPF) Officers']);
        $carderMin38  = Carders::create(['ministry' => '7', 'cardname' => ' Uganda Prisons Service (UPS) Officers']);
        $carderMin39  = Carders::create(['ministry' => '8', 'cardname' => ' Agricultural Officers']);
        $carderMin40  = Carders::create(['ministry' => '8', 'cardname' => ' Veterinary officers']);
        $carderMin41  = Carders::create(['ministry' => '8', 'cardname' => ' Veterinary Inspector']);
        $carderMin42  = Carders::create(['ministry' => '8', 'cardname' => ' Fisheries officers']);
        $carderMin43  = Carders::create(['ministry' => '8', 'cardname' => ' Fisheries Inspector']);
        $carderMin44  = Carders::create(['ministry' => '8', 'cardname' => ' Entomologists']);
        $carderMin45  = Carders::create(['ministry' => '8', 'cardname' => ' Animal Husbandry officers']);
        $carderMin46  = Carders::create(['ministry' => '8', 'cardname' => ' Animal Nutritionist']);
        $carderMin47  = Carders::create(['ministry' => '8', 'cardname' => ' Agronomists']);
        $carderMin48  = Carders::create(['ministry' => '8', 'cardname' => ' Ecologists']);
        $carderMin49  = Carders::create(['ministry' => '8', 'cardname' => 'Agricultural Engineer']);
        $carderMin50  = Carders::create(['ministry' => '8', 'cardname' => 'Agribusiness Officers']);
        $carderMin51  = Carders::create(['ministry' => '8', 'cardname' => 'Enterprise Development Officer']);
        $carderMin52  = Carders::create(['ministry' => '8', 'cardname' => 'Agriculture extension skills management officer']);
        $carderMin53  = Carders::create(['ministry' => '8', 'cardname' => ' Agricultural inspector']);
        $carderMin54  = Carders::create(['ministry' => '8', 'cardname' => ' Agricultural Assistant']);
        $carderMin55  = Carders::create(['ministry' => '8', 'cardname' => ' Agricultural Mechanic']);
        $carderMin56  = Carders::create(['ministry' => '8', 'cardname' => ' Assistant Agricultural Mechanic']);
        $carderMin57  = Carders::create(['ministry' => '8', 'cardname' => ' Assistant Animal Husbandry Officer']);
        $carderMin58  = Carders::create(['ministry' => '8', 'cardname' => ' Artificial insemination Technician']);
        $carderMin59  = Carders::create(['ministry' => '8', 'cardname' => 'Herds Men']);
        $carderMin60  = Carders::create(['ministry' => '8', 'cardname' => 'Dairy Men']);
        $carderMin61  = Carders::create(['ministry' => '8', 'cardname' => 'Nursery Attendants ']);
        $carderMin62  = Carders::create(['ministry' => '8', 'cardname' => 'Poultry Attendants ']);
        $carderMin63  = Carders::create(['ministry' => '9', 'cardname' => ' District Administrators']);
        $carderMin64  = Carders::create(['ministry' => '9', 'cardname' => ' Urban Administrators']);
        $carderMin65  = Carders::create(['ministry' => '9', 'cardname' => ' Inspectors']);
        $carderMin66  = Carders::create(['ministry' => '9', 'cardname' => ' Compliance officers']);
        $carderMin67  = Carders::create(['ministry' => '9', 'cardname' => ' Urban Officers']);
        $carderMin68  = Carders::create(['ministry' => '9', 'cardname' => ' Law enforcement officers']);
        $carderMin69  = Carders::create(['ministry' => '10', 'cardname' => ' Education Officers']);
        $carderMin70  = Carders::create(['ministry' => '10', 'cardname' => ' Teachers']);
        $carderMin71  = Carders::create(['ministry' => '10', 'cardname' => ' Inspector of schools ']);
        $carderMin72  = Carders::create(['ministry' => '10', 'cardname' => ' Sports Officers']);
        $carderMin73  = Carders::create(['ministry' => '10', 'cardname' => ' Tutors']);
        $carderMin74  = Carders::create(['ministry' => '10', 'cardname' => ' Lectures']);
        $carderMin75  = Carders::create(['ministry' => '10', 'cardname' => ' Instructors']);
        $carderMin76  = Carders::create(['ministry' => '10', 'cardname' => ' Assistant instructor']);
        $carderMin77  = Carders::create(['ministry' => '10', 'cardname' => ' Bursars']);
        $carderMin78  = Carders::create(['ministry' => '10', 'cardname' => ' Matron']);
        $carderMin79  = Carders::create(['ministry' => '11', 'cardname' => ' Director General']);
        $carderMin80  = Carders::create(['ministry' => '11', 'cardname' => ' Directors Health']);
        $carderMin81  = Carders::create(['ministry' => '11', 'cardname' => ' Senior Consultants']);
        $carderMin82  = Carders::create(['ministry' => '11', 'cardname' => ' Consultants']);
        $carderMin83  = Carders::create(['ministry' => '11', 'cardname' => ' Medical officer']);
        $carderMin84  = Carders::create(['ministry' => '11', 'cardname' => ' Nutritionist']);
        $carderMin85  = Carders::create(['ministry' => '11', 'cardname' => ' Epidemiologists’']);
        $carderMin86  = Carders::create(['ministry' => '11', 'cardname' => ' Sanitary engineer']);
        $carderMin87  = Carders::create(['ministry' => '11', 'cardname' => ' Biomedical engineer']);
        $carderMin88  = Carders::create(['ministry' => '11', 'cardname' => ' Health Training Officer']);
        $carderMin89  = Carders::create(['ministry' => '11', 'cardname' => 'Physiotherapists']);
        $carderMin90  = Carders::create(['ministry' => '11', 'cardname' => 'Occupational therapists']);
        $carderMin91  = Carders::create(['ministry' => '11', 'cardname' => 'Biomedical Technician']);
        $carderMin92  = Carders::create(['ministry' => '11', 'cardname' => 'Occupational health officers']);
        $carderMin93  = Carders::create(['ministry' => '11', 'cardname' => ' Occupational therapists']);
        $carderMin94  = Carders::create(['ministry' => '11', 'cardname' => ' Medical Entomologists']);
        $carderMin95  = Carders::create(['ministry' => '11', 'cardname' => ' Parasitologists']);
        $carderMin96  = Carders::create(['ministry' => '11', 'cardname' => ' Environmental health officers']);
        $carderMin97  = Carders::create(['ministry' => '11', 'cardname' => ' Nurses']);
        $carderMin98  = Carders::create(['ministry' => '11', 'cardname' => ' Cold chain Technicians']);
        $carderMin99  = Carders::create(['ministry' => '11', 'cardname' => 'Laboratory Technologists']);
        $carderMin100 = Carders::create(['ministry' => '11', 'cardname' => 'Laboratory Assistants']);
        $carderMin101 = Carders::create(['ministry' => '11', 'cardname' => 'Pathologists']);
        $carderMin102 = Carders::create(['ministry' => '11', 'cardname' => 'Microbiologists']);
        $carderMin103 = Carders::create(['ministry' => '11', 'cardname' => ' Cytologists']);
        $carderMin104 = Carders::create(['ministry' => '11', 'cardname' => ' Midwives']);
        $carderMin105 = Carders::create(['ministry' => '11', 'cardname' => ' Clinical officers']);
        $carderMin106 = Carders::create(['ministry' => '11', 'cardname' => ' Dental surgeons']);
        $carderMin107 = Carders::create(['ministry' => '11', 'cardname' => ' Pharmacists']);
        $carderMin108 = Carders::create(['ministry' => '11', 'cardname' => ' Laboratory Technicians (Medical)']);
        $carderMin109 = Carders::create(['ministry' => '11', 'cardname' => 'Anesthetic Assistants']);
        $carderMin110 = Carders::create(['ministry' => '11', 'cardname' => 'Anesthetic attendants']);
        $carderMin111 = Carders::create(['ministry' => '11', 'cardname' => 'Anesthetic Officers']);
        $carderMin112 = Carders::create(['ministry' => '11', 'cardname' => 'Hospital Administrators in Hospitals']);
        $carderMin113 = Carders::create(['ministry' => '12', 'cardname' => ' Commercial officers']);
        $carderMin114 = Carders::create(['ministry' => '12', 'cardname' => ' Assistant commercial officer']);
        $carderMin115 = Carders::create(['ministry' => '12', 'cardname' => ' Cooperative officers']);
        $carderMin116 = Carders::create(['ministry' => '12', 'cardname' => ' Trade development officers']);
        $carderMin117 = Carders::create(['ministry' => '12', 'cardname' => ' Industrial officers']);
        $carderMin118 = Carders::create(['ministry' => '13', 'cardname' => ' Road engineers']);
        $carderMin119 = Carders::create(['ministry' => '13', 'cardname' => ' Building engineers']);
        $carderMin120 = Carders::create(['ministry' => '13', 'cardname' => ' Transport officers']);
        $carderMin121 = Carders::create(['ministry' => '13', 'cardname' => ' Plant operators']);
        $carderMin122 = Carders::create(['ministry' => '13', 'cardname' => ' Safety officer']);
        $carderMin123 = Carders::create(['ministry' => '13', 'cardname' => ' Vehicle Inspectors']);
        $carderMin124 = Carders::create(['ministry' => '13', 'cardname' => ' Road safety officers']);
        $carderMin125 = Carders::create(['ministry' => '13', 'cardname' => ' Air craft engineer']);
        $carderMin126 = Carders::create(['ministry' => '13', 'cardname' => ' Air transport officer']);
        $carderMin127 = Carders::create(['ministry' => '13', 'cardname' => ' Air traffic control assistant']);
        $carderMin128 = Carders::create(['ministry' => '13', 'cardname' => 'Air craft cleaner']);
        $carderMin129 = Carders::create(['ministry' => '13', 'cardname' => 'air craft radio engineer']);
        $carderMin130 = Carders::create(['ministry' => '13', 'cardname' => 'Airport commandant']);
        $carderMin131 = Carders::create(['ministry' => '13', 'cardname' => 'Drivers']);
        $carderMin132 = Carders::create(['ministry' => '13', 'cardname' => ' Mechanical engineers']);
        $carderMin133 = Carders::create(['ministry' => '13', 'cardname' => ' Licensing officers']);
        $carderMin134 = Carders::create(['ministry' => '13', 'cardname' => ' Maritime officers']);
        $carderMin135 = Carders::create(['ministry' => '13', 'cardname' => ' Coxswain']);
        $carderMin136 = Carders::create(['ministry' => '13', 'cardname' => ' Ferry Operators']);
        $carderMin137 = Carders::create(['ministry' => '13', 'cardname' => ' Draughts men']);
        $carderMin138 = Carders::create(['ministry' => '13', 'cardname' => ' Deckhand']);
        $carderMin139 = Carders::create(['ministry' => '13', 'cardname' => 'Road inspectors']);
        $carderMin140 = Carders::create(['ministry' => '13', 'cardname' => 'Road over seers']);
        $carderMin141 = Carders::create(['ministry' => '13', 'cardname' => 'Mechanic artisans ']);
        $carderMin142 = Carders::create(['ministry' => '13', 'cardname' => ' Machine/rig operators']);
        $carderMin143 = Carders::create(['ministry' => '13', 'cardname' => ' Bintu men attendants']);
        $carderMin144 = Carders::create(['ministry' => '13', 'cardname' => ' Workshop attendant']);
        $carderMin145 = Carders::create(['ministry' => '14', 'cardname' => ' Youth officers']);
        $carderMin146 = Carders::create(['ministry' => '14', 'cardname' => ' Gender officers']);
        $carderMin147 = Carders::create(['ministry' => '14', 'cardname' => ' Culture officers']);
        $carderMin148 = Carders::create(['ministry' => '14', 'cardname' => ' Literacy officers']);
        $carderMin149 = Carders::create(['ministry' => '14', 'cardname' => ' Labour officers']);
        $carderMin150 = Carders::create(['ministry' => '14', 'cardname' => ' Labour inspectors']);
        $carderMin151 = Carders::create(['ministry' => '14', 'cardname' => ' Probation and welfare officers']);
        $carderMin152 = Carders::create(['ministry' => '14', 'cardname' => ' Community Development Officers']);
        $carderMin153 = Carders::create(['ministry' => '14', 'cardname' => ' Women in Development Officer']);
        $carderMin154 = Carders::create(['ministry' => '14', 'cardname' => ' Social Development Officer']);
        $carderMin155 = Carders::create(['ministry' => '14', 'cardname' => 'Rehabilitation Officer']);
        $carderMin156 = Carders::create(['ministry' => '14', 'cardname' => 'Gerontologists']);
        $carderMin157 = Carders::create(['ministry' => '14', 'cardname' => 'General safety inspectors']);
        $carderMin158 = Carders::create(['ministry' => '14', 'cardname' => 'Specific safety inspectors']);
        $carderMin159 = Carders::create(['ministry' => '14', 'cardname' => ' Occupational Hygienist']);
        $carderMin160 = Carders::create(['ministry' => '14', 'cardname' => ' Occupational physician']);
        $carderMin161 = Carders::create(['ministry' => '14', 'cardname' => ' Librarians']);
        $carderMin162 = Carders::create(['ministry' => '15', 'cardname' => ' Water Engineers']);
        $carderMin163 = Carders::create(['ministry' => '15', 'cardname' => ' Water officers']);
        $carderMin164 = Carders::create(['ministry' => '15', 'cardname' => ' Water quality officers']);
        $carderMin165 = Carders::create(['ministry' => '15', 'cardname' => ' Hydrologists']);
        $carderMin166 = Carders::create(['ministry' => '15', 'cardname' => ' Hydro-geologist']);
        $carderMin167 = Carders::create(['ministry' => '15', 'cardname' => ' Environment officers']);
        $carderMin168 = Carders::create(['ministry' => '15', 'cardname' => ' Wetland officers']);
        $carderMin169 = Carders::create(['ministry' => '15', 'cardname' => ' Climate change officers']);
        $carderMin170 = Carders::create(['ministry' => '15', 'cardname' => ' Forest officers']);
        $carderMin171 = Carders::create(['ministry' => '15', 'cardname' => ' Meteorologists']);
        $carderMin172 = Carders::create(['ministry' => '16', 'cardname' => ' I.T Officers']);
        $carderMin173 = Carders::create(['ministry' => '16', 'cardname' => ' Information Scientists']);
        $carderMin174 = Carders::create(['ministry' => '16', 'cardname' => ' Telecommunications Engineer']);
        $carderMin175 = Carders::create(['ministry' => '16', 'cardname' => ' Information Technology Engineer']);
        $carderMin176 = Carders::create(['ministry' => '16', 'cardname' => ' Software engineer']);
        $carderMin177 = Carders::create(['ministry' => '16', 'cardname' => ' Communication officers']);
        $carderMin178 = Carders::create(['ministry' => '16', 'cardname' => ' Management Information officers']);
        $carderMin179 = Carders::create(['ministry' => '16', 'cardname' => ' Systems Analyst']);
        $carderMin180 = Carders::create(['ministry' => '16', 'cardname' => ' National guidance officers']);
        $carderMin181 = Carders::create(['ministry' => '17', 'cardname' => ' Architects']);
        $carderMin182 = Carders::create(['ministry' => '17', 'cardname' => ' Architectural Assistant']);
        $carderMin183 = Carders::create(['ministry' => '17', 'cardname' => ' Land surveyors']);
        $carderMin184 = Carders::create(['ministry' => '17', 'cardname' => ' Physical planners']);
        $carderMin185 = Carders::create(['ministry' => '17', 'cardname' => ' Quantity surveyors']);
        $carderMin186 = Carders::create(['ministry' => '17', 'cardname' => ' Land valuers']);
        $carderMin187 = Carders::create(['ministry' => '17', 'cardname' => ' Land officers']);
        $carderMin188 = Carders::create(['ministry' => '17', 'cardname' => ' Cartographers /Photogrammetrists']);
        $carderMin189 = Carders::create(['ministry' => '17', 'cardname' => ' Lithographer']);
        $carderMin190 = Carders::create(['ministry' => '17', 'cardname' => ' Geodesists']);
        $carderMin191 = Carders::create(['ministry' => '17', 'cardname' => 'Photogrammetrists']);
        $carderMin192 = Carders::create(['ministry' => '17', 'cardname' => 'Geographer']);
        $carderMin193 = Carders::create(['ministry' => '17', 'cardname' => 'Housing officers']);
        $carderMin194 = Carders::create(['ministry' => '17', 'cardname' => 'Urban Development Officers']);
        $carderMin195 = Carders::create(['ministry' => '18', 'cardname' => ' Regional Integration Officers']);
        $carderMin196 = Carders::create(['ministry' => '19', 'cardname' => ' Petroleum officers']);
        $carderMin197 = Carders::create(['ministry' => '19', 'cardname' => ' Petroleum Engineers']);
        $carderMin198 = Carders::create(['ministry' => '19', 'cardname' => ' Energy officers']);
        $carderMin199 = Carders::create(['ministry' => '19', 'cardname' => ' Geologists']);
        $carderMin200 = Carders::create(['ministry' => '19', 'cardname' => ' Geophysicist']);
        $carderMin201 = Carders::create(['ministry' => '19', 'cardname' => ' Geochemist']);
        $carderMin202 = Carders::create(['ministry' => '19', 'cardname' => ' Seismologist']);
        $carderMin203 = Carders::create(['ministry' => '19', 'cardname' => ' Geoscientist']);
        $carderMin204 = Carders::create(['ministry' => '19', 'cardname' => ' Laboratory Technicians (physical )']);
        $carderMin205 = Carders::create(['ministry' => '19', 'cardname' => ' Mining engineer']);
        $carderMin206 = Carders::create(['ministry' => '20', 'cardname' => ' Science officers']);
        $carderMin207 = Carders::create(['ministry' => '20', 'cardname' => ' Technology Officers ']);
        $carderMin208 = Carders::create(['ministry' => '21', 'cardname' => ' Tourism officers ']);
        $carderMin209 = Carders::create(['ministry' => '21', 'cardname' => ' Wildlife Officer']);
        $carderMin210 = Carders::create(['ministry' => '21', 'cardname' => ' Conservators']);
        $carderMin211 = Carders::create(['ministry' => '22', 'cardname' => ' Justices(specified)']);
        $carderMin212 = Carders::create(['ministry' => '22', 'cardname' => ' Judges( specified)']);
        $carderMin213 = Carders::create(['ministry' => '22', 'cardname' => ' Registrars']);
        $carderMin214 = Carders::create(['ministry' => '22', 'cardname' => ' Magistrates']);
        $carderMin215 = Carders::create(['ministry' => '22', 'cardname' => ' Court clerks/interpreters']);
        $carderMin216 = Carders::create(['ministry' => '22', 'cardname' => ' Process servers']);
        $carderMin217 = Carders::create(['ministry' => '23', 'cardname' => ' State Attorneys']);
        $carderMin218 = Carders::create(['ministry' => '24', 'cardname' => ' State prosecutors']);
        $carderMin219 = Carders::create(['ministry' => '24', 'cardname' => ' State Attorneys']);

$sc1=ServiceCenter::create(['centerName' => 'Kampala', 'status' => true]);
$sc2=ServiceCenter::create(['centerName' => 'Kamwenge', 'status' => true]);
$sc3=ServiceCenter::create(['centerName' => 'Kotido', 'status' => true]);
$sc4=ServiceCenter::create(['centerName' => 'Rukungiri', 'status' => true]);
$sc5=ServiceCenter::create(['centerName' => 'Masaka', 'status' => true]);
$sc6=ServiceCenter::create(['centerName' => 'Hoima', 'status' => true]);
$sc7=ServiceCenter::create(['centerName' => 'Arua', 'status' => true]);
$sc8=ServiceCenter::create(['centerName' => 'Lira', 'status' => true]);
$sc9=ServiceCenter::create(['centerName' => 'Moroto', 'status' => true]);
$sc10=ServiceCenter::create(['centerName' => 'Adjumani', 'status' => true]);
$sc11=ServiceCenter::create(['centerName' => 'Kabale', 'status' => true]);
$sc12=ServiceCenter::create(['centerName' => 'Tororo', 'status' => true]);
$sc13=ServiceCenter::create(['centerName' => 'Iganga', 'status' => true]);
$sc14=ServiceCenter::create(['centerName' => 'Mbale', 'status' => true]);
$sc15=ServiceCenter::create(['centerName' => 'FortPortal', 'status' => true]);
$sc16=ServiceCenter::create(['centerName' => 'Jinja', 'status' => true]);
$sc17=ServiceCenter::create(['centerName' => 'Gulu', 'status' => true]);
$sc18=ServiceCenter::create(['centerName' => 'Mbarara', 'status' => true]);
$sc19=ServiceCenter::create(['centerName' => 'Soroti', 'status' => true]);

 $country1=CountryCodes::create(['CodeName'=>'AD', 'dialingCode'=>'376']);
$country2=CountryCodes::create(['CodeName'=>'AE', 'dialingCode'=>'971']);
$country3=CountryCodes::create(['CodeName'=>'AF', 'dialingCode'=>'93']);
$country4=CountryCodes::create(['CodeName'=>'AG', 'dialingCode'=>'1268']);
$country5=CountryCodes::create(['CodeName'=>'AI', 'dialingCode'=>'1264']);
$country6=CountryCodes::create(['CodeName'=>'AL', 'dialingCode'=>'355']);
$country7=CountryCodes::create(['CodeName'=>'AM', 'dialingCode'=>'374']);
$country8=CountryCodes::create(['CodeName'=>'AN', 'dialingCode'=>'599']);
$country9=CountryCodes::create(['CodeName'=>'AO', 'dialingCode'=>'244']);
$country10=CountryCodes::create(['CodeName'=>'AQ', 'dialingCode'=>'672']);
$country11=CountryCodes::create(['CodeName'=>'AR', 'dialingCode'=>'54']);
$country12=CountryCodes::create(['CodeName'=>'AS', 'dialingCode'=>'1684']);
$country13=CountryCodes::create(['CodeName'=>'AT', 'dialingCode'=>'43']);
$country14=CountryCodes::create(['CodeName'=>'AU', 'dialingCode'=>'61']);
$country15=CountryCodes::create(['CodeName'=>'AW', 'dialingCode'=>'297']);
$country16=CountryCodes::create(['CodeName'=>'AZ', 'dialingCode'=>'994']);
$country17=CountryCodes::create(['CodeName'=>'BA', 'dialingCode'=>'387']);
$country18=CountryCodes::create(['CodeName'=>'BB', 'dialingCode'=>'1246']);
$country19=CountryCodes::create(['CodeName'=>'BD', 'dialingCode'=>'880']);
$country20=CountryCodes::create(['CodeName'=>'BE', 'dialingCode'=>'32']);
$country21=CountryCodes::create(['CodeName'=>'BF', 'dialingCode'=>'226']);
$country22=CountryCodes::create(['CodeName'=>'BG', 'dialingCode'=>'359']);
$country23=CountryCodes::create(['CodeName'=>'BH', 'dialingCode'=>'973']);
$country24=CountryCodes::create(['CodeName'=>'BI', 'dialingCode'=>'257']);
$country25=CountryCodes::create(['CodeName'=>'BJ', 'dialingCode'=>'229']);
$country26=CountryCodes::create(['CodeName'=>'BM', 'dialingCode'=>'1441']);
$country27=CountryCodes::create(['CodeName'=>'BN', 'dialingCode'=>'673']);
$country28=CountryCodes::create(['CodeName'=>'BO', 'dialingCode'=>'591']);
$country29=CountryCodes::create(['CodeName'=>'BR', 'dialingCode'=>'55']);
$country30=CountryCodes::create(['CodeName'=>'BS', 'dialingCode'=>'1242']);
$country31=CountryCodes::create(['CodeName'=>'BT', 'dialingCode'=>'975']);
$country32=CountryCodes::create(['CodeName'=>'BV', 'dialingCode'=>'']);
$country33=CountryCodes::create(['CodeName'=>'BW', 'dialingCode'=>'267']);
$country34=CountryCodes::create(['CodeName'=>'BY', 'dialingCode'=>'375']);
$country35=CountryCodes::create(['CodeName'=>'BZ', 'dialingCode'=>'501']);
$country36=CountryCodes::create(['CodeName'=>'CA', 'dialingCode'=>'1']);
$country37=CountryCodes::create(['CodeName'=>'CC', 'dialingCode'=>'61']);
$country38=CountryCodes::create(['CodeName'=>'CD', 'dialingCode'=>'243']);
$country39=CountryCodes::create(['CodeName'=>'CF', 'dialingCode'=>'236']);
$country40=CountryCodes::create(['CodeName'=>'CG', 'dialingCode'=>'242']);
$country41=CountryCodes::create(['CodeName'=>'CH', 'dialingCode'=>'41']);
$country42=CountryCodes::create(['CodeName'=>'CI', 'dialingCode'=>'225']);
$country43=CountryCodes::create(['CodeName'=>'CK', 'dialingCode'=>'682']);
$country44=CountryCodes::create(['CodeName'=>'CL', 'dialingCode'=>'56']);
$country45=CountryCodes::create(['CodeName'=>'CM', 'dialingCode'=>'237']);
$country46=CountryCodes::create(['CodeName'=>'CN', 'dialingCode'=>'86']);
$country47=CountryCodes::create(['CodeName'=>'CO', 'dialingCode'=>'57']);
$country48=CountryCodes::create(['CodeName'=>'CR', 'dialingCode'=>'506']);
$country49=CountryCodes::create(['CodeName'=>'CS', 'dialingCode'=>'']);
$country50=CountryCodes::create(['CodeName'=>'CU', 'dialingCode'=>'53']);
$country51=CountryCodes::create(['CodeName'=>'CV', 'dialingCode'=>'238']);
$country52=CountryCodes::create(['CodeName'=>'CX', 'dialingCode'=>'53']);
$country53=CountryCodes::create(['CodeName'=>'CY', 'dialingCode'=>'357']);
$country54=CountryCodes::create(['CodeName'=>'CZ', 'dialingCode'=>'420']);
$country55=CountryCodes::create(['CodeName'=>'DE', 'dialingCode'=>'49']);
$country56=CountryCodes::create(['CodeName'=>'DJ', 'dialingCode'=>'253']);
$country57=CountryCodes::create(['CodeName'=>'DK', 'dialingCode'=>'45']);
$country58=CountryCodes::create(['CodeName'=>'DM', 'dialingCode'=>'1767']);
$country59=CountryCodes::create(['CodeName'=>'DO', 'dialingCode'=>'1809']);
$country60=CountryCodes::create(['CodeName'=>'DO', 'dialingCode'=>'1829']);
$country61=CountryCodes::create(['CodeName'=>'DZ', 'dialingCode'=>'213']);
$country62=CountryCodes::create(['CodeName'=>'EC', 'dialingCode'=>'593']);
$country63=CountryCodes::create(['CodeName'=>'EE', 'dialingCode'=>'372']);
$country64=CountryCodes::create(['CodeName'=>'EG', 'dialingCode'=>'20']);
$country65=CountryCodes::create(['CodeName'=>'EH', 'dialingCode'=>'212']);
$country66=CountryCodes::create(['CodeName'=>'ER', 'dialingCode'=>'291']);
$country67=CountryCodes::create(['CodeName'=>'ES', 'dialingCode'=>'34']);
$country68=CountryCodes::create(['CodeName'=>'ET', 'dialingCode'=>'251']);
$country69=CountryCodes::create(['CodeName'=>'FI', 'dialingCode'=>'358']);
$country70=CountryCodes::create(['CodeName'=>'FJ', 'dialingCode'=>'679']);
$country71=CountryCodes::create(['CodeName'=>'FK', 'dialingCode'=>'500']);
$country72=CountryCodes::create(['CodeName'=>'FM', 'dialingCode'=>'691']);
$country73=CountryCodes::create(['CodeName'=>'FO', 'dialingCode'=>'298']);
$country74=CountryCodes::create(['CodeName'=>'FR', 'dialingCode'=>'33']);
$country75=CountryCodes::create(['CodeName'=>'GA', 'dialingCode'=>'241']);
$country76=CountryCodes::create(['CodeName'=>'GB', 'dialingCode'=>'44']);
$country77=CountryCodes::create(['CodeName'=>'GD', 'dialingCode'=>'1473']);
$country78=CountryCodes::create(['CodeName'=>'GE', 'dialingCode'=>'995']);
$country79=CountryCodes::create(['CodeName'=>'GF', 'dialingCode'=>'594']);
$country80=CountryCodes::create(['CodeName'=>'GH', 'dialingCode'=>'233']);
$country81=CountryCodes::create(['CodeName'=>'GI', 'dialingCode'=>'350']);
$country82=CountryCodes::create(['CodeName'=>'GL', 'dialingCode'=>'299']);
$country83=CountryCodes::create(['CodeName'=>'GM', 'dialingCode'=>'220']);
$country84=CountryCodes::create(['CodeName'=>'GN', 'dialingCode'=>'224']);
$country85=CountryCodes::create(['CodeName'=>'GP', 'dialingCode'=>'590']);
$country86=CountryCodes::create(['CodeName'=>'GQ', 'dialingCode'=>'240']);
$country87=CountryCodes::create(['CodeName'=>'GR', 'dialingCode'=>'30']);
$country88=CountryCodes::create(['CodeName'=>'GS', 'dialingCode'=>'500']);
$country89=CountryCodes::create(['CodeName'=>'GT', 'dialingCode'=>'502']);
$country90=CountryCodes::create(['CodeName'=>'GU', 'dialingCode'=>'1671']);
$country91=CountryCodes::create(['CodeName'=>'GW', 'dialingCode'=>'245']);
$country92=CountryCodes::create(['CodeName'=>'GY', 'dialingCode'=>'592']);
$country93=CountryCodes::create(['CodeName'=>'HK', 'dialingCode'=>'852']);
$country94=CountryCodes::create(['CodeName'=>'HM', 'dialingCode'=>'672']);
$country95=CountryCodes::create(['CodeName'=>'HN', 'dialingCode'=>'504']);
$country96=CountryCodes::create(['CodeName'=>'HR', 'dialingCode'=>'385']);
$country97=CountryCodes::create(['CodeName'=>'HT', 'dialingCode'=>'509']);
$country98=CountryCodes::create(['CodeName'=>'HU', 'dialingCode'=>'36']);
$country99=CountryCodes::create(['CodeName'=>'ID', 'dialingCode'=>'62']);
$country100=CountryCodes::create(['CodeName'=>'IE', 'dialingCode'=>'353']);
$country101=CountryCodes::create(['CodeName'=>'IL', 'dialingCode'=>'972']);
$country102=CountryCodes::create(['CodeName'=>'IN', 'dialingCode'=>'91']);
$country103=CountryCodes::create(['CodeName'=>'IO', 'dialingCode'=>'246']);
$country104=CountryCodes::create(['CodeName'=>'IQ', 'dialingCode'=>'964']);
$country105=CountryCodes::create(['CodeName'=>'IR', 'dialingCode'=>'98']);
$country106=CountryCodes::create(['CodeName'=>'IS', 'dialingCode'=>'354']);
$country107=CountryCodes::create(['CodeName'=>'IT', 'dialingCode'=>'39']);
$country108=CountryCodes::create(['CodeName'=>'JM', 'dialingCode'=>'1876']);
$country109=CountryCodes::create(['CodeName'=>'JO', 'dialingCode'=>'962']);
$country110=CountryCodes::create(['CodeName'=>'JP', 'dialingCode'=>'81']);
$country111=CountryCodes::create(['CodeName'=>'KE', 'dialingCode'=>'254']);
$country112=CountryCodes::create(['CodeName'=>'KG', 'dialingCode'=>'996']);
$country113=CountryCodes::create(['CodeName'=>'KH', 'dialingCode'=>'855']);
$country114=CountryCodes::create(['CodeName'=>'KI', 'dialingCode'=>'686']);
$country115=CountryCodes::create(['CodeName'=>'KM', 'dialingCode'=>'269']);
$country116=CountryCodes::create(['CodeName'=>'KN', 'dialingCode'=>'1869']);
$country117=CountryCodes::create(['CodeName'=>'KP', 'dialingCode'=>'850']);
$country118=CountryCodes::create(['CodeName'=>'KR', 'dialingCode'=>'82']);
$country119=CountryCodes::create(['CodeName'=>'KW', 'dialingCode'=>'965']);
$country120=CountryCodes::create(['CodeName'=>'KY', 'dialingCode'=>'1345']);
$country121=CountryCodes::create(['CodeName'=>'KZ', 'dialingCode'=>'7']);
$country122=CountryCodes::create(['CodeName'=>'LA', 'dialingCode'=>'856']);
$country123=CountryCodes::create(['CodeName'=>'LB', 'dialingCode'=>'961']);
$country124=CountryCodes::create(['CodeName'=>'LC', 'dialingCode'=>'1758']);
$country125=CountryCodes::create(['CodeName'=>'LI', 'dialingCode'=>'423']);
$country126=CountryCodes::create(['CodeName'=>'LK', 'dialingCode'=>'94']);
$country127=CountryCodes::create(['CodeName'=>'LR', 'dialingCode'=>'231']);
$country128=CountryCodes::create(['CodeName'=>'LS', 'dialingCode'=>'266']);
$country129=CountryCodes::create(['CodeName'=>'LT', 'dialingCode'=>'370']);
$country130=CountryCodes::create(['CodeName'=>'LU', 'dialingCode'=>'352']);
$country131=CountryCodes::create(['CodeName'=>'LV', 'dialingCode'=>'371']);
$country132=CountryCodes::create(['CodeName'=>'LY', 'dialingCode'=>'218']);
$country133=CountryCodes::create(['CodeName'=>'MA', 'dialingCode'=>'212']);
$country134=CountryCodes::create(['CodeName'=>'MC', 'dialingCode'=>'377']);
$country135=CountryCodes::create(['CodeName'=>'MD', 'dialingCode'=>'373']);
$country136=CountryCodes::create(['CodeName'=>'MG', 'dialingCode'=>'261']);
$country137=CountryCodes::create(['CodeName'=>'MH', 'dialingCode'=>'692']);
$country138=CountryCodes::create(['CodeName'=>'MK', 'dialingCode'=>'389']);
$country139=CountryCodes::create(['CodeName'=>'ML', 'dialingCode'=>'223']);
$country140=CountryCodes::create(['CodeName'=>'MM', 'dialingCode'=>'95']);
$country141=CountryCodes::create(['CodeName'=>'MN', 'dialingCode'=>'976']);
$country142=CountryCodes::create(['CodeName'=>'MO', 'dialingCode'=>'853']);
$country143=CountryCodes::create(['CodeName'=>'MP', 'dialingCode'=>'1670']);
$country144=CountryCodes::create(['CodeName'=>'MQ', 'dialingCode'=>'596']);
$country145=CountryCodes::create(['CodeName'=>'MR', 'dialingCode'=>'222']);
$country146=CountryCodes::create(['CodeName'=>'MS', 'dialingCode'=>'1664']);
$country147=CountryCodes::create(['CodeName'=>'MT', 'dialingCode'=>'356']);
$country148=CountryCodes::create(['CodeName'=>'MU', 'dialingCode'=>'230']);
$country149=CountryCodes::create(['CodeName'=>'MV', 'dialingCode'=>'960']);
$country150=CountryCodes::create(['CodeName'=>'MW', 'dialingCode'=>'265']);
$country151=CountryCodes::create(['CodeName'=>'MX', 'dialingCode'=>'52']);
$country152=CountryCodes::create(['CodeName'=>'MY', 'dialingCode'=>'60']);
$country153=CountryCodes::create(['CodeName'=>'MZ', 'dialingCode'=>'258']);
$country154=CountryCodes::create(['CodeName'=>'NA', 'dialingCode'=>'264']);
$country155=CountryCodes::create(['CodeName'=>'NC', 'dialingCode'=>'687']);
$country156=CountryCodes::create(['CodeName'=>'NE', 'dialingCode'=>'227']);
$country157=CountryCodes::create(['CodeName'=>'NF', 'dialingCode'=>'672']);
$country158=CountryCodes::create(['CodeName'=>'NG', 'dialingCode'=>'234']);
$country159=CountryCodes::create(['CodeName'=>'NI', 'dialingCode'=>'505']);
$country160=CountryCodes::create(['CodeName'=>'NL', 'dialingCode'=>'31']);
$country161=CountryCodes::create(['CodeName'=>'NO', 'dialingCode'=>'47']);
$country162=CountryCodes::create(['CodeName'=>'NP', 'dialingCode'=>'977']);
$country163=CountryCodes::create(['CodeName'=>'NR', 'dialingCode'=>'674']);
$country164=CountryCodes::create(['CodeName'=>'NU', 'dialingCode'=>'683']);
$country165=CountryCodes::create(['CodeName'=>'NZ', 'dialingCode'=>'64']);
$country166=CountryCodes::create(['CodeName'=>'OM', 'dialingCode'=>'968']);
$country167=CountryCodes::create(['CodeName'=>'PA', 'dialingCode'=>'507']);
$country168=CountryCodes::create(['CodeName'=>'PE', 'dialingCode'=>'51']);
$country169=CountryCodes::create(['CodeName'=>'PF', 'dialingCode'=>'689']);
$country170=CountryCodes::create(['CodeName'=>'PG', 'dialingCode'=>'675']);
$country171=CountryCodes::create(['CodeName'=>'PH', 'dialingCode'=>'63']);
$country172=CountryCodes::create(['CodeName'=>'PK', 'dialingCode'=>'92']);
$country173=CountryCodes::create(['CodeName'=>'PL', 'dialingCode'=>'48']);
$country174=CountryCodes::create(['CodeName'=>'PM', 'dialingCode'=>'508']);
$country175=CountryCodes::create(['CodeName'=>'PN', 'dialingCode'=>'64']);
$country176=CountryCodes::create(['CodeName'=>'PR', 'dialingCode'=>'1939']);
$country177=CountryCodes::create(['CodeName'=>'PR', 'dialingCode'=>'1787']);
$country178=CountryCodes::create(['CodeName'=>'PS', 'dialingCode'=>'970']);
$country179=CountryCodes::create(['CodeName'=>'PT', 'dialingCode'=>'351']);
$country180=CountryCodes::create(['CodeName'=>'PW', 'dialingCode'=>'680']);
$country181=CountryCodes::create(['CodeName'=>'PY', 'dialingCode'=>'595']);
$country182=CountryCodes::create(['CodeName'=>'QA', 'dialingCode'=>'974']);
$country183=CountryCodes::create(['CodeName'=>'RE', 'dialingCode'=>'262']);
$country184=CountryCodes::create(['CodeName'=>'RO', 'dialingCode'=>'40']);
$country185=CountryCodes::create(['CodeName'=>'RS', 'dialingCode'=>'381']);
$country186=CountryCodes::create(['CodeName'=>'RU', 'dialingCode'=>'7']);
$country187=CountryCodes::create(['CodeName'=>'RW', 'dialingCode'=>'250']);
$country188=CountryCodes::create(['CodeName'=>'SA', 'dialingCode'=>'966']);
$country189=CountryCodes::create(['CodeName'=>'SB', 'dialingCode'=>'677']);
$country190=CountryCodes::create(['CodeName'=>'SC', 'dialingCode'=>'248']);
$country191=CountryCodes::create(['CodeName'=>'SD', 'dialingCode'=>'249']);
$country192=CountryCodes::create(['CodeName'=>'SE', 'dialingCode'=>'46']);
$country193=CountryCodes::create(['CodeName'=>'SG', 'dialingCode'=>'65']);
$country194=CountryCodes::create(['CodeName'=>'SH', 'dialingCode'=>'290']);
$country195=CountryCodes::create(['CodeName'=>'SI', 'dialingCode'=>'386']);
$country196=CountryCodes::create(['CodeName'=>'SJ', 'dialingCode'=>'47']);
$country197=CountryCodes::create(['CodeName'=>'SK', 'dialingCode'=>'421']);
$country198=CountryCodes::create(['CodeName'=>'SL', 'dialingCode'=>'232']);
$country199=CountryCodes::create(['CodeName'=>'SM', 'dialingCode'=>'378']);
$country200=CountryCodes::create(['CodeName'=>'SN', 'dialingCode'=>'221']);
$country201=CountryCodes::create(['CodeName'=>'SO', 'dialingCode'=>'252']);
$country202=CountryCodes::create(['CodeName'=>'SR', 'dialingCode'=>'597']);
$country203=CountryCodes::create(['CodeName'=>'ST', 'dialingCode'=>'239']);
$country204=CountryCodes::create(['CodeName'=>'SU', 'dialingCode'=>'7']);
$country205=CountryCodes::create(['CodeName'=>'SV', 'dialingCode'=>'503']);
$country206=CountryCodes::create(['CodeName'=>'SY', 'dialingCode'=>'963']);
$country207=CountryCodes::create(['CodeName'=>'SZ', 'dialingCode'=>'268']);
$country208=CountryCodes::create(['CodeName'=>'TC', 'dialingCode'=>'1649']);
$country209=CountryCodes::create(['CodeName'=>'TD', 'dialingCode'=>'235']);
$country210=CountryCodes::create(['CodeName'=>'TE', 'dialingCode'=>'']);
$country211=CountryCodes::create(['CodeName'=>'TF', 'dialingCode'=>'262']);
$country212=CountryCodes::create(['CodeName'=>'TG', 'dialingCode'=>'228']);
$country213=CountryCodes::create(['CodeName'=>'TH', 'dialingCode'=>'66']);
$country214=CountryCodes::create(['CodeName'=>'TJ', 'dialingCode'=>'992']);
$country215=CountryCodes::create(['CodeName'=>'TK', 'dialingCode'=>'690']);
$country216=CountryCodes::create(['CodeName'=>'TM', 'dialingCode'=>'993']);
$country217=CountryCodes::create(['CodeName'=>'TN', 'dialingCode'=>'216']);
$country218=CountryCodes::create(['CodeName'=>'TO', 'dialingCode'=>'676']);
$country219=CountryCodes::create(['CodeName'=>'TP', 'dialingCode'=>'670']);
$country220=CountryCodes::create(['CodeName'=>'TR', 'dialingCode'=>'90']);
$country221=CountryCodes::create(['CodeName'=>'TT', 'dialingCode'=>'1868']);
$country222=CountryCodes::create(['CodeName'=>'TV', 'dialingCode'=>'688']);
$country223=CountryCodes::create(['CodeName'=>'TW', 'dialingCode'=>'886']);
$country224=CountryCodes::create(['CodeName'=>'TZ', 'dialingCode'=>'255']);
$country225=CountryCodes::create(['CodeName'=>'UA', 'dialingCode'=>'380']);
$country226=CountryCodes::create(['CodeName'=>'UG', 'dialingCode'=>'256']);
$country227=CountryCodes::create(['CodeName'=>'UM', 'dialingCode'=>'246']);
$country228=CountryCodes::create(['CodeName'=>'US', 'dialingCode'=>'1']);
$country229=CountryCodes::create(['CodeName'=>'UY', 'dialingCode'=>'598']);
$country230=CountryCodes::create(['CodeName'=>'UZ', 'dialingCode'=>'998']);
$country231=CountryCodes::create(['CodeName'=>'VA', 'dialingCode'=>'39']);
$country232=CountryCodes::create(['CodeName'=>'VA', 'dialingCode'=>'418']);
$country233=CountryCodes::create(['CodeName'=>'VC', 'dialingCode'=>'1784']);
$country234=CountryCodes::create(['CodeName'=>'VE', 'dialingCode'=>'58']);
$country235=CountryCodes::create(['CodeName'=>'VI', 'dialingCode'=>'1284']);
$country236=CountryCodes::create(['CodeName'=>'VN', 'dialingCode'=>'84']);
$country237=CountryCodes::create(['CodeName'=>'VQ', 'dialingCode'=>'1340']);
$country238=CountryCodes::create(['CodeName'=>'VU', 'dialingCode'=>'678']);
$country239=CountryCodes::create(['CodeName'=>'WF', 'dialingCode'=>'681']);
$country240=CountryCodes::create(['CodeName'=>'WS', 'dialingCode'=>'685']);
$country241=CountryCodes::create(['CodeName'=>'YE', 'dialingCode'=>'967']);
$country242=CountryCodes::create(['CodeName'=>'YT', 'dialingCode'=>'269']);
$country243=CountryCodes::create(['CodeName'=>'YU', 'dialingCode'=>'']);
$country244=CountryCodes::create(['CodeName'=>'ZA', 'dialingCode'=>'27']);
$country245=CountryCodes::create(['CodeName'=>'ZM', 'dialingCode'=>'260']);
$country246=CountryCodes::create(['CodeName'=>'ZR', 'dialingCode'=>'243']);
$country247=CountryCodes::create(['CodeName'=>'ZW', 'dialingCode'=>'263']);

    }
}

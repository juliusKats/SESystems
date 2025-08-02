<?php
namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {

        Validator::make($input, [
            'sname'     => ['required', 'string', 'max:50'],
            'fname'     => ['required', 'string', 'max:50'],
            'oname'     => ['nullable', 'string', 'max:50'],
            'email'     => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'userphoto' => 'nullable|mimes:jpeg,jpg,png',
            'password'  => $this->passwordRules(),
            'terms'     => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
       

        // validating photo field

        return DB::transaction(function () use ($input) {
            if (request()->hasfile('userphoto')) {
                $avatarName = time() . '.' . request()->userphoto->getClientOriginalExtension();
                request()->userphoto->move(public_path('storage/profile'), $avatarName);

                return tap(User::create([
                    'sname'              => $input['sname'],
                    'fname'              => $input['fname'],
                    'oname'              => $input['oname'],
                    'email'              => $input['email'],
                    'profile_photo_path' => $avatarName,
                    'password'           => Hash::make($input['password']),
                ]), function (User $user) {
                    $this->createTeam($user);
                    // request()->file('userphoto')->move(public_path('storage/profile'),time().request()->file('userphoto')->getClientOriginalName());
                    // $user->markEmailAsVerified();
                });
            } else {
                return tap(User::create([
                    'sname'              => $input['sname'],
                    'fname'              => $input['fname'],
                    'oname'              => $input['oname'],
                    'email'              => $input['email'],
                    'password'           => Hash::make($input['password']),
                ]), function (User $user) {
                    $this->createTeam($user);
                    // request()->file('userphoto')->move(public_path('storage/profile'),time().request()->file('userphoto')->getClientOriginalName());
                    // $user->markEmailAsVerified();
                });
            }

        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id'       => $user->id,
            'name'          => explode(' ', $user->sname, 2)[0] . "'s Team",
            'personal_team' => true,
        ]));
    }
}

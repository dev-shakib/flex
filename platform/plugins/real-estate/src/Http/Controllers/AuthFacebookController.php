<?php

namespace Botble\RealEstate\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Socialite;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Botble\RealEstate\Repositories\Interfaces\AccountInterface;
use Illuminate\Support\Facades\DB;

class AuthFacebookController extends Controller
{
  /**
   * Create a redirect method to facebook api.
   *
   * @return void
   */
    protected $accountRepository;

    public function __construct(AccountInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    protected function guard()
    {
        return auth('account');
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('facebook')->stateless()->user();
            $saveUser = [
                'facebook_id' => $user->getId(),
                'first_name' => $user->getName(),
                'last_name' => $user->getName(),
                'username' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => Hash::make($user->getName().'@'.$user->getId()),
                'created_at' => now(),
            ];

            DB::table('re_accounts')
                ->updateOrInsert([
                    'facebook_id' => $user->getId(),
                    'type' => 2], $saveUser);
                    
            // find user and login
            $this->guard()->login($this->accountRepository->getFirstBy(['facebook_id' => $user->getId()]));

            return redirect()->to('/projects');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

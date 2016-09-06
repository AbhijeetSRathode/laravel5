<?php

namespace App;

use Laravel\Socialite\Contracts\Factory as Socialite;
use Illuminate\Contracts\Auth\Authenticator;
use App\Repositories\UserRepository;

class AuthenticateUser{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     private $users;
     private $socialite;
     private $auth;
     
    public function __construct(UserRepository $users, Socialite $socialite , Authenticator $auth){
		$this->users = $users;
		$this->socialite = $socialite;
		$this->auth = $auth;

	}
    public function execute($hasCode){
		if(! $hasCode) return $this->getAuthorizationFirst();
		$user = $this->socialite->driver('sharepoint')->user();
		dd($user);
	}

	private function getAuthorizationFirst(){
		return $this->socialite->with('sharepoint')->redirect();
	}
   
}

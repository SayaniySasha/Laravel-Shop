<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Theme;
use App\User;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Support\Facades\Input;


use Validator;
use View;

class ProfileController extends Controller
{
    
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        // $this->middleware('auth');
    }
    
    /**
    * Get a validator for an incoming registration request.
    *
    * @param array $data
    *
    * @return \Illuminate\Contracts\Validation\Validator
    */
    public function profile_validator(array $data)
    {
            return Validator::make($data, [
                'theme_id'         => '',
                'location'         => '',
                'bio'              => 'max:500',
                'twitter_username' => 'max:50',
                'github_username'  => 'max:50',
                'avatar'           => '',
                'avatar_status'    => '',
            ]);
    }
    
    /**
    * Fetch user
    * (You can extract this to repository method).
    *
    * @param $username
    *
    * @return mixed
    */
    public function getUserByUsername($username)
    {
        return User::with('profile')->wherename($username)->firstOrFail();
    }
    
    /**
    * Display the specified resource.
    *
    * @param string $username
    *
    * @return Response
    */
    public function show($username)
    {
        try {
            $user = $this->getUserByUsername($username);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }
    
        $currentTheme = Theme::find($user->profile->theme_id);
    
        $data = [
            'user'         => $user,
            'currentTheme' => $currentTheme,
        ];
    
        return view('profiles.show')->with($data);
    }
    
    /**
    * /profiles/username/edit.
    *
    * @param $username
    *
    * @return mixed
    */
    public function edit($username)
    {
        try {
            $user = $this->getUserByUsername($username);
        } catch (ModelNotFoundException $exception) {
            return view('pages.status')
                ->with('error', 'This is not Your Profile')
                ->with('error_title', 'This is not Your Profile');
        }
    
        $themes = Theme::where('status', 1)
                        ->orderBy('name', 'asc')
                        ->get();
    
        $currentTheme = Theme::find($user->profile->theme_id);
    
        $data = [
            'user'         => $user,
            'themes'       => $themes,
            'currentTheme' => $currentTheme,
    
        ];
    
        return view('profiles.edit')->with($data);
    }
    
    /**
    * Update a user's profile.
    *
    * @param $username
    *
    * @throws Laracasts\Validation\FormValidationException
    *
    * @return mixed
    */
    public function update($username, Request $request)
    {
        $user = $this->getUserByUsername($username);
    
        $input = Input::only('theme_id', 'location', 'bio', 'twitter_username', 'github_username', 'avatar_status');
                
        $profile_validator = $this->profile_validator($request->all());
    
        if ($profile_validator->fails()) {
            return back()->withErrors($profile_validator)->withInput();
        }
    
        if ($user->profile == null) {
            $profile = new Profile();
            $profile->fill($input);
            $user->profile()->save($profile);
        } else {
            $user->profile->fill($input)->save();
        }
        $user->save();
    
        return redirect('profile/'.$user->name.'/edit')->with('success', 'Profile Updated Successfully');
    }
    
    /**
    * Get a validator for an incoming update user request.
    *
    * @param array $data
    *
    * @return \Illuminate\Contracts\Validation\Validator
    */
    public function validator(array $data)
    {
        return Validator::make($data, [
           'name' => 'required|max:255',
            ]
        );
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param int                      $id
    *
    * @return \Illuminate\Http\Response
    */
    public function updateUserAccount(Request $request, $id)
    {
        $currentUser = \Auth::user();
        $user = User::findOrFail($id);
        $emailCheck = ($request->input('email') != '') && ($request->input('email') != $user->email);
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            ]
        );
    
        $rules = [];
    
        if ($emailCheck) {
            $rules = [
                'email' => 'email|max:255|unique:users',
            ];
        }
    
        $validator = $this->validator($request->all(), $rules);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $user->name = $request->input('name');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
    
        if ($emailCheck) {
            $user->email = $request->input('email');
        }
  
        $user->save();
    
        return redirect('profile/'.$user->name.'/edit')->with('success', 'Account updated Successfully');
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param int                      $id
    *
    * @return \Illuminate\Http\Response
    */
    public function updateUserPassword(Request $request, $id)
    {
        $currentUser = \Auth::user();
        $user = User::findOrFail($id);
        
        $validator = Validator::make($request->all(),
            [
                'password'              => 'required|min:6|max:20|confirmed',
                'password_confirmation' => 'required|same:password',
            ],
            [
                'password.required' => trans('auth.passwordRequired'),
                'password.min'      => trans('auth.PasswordMin'),
                'password.max'      => trans('auth.PasswordMax'),
            ]
        );
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        if ($request->input('password') != null) {
            $user->password = bcrypt($request->input('password'));
        }
        
        $user->save();
    
        return redirect('profile/'.$user->name.'/edit')->with('success', 'Password updated Successfully');
    }
    
    
    /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param int                      $id
    *
    * @return \Illuminate\Http\Response
    */
    public function deleteUserAccount(Request $request, $id)
    {
    
    }

}

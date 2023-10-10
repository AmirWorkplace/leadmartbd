<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('reseller.login');
        }

        if ($request->isMethod('POST')) {
            $request->validate([
                'email_or_username' => 'required',
                'password' => 'required',
            ]);

            $login_id = $request->email_or_username;
            $password = $request->password;

            if(filter_var($login_id, FILTER_VALIDATE_EMAIL)) {
                $user = User::where('email', $login_id)->first();
                if($user){
                    if(Hash::check($password, $user->password)) {
                        if($user->status){
                            Auth::login($user);

                            return redirect()->route('admin.dashboard')->withSuccessMessage('Login Successfully!');
                        } else {
                            return redirect()->back()->withSuccessMessage('Your Account Approval is pending. Please wait a little bit!');
                        }
                    } else {
                        return redirect()->back()->withErrors("Your Password doesn't match with your credentials!");
                    }
                } else {
                    return redirect()->back()->withErrors("There has no account exists on `{$login_id}` that's email!");
                }
            } else {
                $user = User::where('user_name', $login_id)->first();

                if($user){
                    if(Hash::check($password, $user->password)) {
                        if($user->status){
                            Auth::login($user);

                            return redirect()->route('admin.dashboard')->withSuccessMessage('Login Successfully!');
                        } else {
                            return redirect()->back()->withSuccessMessage('Your Account Approval is pending. Please wait a little bit!');
                        }
                    } else {
                        return redirect()->back()->withErrors("Your Password doesn't match with your credentials!");
                    }
                } else {
                    return redirect()->back()->withErrors("There has no account exists on `{$login_id}` that's username!");
                }
            }
        }
    }

    public function register(Request $request){
        if ($request->isMethod('GET')) {
            return view('reseller.register');
        }

        if ($request->isMethod('POST')) {
            $request->validate([
                'user_name' => 'required|unique:users,user_name',
                'email' => 'required|unique:users,email',
                'phone' => 'required',
                'password' => 'required|min:8',
                'name' => 'required',
                'shop_name' => 'required',
                'city' => 'required',
            ]);

            $password =  Hash::make($request->password);

            $reseller = User::create([
                'role' => 2,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'user_name' => $request->user_name,
                'shop_name' => $request->shop_name,
                'password' => $password,
                'city' => $request->city,
                'address' => $request->address,
                'website_url' => $request->website_url,
                'status' => false,
            ]);

            $role = Role::findByName('Reseller Admin');
            $reseller->syncRoles($role);
            // Auth::login($reseller);
            return redirect()->route('reseller.login')->withSuccessMessage('Registered Successfully, Please wait for approval!');
        }
    }
}

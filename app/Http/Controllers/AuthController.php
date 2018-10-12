<?php

namespace Kazka\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Kazka\User;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
     	]);

     	$fields = [
     		'_token' => $request->_token,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

     	$user = User::add($fields);

     	return redirect(route('showLoginForm'));
    }

    public function login(Request $request)
    {
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required'
     	]);

     	$result = Auth::attempt([
    		'email' => $request->get('email'),
    		'password' => $request->get('password')
    	]);
    	if($result)
    	{
    		return redirect(route('admin'));
    	}
    	else
    	{
    		return redirect()->back()->with('status', 'Неправильний логін чи пароль');
    	}
    }
}

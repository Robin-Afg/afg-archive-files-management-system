<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    

    public function showRegistrationForm() {
        return view('auth.register');
    }


    public function register(Request $request) {
        
        $this->validate($request,
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'type' => 'required',
                'dept' => 'required',
            ],
            [
                'name.required' => ' نام کاربر باید موجود باشد  ',
                'name.string' => 'نام کاربر باید حروفی  باشد ',
                
                'email.required' => 'ایمیل کاربر باید موجود باشد  ',
                'email.unique' => 'این ایمیل  قبلا موجود است  ',

                'email.string' => 'ایمیل کاربر باید حروفی باشد  ',
                'email.email' => 'ایمیل کاربر باید به شکل درست باشد   ',
                

                'password.required' => 'رمز عبور باید موجود باشد  ',  
                'password.string' => 'رمز عبور باید حروفی باشد   ',  
                'password.min' => 'رمز عبور باید کمتر از 8 کلمه نباشد   ',  
                'password.confirmed' => 'تایید رمز عبور اشتباه است ',

                'type.required' => ' نوعیت کاربر باید معلوم باشد  ',
                'dept.required' => 'دیپارتمنت کاربر باید موجود باشد  ',  

            ]
        );


        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->type = $request->type;
        $user->dept = $request->dept;
        $user->save();

      
        $request->session()->flash('alert-success', '! موفقانه اضافه گردید    ' . $request->name);
        return redirect("register");


    }
      


}

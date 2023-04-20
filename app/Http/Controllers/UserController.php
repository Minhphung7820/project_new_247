<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function index()
  {
    User::where("avatar", "=", "")->update([
      "avatar" => "avatar.jpg",
    ]);
    return view("pages.account");
  }

  public function getLogin()
  {
    return view("pages.login");
  }

  public function login(Request $request)
  {
    $request->validate(
      [
        "email" => "required",
        "password" => "required",
      ],
      [
        "email.required" => "Bắt buộc nhập Email",
        "password.required" => "Bắt buộc nhập mật khẩu",
      ]
    );

    if (Auth::attempt(['email' => $request->input("email"), "password" => $request->input("password"), "provider" => null])) {
      return redirect()->route('getLogin')->with("success", "Đăng nhập thành công !");
    } else {
      return redirect()->route('getLogin')->with("login_error", "Tài khoản hoặc mật khẩu không đúng !");
    }
  }
  public function getLogout()
  {
    if (Auth::check()) {
      Auth::logout();
      return redirect()->route("getLogin");
    }
  }
  public function logout(Request $request)
  {
    if ($request->isMethod("post")) {
      Auth::logout();
      return redirect()->route("getLogin");
    }
  }

  public function register()
  {
    return view('pages.register');
  }

  public function postRegister(Request $request)
  {
    if ($request->isMethod("post")) {
      $request->validate([
        'username'             => 'required',
        'email'            => 'required|email',
        'password'         => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/',
        'password_confirm' => 'required|same:password'
      ], [
        'username.required' => 'Tên đăng nhập bắt buộc !',
        'email.required' => 'Email bắt buộc !',
        'password.required' => 'Bất buộc nhập mật khẩu !',
        'password.min' => "Mật khẩu ít nhất 8 ký tự !",
        "password.regex" => "Mật khẩu phải có ít nhất 1 chữ thường , chữ in hoa và chữ số !",
        'password_confirm.required' => "Bạn chưa nhập lại mật khẩu !",
        'password_confirm.same' => "Nhập lại mật khẩu không đúng !",
      ]);
    }

    $checkEmail = User::where("email", "=", $request->input('email'))->where('provider', "=", null)->get();
    if (count($checkEmail) > 0)
      return redirect()->back()->withInput($request->all())->with("email_exist", "Email đã được đăng ký hãy chọn Email khác !");
    else
      $userCreate = User::create([
        "email" => $request->input('email'),
        "name" => filter_var(trim($request->input('username')), FILTER_SANITIZE_STRING),
        'password' => bcrypt($request->input('password')),
      ]);

    Auth::login($userCreate);
    return redirect('/tai-khoan')->with("register_successful", "Chúc mừng bạn đã đăng ký thành công");
  }
}

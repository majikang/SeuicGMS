<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Log;
use DB;
use Carbon\Carbon;


/**
 * 登录认证控制器
 *
 * @package App\Http\Controllers\Auth
 */
class AuthController extends Controller
{
    /**
     * 设置成功登录后转向的页面:
     *
     * @var string
     */
    public $redirectPath = '/backend/index';

    /**
     * 设置登录失败后转向的页面
     *
     * @var string
     */
    protected $loginPath = '/auth/login';

    /**
     * 设置退出登录后转向的页面
     *
     * @var string
     */
    protected $redirectAfterLogout = '/auth/login';
    protected $maxLoginAttempts = 10; //每分钟最大尝试登录次数
    protected $lockoutTime = 60;  //登录锁定时间

    /*
    |--------------------------------------------------------------------------
    |  注册和登陆的控制器
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors.
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return mixed
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * 显示登陆表单界面
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        if (view()->exists('auth.authenticate')) {
            return view('auth.authenticate');
        }

        return view('auth.login');
    }

    /**
     * 处理登录请求
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required',
            'password'             => 'required',
            'captcha'              => 'required|captcha',
        ], [
                'email.required'    => '请输入用户邮箱',
                'password.required' => '请输入密码',
                'captcha.required'  => '请输入验证码',
                'captcha.captcha'   => '验证码有误',
            ]
        );

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();
        //尝试登陆多次后锁定用户并重定向到登陆
        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            //日志记录
            Log::warning(['email'=>$request->input('email'), 'login_ip'=>$request->ip(), 'login_result'=>0, 'comments'=>'限制登录1分钟']);
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $data = [
                'lastlogintime'=>Carbon::now(),
                'lastloginip'=>$request->ip(),
            ];
            $users = DB::table('users')
                ->where('email', $request->input('email'))
                ->orWhere('password', $request->input('password'))
                ->update($data);
            //日志记录
            log::info(['email'=>$request->input('email'), 'login_ip'=>$request->ip(), 'login_result'=>1, 'comments'=>'登录成功']);
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            //日志记录
            log::error(['email'=>$request->input('email'), 'login_ip'=>$request->ip(), 'login_result'=>0, 'comments'=>'登录失败']);
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }



}

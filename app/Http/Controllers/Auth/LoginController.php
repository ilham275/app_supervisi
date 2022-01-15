<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function nip()
    {
        return 'nip';
    }
    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'nip' => 'required',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('nip' => $input['nip'], 'password' => $input['password'])))
        {

            //kurikulum
            if (auth()->user()->is_admin == 1) {
                if(auth()->user()->supervisor == 1){
                    return redirect()->route('kurikulum.index');
                }
            }
            //kepsek
            if(auth()->user()->is_admin == 2){
                if(auth()->user()->supervisor == 1){
                    return redirect()->route('kepseksuper.index');
                }
                else{
                    return redirect()->route('kepsek.index');
                }
            }
            //guru
            if(auth()->user()->is_admin == 3){
                if(auth()->user()->supervisor == 1){
                    return redirect()->route('gurusuper.index');
                }
                else{
                    return redirect()->route('guru.index');
                }
            }


        }
        else{
            return redirect()->route('login')
                ->with('error','NIP Ataw Password Salah');
        }

    }
}

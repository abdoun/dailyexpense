<?php namespace App\Http\Controllers\pages;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App;
use Session;
use DB;
class membership extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('guest');
		session()->regenerate();
        App::setLocale(Session::get('lang'));
        if(Session::get('lang')=='')
        {
            Session::put('lang',$request->cookie('lang'));
        }
		//Session::put('lang', 'tr');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		App::setLocale(Session::get('lang'));
		return view('page.master',['active' => 'home','lang_default'=>Session::get('lang')]);
	}
    public function getSignup($msg='')
	{
		App::setLocale(Session::get('lang'));
		return view('membership.signup',['active' => 'membership_signup','lang_default'=>Session::get('lang'),'msg'=>$msg]);
	}
    public function getProfile($msg='')
	{
		App::setLocale(Session::get('lang'));
		return view('membership.profile',['active' => 'membership_profile','lang_default'=>Session::get('lang'),'msg'=>$msg]);
	}
    public function getChangepass($msg='')
	{
		App::setLocale(Session::get('lang'));
		return view('membership.changepass',['active' => 'membership_changepass','lang_default'=>Session::get('lang'),'msg'=>$msg]);
	}
    public function postSignup()
	{
		App::setLocale(Session::get('lang'));
		$input = Request::all();
		if (empty($input['code_capthca']) || Session::get('new_string')!=$input['code_capthca'])
		{
			$msg='error_code_kaptcha';
			return $this->getSignup($msg);
		}
        elseif (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
          $msg = "Invalid_email_format";
          return $this->getSignup($msg.':'.$input['email']); 
        }
		elseif(empty($input['username']) || empty($input['password']))
		{
			$msg='field_empty';
			return $this->getSignup($msg);
		}
		else
		{
			$result=DB::select("SELECT count(*) as c FROM users where username='".$input['username']."' or email='".$input['email']."'");
			$result  = json_decode(json_encode($result), true);
			if($result[0]['c']>1)
			{
				$msg='error_usr_already_existed';
				return $this->getLogin($msg);
			}
			else
			{
			 //////// insert new user/////////////////////////
             DB::table('users')->insert(
                    ['email' => $input['email'], 'username' => $input['username'],'password'=>$input['password'],'active'=>1]
                );
				Session::put('username', $input['username']);
				$msg='thanks';
				return view('membership.membership',['active' => 'membership','lang_default'=>Session::get('lang'),'msg'=>$msg]);
			}
			
		}
	}
	public function getLogin($msg='')
	{
		App::setLocale(Session::get('lang'));
		return view('membership.login',['active' => 'membership_login','lang_default'=>Session::get('lang'),'msg'=>$msg]);
	}
	public function postSignin()
	{
		App::setLocale(Session::get('lang'));
		$input = Request::all();
		if (empty($input['code_capthca']) || Session::get('new_string')!=$input['code_capthca'])
		{
			$msg='error_code_kaptcha';
			return $this->getLogin($msg);
		}
		elseif(empty($input['username']) || empty($input['password']))
		{
			$msg='field_empty';
			return $this->getLogin($msg);
		}
		else
		{
			$result=DB::select("SELECT count(*) as c FROM users where username='".$input['username']."' and password='".$input['password']."' and active='1'");
			$result  = json_decode(json_encode($result), true);
			if($result[0]['c']<1)
			{
				$msg='error_usr_pass';
				return $this->getLogin($msg);
			}
			else
			{
				Session::put('username', $input['username']);
				$msg='thanks';
				return view('membership.membership',['active' => 'membership','lang_default'=>Session::get('lang'),'msg'=>$msg]);
			}
			
		}
	}
	public function getAddauthors()
	{
		App::setLocale(Session::get('lang'));
		return view('membership.membership',['active' => 'membership_addauthors','lang_default'=>Session::get('lang'),'msg'=>'']);
	}
	public function getEditproperty()
	{
		App::setLocale(Session::get('lang'));
		return redirect('pages/thesaurus');
		//return view('membership.membership',['active' => 'membership_editproperty','lang_default'=>Session::get('lang'),'msg'=>'']);
	}
	public function getLogout()
	{		
			Session::forget('username');
			$msg='thanks';
			return $this->getLogin($msg);		
	}
	public function getImgcaptcha()
	{
		srand((double)microtime()*1000000000); 
		$string = md5(rand(0,999999));
		Session::put("new_string",strtoupper( substr($string, 17, 4)));  
		return view('page.imgcaptcha',['new_string'=>Session::get('new_string')]);
	}
}
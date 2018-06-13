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
            Session::put('lang','en');
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
        if(!$this->satisfied())  return $this->getLogin();

		return view('membership.profile',['active' => 'membership_profile','lang_default'=>Session::get('lang'),'msg'=>$msg]);
	}
    public function getChangepass($msg='')
	{
		App::setLocale(Session::get('lang'));
        if(!$this->satisfied())  return $this->getLogin();
		return view('membership.changepass',['active' => 'membership_changepass','lang_default'=>Session::get('lang'),'msg'=>$msg]);
	}
    public function postChangepass()
    {
        App::setLocale(Session::get('lang'));
        if(!$this->satisfied())  return $this->getLogin();
        $user_id=$this->satisfied();
        $input = Request::all();
        if (empty($input['code_capthca']) || Session::get('new_string')!=$input['code_capthca'])
        {
            $msg='error_code_kaptcha';
            return $this->getChangepass($msg);
        }
        elseif(empty($input['password']))
        {
            $msg='field_empty';
            return $this->getChangepass($msg);
        }
        else
        {
            DB::table('users')
                ->where('id',$user_id)
                ->update(['password'=>md5($input['password'])]);
            $msg='reset';
            return $this->getChangepass($msg);
        }

    }
    public function getForgetpass($msg='')
    {
        App::setLocale(Session::get('lang'));
        return view('membership.forgetpass',['active' => 'membership_forgetpass','lang_default'=>Session::get('lang'),'msg'=>$msg]);
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
                    ['email' => $input['email'], 'username' => $input['username'],'password'=>md5($input['password']),'active'=>1]
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
			$result=DB::select("SELECT count(*) as c FROM users where username='".$input['username']."' and password='".md5($input['password'])."' and active='1'");
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
	public function satisfied()
    {
        $user_id=DB::select("select id from users where username='".Session::get('username')."'");
        $user_id  = json_decode(json_encode($user_id), true);
         return isset($user_id[0]['id']) ? $user_id[0]['id'] : false;
    }
	public function getLogout()
	{
        if(!$this->satisfied())  return $this->getLogin();
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
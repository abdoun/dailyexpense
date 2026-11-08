<?php namespace App\Http\Controllers\pages;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App;
use Session;
use DB;
class homepage extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('guest');
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
		return view('page.master',['active' => 'home','lang_default'=>Session::get('lang'),'showHomeNotice'=>true]);
	}
	public function getLang($lang='en')
	{
		Session::put('lang', $lang);
        //$response = new Response;
        //$response->withCookie(cookie()->forever('lang', $lang));
		App::setLocale(Session::get('lang'));
		return view('page.master',['active' => 'home','lang_default' => Session::get('lang')]);
	}
	public function getContacts()
	{
		App::setLocale(Session::get('lang'));
		return view('page.contacts',['active' => 'contacts','lang_default'=>Session::get('lang')]);
	}
    public function getPrivacy()
	{
		App::setLocale(Session::get('lang'));
		return view('page.privacy',['active' => 'privacy','lang_default'=>Session::get('lang')]);
	}
	public function getImgcaptcha()
	{
		srand((double)microtime()*1000000000); 
		$string = md5(rand(0,999999));
		Session::put("new_string",strtoupper( substr($string, 17, 4)));  
		return response()->view('page.imgcaptcha',['new_string'=>Session::get('new_string')])
			->header('Content-Type', 'image/png');
	}
}
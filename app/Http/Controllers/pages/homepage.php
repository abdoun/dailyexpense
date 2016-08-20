<?php namespace App\Http\Controllers\pages;
use Illuminate\Support\Facades\Request;
//use Illuminate\Http\Response;
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
		session()->regenerate();
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
	public function getLang($lang='tr')
	{
		Session::put('lang', $lang);
		App::setLocale(Session::get('lang'));
		return view('page.master',['active' => 'home','lang_default' => Session::get('lang')]);
	}
	public function getThesaurus($msg='')
	{
		App::setLocale(Session::get('lang'));
		$results = DB::select('select *  from category');
		//$results  = json_decode(json_encode($results), true);
		//$msg='';
		return view('page.thesaurus',['active' => 'thesaurus','lang_default'=>Session::get('lang'),'cat'=>$results,'msg'=>$msg]);
	}
	public function getThesaurusresult($term='',$category='',$rec=0)
	{
		App::setLocale(Session::get('lang'));
		//$input = Request::all();
		$input['term']=$term;if($input['term']==''){$input['term']=0;}
		$input['category']=$category;if($input['category']==''){$input['category']=0;}
		$input['rec']=$rec;if($input['rec']==''){$input['rec']=0;}
		$sql='';$cat='';
		if($term!='0' && $term!=''){$sql.=" where authors.title like '%".$term."%'";}else{$term='';}
		if($category!='null' && $category!='' && $category!='0')
		{
			$cate=DB::select("select title from category where id='".$category."'");
			$cate  = json_decode(json_encode($cate), true);
			$cat.="  inner join cat_id on cat_id.author_id=authors.id inner join category on category.id=cat_id.cat_id and cat_id.cat_id = '".$category."'";
		}//else{$cat.="  left outer join cat_id on cat_id.author_id=authors.id left outer join category on category.id=cat_id.cat_id ";}
		else{$cate[0]['title']='';}
		$limit=" limit $rec,10";
		//print($sql.' '.$cat);
		$count = DB::select('select authors.id  from authors '.$cat.$sql);
		$results = DB::select('select authors.id as id,authors.title as term from authors '.$cat.$sql.' order by authors.id asc'.$limit);
		return view('page.thesaurusresult',['active' => 'thesaurus','lang_default'=>Session::get('lang'),'input'=>$input,'results'=>$results,'count'=>$count,'cate'=>$cate,'term'=>$term]);		
	}
	public function postThesaurusresult1()
	{
		App::setLocale(Session::get('lang'));
		$input = Request::all();
		if (empty($input['code_capthca']) || Session::get('new_string')!=$input['code_capthca'])
		{
			$msg='error_code_kaptcha';
			return $this->getThesaurus($msg);
		}
		else
		{
			$results = DB::select('select authors.title as term,category.title as category  from authors left outer join cat_id on cat_id.author_id=authors.id left outer join category on category.id=cat_id.cat_id');
			return view('page.thesaurusresult',['active' => 'thesaurus','lang_default'=>Session::get('lang'),'results'=>$results]);
		}
	}
	
	public function getContacts()
	{
		App::setLocale(Session::get('lang'));
		return view('page.contacts',['active' => 'contacts','lang_default'=>Session::get('lang')]);
	}
    public function getAboutproject()
	{
		App::setLocale(Session::get('lang'));
		return view('page.aboutproject',['active' => 'about_project','lang_default'=>Session::get('lang')]);
	}
    public function getAboutme()
	{
		App::setLocale(Session::get('lang'));
		return view('page.aboutme',['active' => 'about_me','lang_default'=>Session::get('lang')]);
	}
	public function postEditauthor()
	{
		App::setLocale(Session::get('lang'));
		$input = Request::all();
		if(empty($input['term']) || empty($input['id_author']))
		{
			$msg='field_empty';
		}
		else
		{
			DB::table('authors')->where('id', $input['id_author'])->update(['title' => $input['term'],'scope_note' => $input['scope_note'],'birth_death' => $input['birth_death']]);
			$msg='thanks';
		}
		return $this->getEditproperty($input['id_author'],$msg);
	}
	public function getEditproperty($id,$msg='')
	{
		App::setLocale(Session::get('lang'));
		$author = DB::select("select * from authors where id='".$id."'");
		$author  = json_decode(json_encode($author), true);
		$category = DB::select("select category.* from category left outer join cat_id on cat_id.cat_id=category.id where cat_id.author_id='".$id."'");
		//$category  = json_decode(json_encode($category), true);
		return view('page.editproperty',['lang_default'=>Session::get('lang'),'author'=>$author,'category'=>$category,'msg'=>$msg]);
	}
	public function getEditcatid($id,$msg='')
	{
		App::setLocale(Session::get('lang'));
		$category = DB::select("select category.* from category left outer join cat_id on cat_id.cat_id=category.id where cat_id.author_id='".$id."'");
		//$category  = json_decode(json_encode($category), true);
		return view('page.editcat_id',['lang_default'=>Session::get('lang'),'category'=>$category,'msg'=>$msg]);
	}
	public function getDeleteauthor($id)
	{
		App::setLocale(Session::get('lang'));
		if(!empty($id))
		{
			$msg='thank you,delete'.$id;
		}
		else
		{
			$msg='error';
		}
		return view('page.editproperty',['active' => 'membership_editproperty','lang_default'=>Session::get('lang'),'msg'=>$msg]);
	}
	public function getImgcaptcha()
	{
		srand((double)microtime()*1000000000); 
		$string = md5(rand(0,999999));
		Session::put("new_string",strtoupper( substr($string, 17, 4)));  
		return view('page.imgcaptcha',['new_string'=>Session::get('new_string')]);
	}
}
<?php namespace App\Http\Controllers\pages;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App;
use Session;
use DB;
class expense extends Controller {

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
	public function getLang($lang='tr')
	{
		Session::put('lang', $lang);
        $response = new Response;
        //$response->withCookie(cookie()->forever('lang', $lang));
		App::setLocale(Session::get('lang'));
		return view('page.master',['active' => 'home','lang_default' => Session::get('lang')]);
	}
    public function getBudget()
    {
        App::setLocale(Session::get('lang'));
        $sql='';$cat='';
		$user_id=DB::select("select id from users where username='".Session::get('username')."'");
		$user_id  = json_decode(json_encode($user_id), true);
        $user_id=$user_id[0]['id'];
        $bookStartDate=DB::select("select DISTINCT DATEDIFF(CURDATE(),min(date_time)) as days from expenditure where expenditure.user_id='".$user_id."'");
		$bookStartDate  = json_decode(json_encode($bookStartDate), true);
        $bookStartDate=$bookStartDate[0]['days'];//echo "$bookStartDate<br>";
		//$cate = DB::select('select id,name  from expenditure_category where user_id='.$user_id.$sql);
		$results = DB::select('select expenditure.*,expenditure_category.name as name from expenditure inner join expenditure_category on expenditure_category.id=expenditure.category where expenditure.user_id='.$user_id.$cat.$sql.' order by expenditure.id desc');
        //$results  = json_decode(json_encode($results), true);
        foreach($results as $k=>$value)
        {
            if(empty($resu_n)){$resu_n=0;}
            if(empty($resu_p)){$resu_p=0;}
            if(empty($res[$value->name])){$res[$value->name]=0;}
            if($value->to_from=='to')
            {
                $res[$value->name]-=$value->qty;
                $resu_n+=$value->qty;
            }
            else
            {
                $res[$value->name]+=$value->qty;
                $resu_p+=$value->qty;
            }
        }
        return view('expense.budget',['active' => 'budget','lang_default'=>Session::get('lang'),'res'=>$res,'resu_p'=>$resu_p,'resu_n'=>$resu_n,'days'=>$bookStartDate]);
    }
    public function getReport()
    {
        App::setLocale(Session::get('lang'));
        $sql='';$cat='';
		$user_id=DB::select("select id from users where username='".Session::get('username')."'");
		$user_id  = json_decode(json_encode($user_id), true);
        $user_id=$user_id[0]['id'];
		//$cate = DB::select('select id,name  from expenditure_category where user_id='.$user_id.$sql);
		$results = DB::select('select expenditure.*,expenditure_category.name as name from expenditure inner join expenditure_category on expenditure_category.id=expenditure.category where expenditure.user_id='.$user_id.$cat.$sql.' order by expenditure.id desc');
        //$results  = json_decode(json_encode($results), true);
        foreach($results as $k=>$value)
        {
            if(empty($resu_n)){$resu_n=0;}
            if(empty($resu_p)){$resu_p=0;}
            if(empty($res[$value->name])){$res[$value->name]=0;}
            if($value->to_from=='to')
            {
                $res[$value->name]-=$value->qty;
                $resu_n+=$value->qty;
            }
            else
            {
                $res[$value->name]+=$value->qty;
                $resu_p+=$value->qty;
            }
        }
        return view('expense.report',['active' => 'budget','lang_default'=>Session::get('lang'),'res'=>$res,'resu_p'=>$resu_p,'resu_n'=>$resu_n]);
    }
    public function getTransactions($rec=0)
    {
        App::setLocale(Session::get('lang'));
        $input['rec']=$rec;if($input['rec']==''){$input['rec']=0;}
		$sql='';$cat='';
		$user_id=DB::select("select id from users where username='".Session::get('username')."'");
		$user_id  = json_decode(json_encode($user_id), true);
        $user_id=$user_id[0]['id'];
		$limit=" limit $rec,30";
		//print($sql.' '.$cat);
		$count = DB::select('select id  from expenditure where user_id='.$user_id.$sql);
		$results = DB::select('select expenditure.*,expenditure_category.name as name from expenditure inner join expenditure_category on expenditure_category.id=expenditure.category where expenditure.user_id='.$user_id.$cat.$sql.' order by expenditure.date_time desc'.$limit);
		//return view('page.thesaurusresult',['active' => 'thesaurus','lang_default'=>Session::get('lang'),'input'=>$input,'results'=>$results,'count'=>$count,'cate'=>$cate,'term'=>$term]);
		return view('expense.transactions',['active' => 'transactions','lang_default'=>Session::get('lang'),'input'=>$input,'results'=>$results,'count'=>$count]);
    }
    public function getEdittransactions($id,$msg='')
	{
		App::setLocale(Session::get('lang'));
        $user_id=DB::select("select id from users where username='".Session::get('username')."'");
		$user_id  = json_decode(json_encode($user_id), true);
        $user_id=$user_id[0]['id'];
        $category = DB::select('select expenditure_category.id as id,expenditure_category.name as name from expenditure_category where user_id='.$user_id.' order by expenditure_category.id asc');
		//$category  = json_decode(json_encode($category), true);
        if($id!='new')
        {            
    		$expenditure = DB::select("select expenditure.* from expenditure where expenditure.id='".$id."'");
    		$expenditure  = json_decode(json_encode($expenditure), true);
        }
		else
        {
            $expenditure=null;
        }
		return view('expense.edittransactions',['lang_default'=>Session::get('lang'),'expenditure'=>$expenditure,'category'=>$category,'msg'=>$msg]);
	}
	public function getCategories($name='',$rec=0)
	{
		App::setLocale(Session::get('lang'));
        //$input = Request::all();
		$input['name']=$name;if($input['name']==''){$input['name']=0;}
		$input['rec']=$rec;if($input['rec']==''){$input['rec']=0;}
		$sql='';$cat='';
		$user_id=DB::select("select id from users where username='".Session::get('username')."'");
		$user_id  = json_decode(json_encode($user_id), true);
        $user_id=$user_id[0]['id'];
		$limit=" limit $rec,10";
		//print($sql.' '.$cat);
		$count = DB::select('select expenditure_category.id  from expenditure_category where user_id='.$user_id.$sql);
		$results = DB::select('select expenditure_category.id as id,expenditure_category.name as name,expenditure_category.notes as notes from expenditure_category where user_id='.$user_id.$cat.$sql.' order by expenditure_category.id asc'.$limit);
		//return view('page.thesaurusresult',['active' => 'thesaurus','lang_default'=>Session::get('lang'),'input'=>$input,'results'=>$results,'count'=>$count,'cate'=>$cate,'term'=>$term]);
		return view('expense.categories',['active' => 'categories','lang_default'=>Session::get('lang'),'input'=>$input,'results'=>$results,'count'=>$count,'name'=>$name]);
	}
    public function getEditcategories($id,$msg='')
	{
		App::setLocale(Session::get('lang'));
        if($id!='new')
        {
            //$author = DB::select("select * from authors where id='".$id."'");
    		//$author  = json_decode(json_encode($author), true);
    		$category = DB::select("select expenditure_category.* from expenditure_category  where expenditure_category.id='".$id."'");
    		$category  = json_decode(json_encode($category), true);
        }
		else
        {
            $category=null;
        }
		return view('expense.editcategories',['lang_default'=>Session::get('lang'),'category'=>$category,'msg'=>$msg]);
	}
    public function getDelcategory($id)
    {
        if(!empty($id))
        {
            DB::table('expenditure_category')->where('id', '=', $id)->delete();
            return 'Thanks';
        }
    }
    public function postEditcategories()
	{
		App::setLocale(Session::get('lang'));
		$input = Request::all();
		if(empty($input['name']))
		{
			$msg='field_empty';
			return $this->getEditcategories($input['id_category'],$msg);
		}
		else
		{
		    $user_id=DB::select("select id from users where username='".Session::get('username')."'");
    		$user_id  = json_decode(json_encode($user_id), true);
            $user_id=$user_id[0]['id'];
			if(!empty($input['id_category']))
			{
                DB::table('expenditure_category')->where('id', $input['id_category'])->update(['name' => $input['name'],'notes'=>$input['notes']]);
				$msg='thanks';
				return $this->getEditcategories($input['id_category'],$msg);
			}
			else
			{
			 //////// insert new category/////////////////////////
                $result=DB::select("SELECT id as c FROM expenditure_category where name='".$input['name']."' and user_id='".$user_id."'");
			     if($result==null)
                 {
                    DB::table('expenditure_category')->insert(['name' => $input['name'], 'notes' => $input['notes'],'user_id'=>$user_id]);
                    $result=DB::select("SELECT id as c FROM expenditure_category where name='".$input['name']."' and user_id='".$user_id."'");
                 }                 
             	$msg='thanks';
                $result  = json_decode(json_encode($result), true);
				return $this->getEditcategories($result[0]['c'],$msg);
			}
			
		}
	}
    public function postEdittansactions()
	{
		App::setLocale(Session::get('lang'));
		$input = Request::all();
        if(empty($input['id'])){$input['id']='new';}
		if(empty($input['qty']) || $input['qty']<1)
		{
			$msg='field_empty';
			return $this->getEdittransactions($input['id'],$msg);
		}
        elseif(empty($input['date_time']))
		{
			$msg='field_empty';
			return $this->getEdittransactions($input['id'],$msg);
		}
		else
		{
		    $user_id=DB::select("select id from users where username='".Session::get('username')."'");
    		$user_id  = json_decode(json_encode($user_id), true);
            $user_id=$user_id[0]['id'];
			if($input['id']!='new')
			{
                DB::table('expenditure')->where('id', $input['id'])->update(['to_from' => $input['to_from'],'date_time' => $input['date_time'],'qty' => $input['qty'],'notes'=>$input['notes'],'category' => $input['category']]);
				$msg='thanks';
				return $this->getEdittransactions($input['id'],$msg);
			}
			else
			{
			 //////// insert new expense/////////////////////////
                DB::table('expenditure')->insert(['to_from' => $input['to_from'],'qty' => $input['qty'],'date_time' => $input['date_time'],'category' => $input['category'],'user_id' => $user_id, 'notes' => $input['notes']]);
                $result=DB::select("SELECT id as c FROM expenditure where user_id='".$user_id."' order by id desc limit 1");
             	$msg='thanks';
                $result  = json_decode(json_encode($result), true);
				return $this->getEdittransactions($result[0]['c'],$msg);
			}
			
		}
	}
    public function getDeltransactions($id)
    {
        if(!empty($id))
        {
            DB::table('expenditure')->where('id', '=', $id)->delete();
            $msg='thanks';
            return $this->getEdittransactions('new',$msg);
        }
    }
}?>
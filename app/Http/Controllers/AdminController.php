<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use DB;
use BlogersController;

class AdminController extends Controller
{

	public function showLoginPage ()
	{
		return view('admin/AdminLogin');
	}
	
	public function showMainPage ()
	{
		return view('admin/AdminMainPage');
	}
	
	public function showRedactBlogerPage (Request $request)
	{
		$reqData  = $request->all();	
		$id       = $reqData['id'];
		
		$data = app('App\Http\Controllers\BlogersController')->getBlogerData($id);
 
		if (!$data) {
			return redirect()->route('AdminMain') 
				->with('error', 'Invalid Bloger ID');
		}

		return view('admin/AdminRedactBlogerPage',
			        compact('data'))
			 ->with('success', 'Correct ID');
	}
	
	public function authorization (Request $request)
	{
		$data = $request->all();	
	
		$login    = $data['login'   ];	
		$password = $data['password'];	


		$query = "SELECT * FROM admins
				  WHERE login = '$login'";


		$adminEntry = DB::select($query);
		// если таковой записи нет
		if(!$adminEntry){
			return redirect()->route('AdminLogin')
				->with('fail', 'Invalid login');	
		}

		// to array
		$adminEntry = array_map(function ($row) {
			return (array)$row;	
		}, $adminEntry);	

		// пароли не сошлись
		if ($adminEntry[0]['password'] != $password) {
			return redirect()->route('AdminLogin')
				->with('fail', 'Invalid password');		
		}	

		
		return view('admin/AdminMainPage')
			 ->with('success', 'Success login');
	}
 
}

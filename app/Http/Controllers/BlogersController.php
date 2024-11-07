<?php

namespace App\Http\Controllers;

use App\Models\Blogers;
use Illuminate\Http\Request;
use DB;


class BlogersController extends Controller
{
	// Показ профиля блогера
	public function showBlogerProfile($id)
	{		
		$data = $this->getBlogerData($id);		

		if (!$data) {
			return redirect()->route('Blogers')
				->with('error', 'Invalid Bloger ID');
		}	

		$dataSub = $this->getLastEntriesSubscribersDate($id, 10);

		return view('BlogerProfile',
		    compact('data'), compact('dataSub'))
		 	 ->with('success', 'Correct ID');	
	}

	// Рейтинг блогеров	
	public function showBlogers()
	{
		$currentDate = date('Y-m-d');

		$query = "SELECT (name,
						  date,
						  subscribers) 
				  FROM subscribers_date
				  INNER JOIN blogers
				  ON blogers.id = subscribers_date.bloger_id
				  WHERE subscribers_date.date = '$currentDate'
                  ORDER BY subscribers DESC";

		$queryResult = DB::select($query);

		if (!$query) { 
			$data = array();
		}	
	
		// Костыль жёсткий	
		$data = array_map( function($row) {
			// данные без скобочек	
			$bracketData = substr(((array)$row)['row'], 1, -1);
			// получение массива из строки	
			$arrRow = explode(',', $bracketData);
			
			return $arrRow;	
		
		}, $queryResult);
	
		return view('BlogersMainPage', 
	        compact('data'))
			 ->with('success', 'success');	
	}

	public function blogerCreate(Request $request)
	{
		$data = $request->all();

		$name        = $data['name'];
		$description = $data['description'];
		$link        = $data['link'];

		$query = "INSERT INTO blogers(name,
									  description,
									  link)
                  VALUES (?, ?, ?)"; 

		$queryResult =  DB::insert($query, [$name, $description, $link]);	

		// бд не отвечает
		if (!$queryResult) {
			return redirect()->route('AdminMain')
				->with('error', 'Server Error');
		}
	
		// всё прошло успешно
		return redirect()->route('AdminMain')
	             ->with('success', 'Successfull create new bloger'); 		
	}

	public function addSubscribers(Request $request)
	{
		$data = $request->all();

		$blogerId   = $data['id'   ];
		$addDate    = $data['date' ];
		$countSubs  = $data['value'];

		$query = "INSERT INTO subscribers_date(bloger_id,
											   date,
											   subscribers)
				  VALUES (?, ?, ?)";

		$queryResult = DB::insert($query, [$blogerId, $addDate, $countSubs]); 	
		
		// бд не отвечает
		if (!$queryResult) {
			return redirect()->route('AdminMain')
				->with('error', 'Server Error');
		}

		// всё прошло успешно
		return redirect()->route('AdminMain')
	             ->with('success', 'Successfull subcribers added'); 		
	}


	public function redactBloger(Request $request)
	{
		$data = $request->all();	
		
		$blogerId    = $data['id'         ];
		$name        = $data['name'       ];
		$description = $data['description'];
		$link        = $data['link'       ];

		$query = "UPDATE blogers
				  SET   name        = '$name',
                        description = '$description',
					    link        = '$link'
                  WHERE id          =  $blogerId";
				  
		$queryResult = DB::statement($query);		
		
		if (!$queryResult) {
			return redirect()->route('AdminRedact')
			         ->with('error', 'Server error');	
		}	
		
		return redirect()->route('AdminMain')
			     ->with('success', 'Success update bloger');
	}

	// Данные блогера
	public function getBlogerData($id)
	{		
		$query = "SELECT * FROM blogers WHERE id = '$id'";	
		$queryResult = DB::select($query);

		if (!$queryResult) {
			return false;
		}

		$data = array_map( function($row) {
			return (array)$row;	
		} , $queryResult)[0]; 

		return $data;
	}
	
	// Последние подписки по дням
	public function getLastEntriesSubscribersDate($id, $n)
	{
		
		$query = "SELECT * FROM subscribers_date
				  WHERE bloger_id = $id
				  ORDER BY subscribers DESC
				  LIMIT $n";

		$queryResult = DB::select($query);

		if (!$queryResult) {
			return false;
		}

		$data = array_map( function($row) {
			return (array)$row;	
		}, $queryResult);

		return $data;
	}

}

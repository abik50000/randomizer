<?php 

namespace App\Controllers;

use App\Models\Number;
use App\Core\Controller;

class NumberController extends Controller
{
	public function create()
	{	
		$id = Number::create();
		response(201, "Number created", Number::find($id));
	}

	public function all()
	{
		$numbers = Number::all();
		return response(200, 'All Numbers Fetched: ' . count($numbers), $numbers);
	}

	public function clear()
	{
		Number::truncate();
		return response(200, 'All Numbers deleted');
	}

	public function find($id)
	{
		$number = Number::find($id);

		return count($number) > 0
			? response(200, 'Number Found', $number)
			: response(404, 'Number Not Found');
	}
}
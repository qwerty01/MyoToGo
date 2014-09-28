<?php

class FunctionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$queue = FuncQueue::where('user_id', Auth::user()->id)->get();
		return Response::json(array(
				'error' => false,
				'queue' => $queue->toArray()),
			200);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return Response::make("<h1>400: Bad Request</h1>", 400);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(!Request::isJson())
			return Response::make("<h1>400: Bad Request</h1>", 400);
		else if(!Input::has('function'))
			return Response::json(array('error'=>true,'message'=>'Missing Function'));
		else if(Input::get('function') < 0 || Input::get('function') > 1)
			return Response::json(array('error'=>true,'message'=>'Function invalid'));
		else
		{
			$que = new FuncQueue;
			$que->user_id = Auth::user()->id;
			$que->function = (int)Input::get('function');
			$que->save();
			return Response::json(array('error'=>false,'message'=>"Successfuly added"));
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if($id == "pop")
		{
			$funct = FuncQueue::where('user_id', Auth::user()->id)->first();
			if(is_null($funct))
				return Response::json(array('error'=>true,"message"=>"Queue empty"));
			else
			{
				$funct->delete();
				return Response::json(array('error'=>false,"message"=>"Success","id"=>$funct->id,"function"=>$funct->function));
			}
		}
		else
		{
			$funct = FuncQueue::where('user_id', Auth::user()->id)->find($id);
			if(is_null($funct))
				return Response::json(array('error'=>true,"message"=>"ID '".$id."' does not exist."));
			else
				return Response::json(array('error'=>false,'message'=>'Success','function'=>$funct->function));
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return Response::make("<h1>400: Bad Request</h1>", 400);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return Response::make("<h1>400: Bad Request</h1>", 400);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$funct = FuncQueue::where('user_id', Auth::user()->id)->find($id);
		if(!Request::isJson())
			return Response::make("<h1>400: Bad Request</h1>", 400);
		else if(is_null($funct))
			return Response::json(array('error'=>true,"message"=>"ID '".$id."' does not exist"));
		else
		{
			$funct->delete();
			return Response::json(array('error'=>false,"message"=>"Deleted ID '".$id."'"));
		}
	}
}

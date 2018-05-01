<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageListsController extends Controller
{
	public function __construct()
	{
		//Use middleware to confirm the logged in user is the one accessing /username/manage-lists routes.
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
	// 	//return view of all lists
	// 	$loadOrders = \App\LoadOrder::where('user_id', \Auth::user()->id)->orderBy('updated_at', 'desc')->get();

	// 	for($i = 0; $i < count($loadOrders); $i++)
	// 	{	
	// 		if(strlen($loadOrders[$i]->description) > 150){
	// 			$string = $loadOrders[$i]->description;
	// 			$loadOrders[$i]->description = str_split($string, 150)[0] . '...';
	// 		}
	// 	}

	// 	return view('user/manage-lists-index')
	// 		->with('loadOrders', $loadOrders)	;
    // }

    /**	
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

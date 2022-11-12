<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\SubjectModel;
use DB;

class SubjectController extends Controller
{

	function insert_subject(Request $request)
	{



		$this->validate($request,[
			'subject'=>'required',
			'description'=> 'required',
			'time'=> 'required',
			'schedule'=> 'required',           
		]);


		$subject= new SubjectModel;
		$subject->title = $request->input('subject');
		$subject->description = $request->input('description');
		$subject->time=$request->input('time');
		$subject->schedule=$request->input('schedule');         


		$subject->save();
		return redirect('/main/subjects')->with('completed', 'success');
	}



	function update(Request $request)
	{
		// echo $request;

		$id=$request->input('update-id');
		$title = $request->input('update-subject');
		$description = $request->input('update-description');
		$time=$request->input('update-time');
		$schedule=$request->input('update-schedule');

		DB::update('update subjects set title =?,description=?,time=?,schedule=? where id = ?',[$title,$description,$time,$schedule,$id]);
        // echo "Record updated successfully.<br/>";
		return redirect('/main/subjects');

	}


	public function destroy($id)
	{

		DB::table('subjects')->where('id', $id)->delete();
        // echo ('student '.$student_id." has deleted");
		return redirect('/main/subjects')->with('completed', 'Record has been deleted');

	}
}

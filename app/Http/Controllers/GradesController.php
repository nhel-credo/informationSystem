<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\models\GradesModel;
use DB;

class GradesController extends Controller
{


	function get_student()
	{
		$student = DB::select('select * from students');
		return view('/main/students',['student'=>$student]);
	}


	function insert_selected_subjects(Request $request)
	{
		$id = $request->id;
		$arr = $request->arr;

		for ($i=0; $i < sizeof($arr) ; $i++) { 
    		// echo $arr[$i];

			$table=new GradesModel;
			$table->student_id=$id;
			$table->subject_id=$arr[$i];
			$table->prelim="N/A";
			$table->midterm="N/A";
			$table->semi_final="N/A";
			$table->final="N/A";
			$table->save();

		}
	}

	function populate_grades_bysubject($request)
	{
    		// dd($request);

		$id = $request;
    		// echo $id;


		$grades = DB::select('SELECT subjects.title,subjects.description,subjects.time,subjects.schedule,selected_subjects.id,selected_subjects.prelim,selected_subjects.midterm,selected_subjects.semi_final,selected_subjects.final,students.firstname,students.lastname,students.year_level,students.course FROM `selected_subjects` INNER JOIN subjects ON subjects.id=selected_subjects.subject_id INNER JOIN students ON students.id=selected_subjects.student_id WHERE selected_subjects.student_id=?',[$id]);


		if ($grades) {

			return view('/grade_inputs',['grades'=>$grades]);
		}else{
			

			echo "<center><label class='text-center'>No Subjects Available</label></center>";
			echo"<a href="."javascript:history.back()".">Go Back</a>";
			// return redirect()->to('/main/gradings');
		}
    		// dd($grades->'firstname');


	}

	function update_grades(Request $request)
	{
		$id= $request->input('hidden-id');
		$prelim=$request->input('prelim');
		$midterm=$request->input('midterm');
		$semi=$request->input('semi-final');
		$final=$request->input('final');

			DB::update('update selected_subjects set prelim =?,midterm=?,semi_final=?,final=? where id = ?',[$prelim,$midterm,$semi,$final,$id]);

    // echo "updated";
			echo "<center><label class='text-center'>Successfull!</label></center>";
  
  echo"<a href="."javascript:history.back()".">Go Back</a>";
  

		// dd($request);
	}









}

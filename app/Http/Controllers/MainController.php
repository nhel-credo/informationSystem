<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\models\student;
use App\models\teacherModel;
use App\models\SubjectModel;
use App\models\User;
use App\models\GradesModel;
use DB;

class MainController extends Controller
{
    function index()
    {
    	return view('login');
    }


    function checklogin(Request $request)
    {
     $this->validate($request, [
      'email'   => 'required',
      'password'  => 'required'
     ]);

     $user_data = array(
      'email'  => $request->get('email'),
      'password' => $request->get('password')
     );

     if(Auth::attempt($user_data))
     {
       // dd($user_data);
      return redirect('main/dashboard');
     }
     else
     {
      return back()->with('error', 'Wrong Login Details');
     }

    }

     function successlogin()
    {
     return view('dashboard');
    }

    function logout()
    {
     Auth::logout();
     return redirect('main');
    }


  function count_student()
    {
        $counter = DB::table('students')->count();
    return $counter;
    }

     function count_teacher()
    {
        $counter = DB::table('teachers')->count();
    return $counter;
    }

      function count_user()
    {
        $counter = DB::table('users')->count();
    return $counter;
    }

      function count_subject()
    {
        $counter = DB::table('subjects')->count();
    return $counter;
    }






    function dashboard()
    {
        $student_count=$this->count_student();
        $subject_count=$this->count_subject();
        $teacher_count=$this->count_teacher();
        $user_count=$this->count_user();

     return view('dashboard',compact('student_count','subject_count','teacher_count','user_count'));
    }



    function students()
    {
        $student = Student::all();
        return view('/students', compact('student'));
    }

    function teachers()
    {
        $teacher= teacherModel::all();
        return view('/teacher',compact('teacher'));
    }

    function subjects()
    {
        $subjects= SubjectModel::all();
        return view('/subject',compact('subjects'));
    }

    function users()
    {
        $user=User::all();
        return view('/users',compact('user'));
        // echo $users;
    }

    function homepage()
    {
        return view('homepage');
    }

    function gradings()
    {
       $student = Student::all();      
       $subjects= SubjectModel::all();

       // dd($grades);
        return view('/grades', compact('student','subjects'));
    }

}

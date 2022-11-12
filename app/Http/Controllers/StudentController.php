<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Student;
use DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index()
    {
        $student = Student::all();
        return view('/students', compact('student'));
    }
    
    function get_student()
    {
        $student = DB::select('select * from students');
        return view('/main/students',['student'=>$student]);
    }

    function show_studentbyid($id)
    {
        $student = Student::find($id);  
        // dd($student);
        // return response()->json($student);
    }

    function store(Request $request)
    {
        $this->validate($request,[
            'firstname'=>'required',
            'lastname'=> 'required',
            'email'=> 'required',
            'phone'=> 'required',
            'address'=>'required',
            'gender'=>'required',
            'birthdate'=>'required',
            'yearlevel'=>'required',
            'course'=>'required',

        ]);

        $student= new Student;
        $student->firstname = $request->input('firstname');
        $student->lastname = $request->input('lastname');
        $student->email = $request->input('email');
        $student->phone = $request->input('phone');
        $student->address=$request->input('address');
        $student->gender=$request->input('gender');
        $student->birthdate=$request->input('birthdate');
        $student->course=$request->input('course');
        $student->year_level=$request->input('yearlevel');

 // dd($student);
        $student->save();

        return redirect('/main/students')->with('success','data saved!');


    }

    public function create()
    {
        return view('create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    // inserting data from modal to database
    public function store_student(Request $request)
    {
        $storeData = $request->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|numeric',
            
        ]);
        $student = Student::create($storeData);
        return redirect('/student')->with('completed', 'Student has been saved!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('edit', compact('student'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    
    public function update(Request $request)
    {

        $id=$request->input('update-id');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address=$request->input('address');
        $gender=$request->input('gender');
        $birthdate=$request->input('birthdate');
        $course=$request->input('course');
        $year_level=$request->input('yearlevel');

        DB::update('update students set firstname =?,lastname=?,email=?,phone=?,address=?,gender=?,birthdate=?,course=?,year_level=? where id = ?',[$firstname,$lastname,$email,$phone,$address,$gender,$birthdate,$course,$year_level,$id]);
        // echo "Record updated successfully.<br/>";
        return redirect('/main/students');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($student_id)
    {
        
        DB::table('students')->where('id', $student_id)->delete();
        // echo ('student '.$student_id." has deleted");
        return redirect('/main/students')->with('completed', 'Student has been deleted');
          
    }




}
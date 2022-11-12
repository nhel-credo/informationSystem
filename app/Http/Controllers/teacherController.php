<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\teacherModel;
use DB;
class teacherController extends Controller
{






    function insert_teacher(Request $request)
    {
        $this->validate($request,[
            'firstname'=>'required',
            'lastname'=> 'required',
            'address'=> 'required',
            'phone'=> 'required',
            'birthdate'=> 'required',
            'gender'=> 'required',
            'email'=>'required',
        ]);

        $teacher= new teacherModel;
        $teacher->firstname = $request->input('firstname');
        $teacher->lastname = $request->input('lastname');
        $teacher->address=$request->input('address');
        $teacher->gender=$request->input('gender');
        $teacher->phone=$request->input('phone');
        $teacher->email=$request->input('email');
        $teacher->birthdate=$request->input('birthdate');    

 // dd($teacher);
        $teacher->save();
        return redirect('/main/teachers');

    }



     function update(Request $request)
    {

        $id=$request->input('update-id');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address=$request->input('address');
        $gender=$request->input('gender');
        $birthdate=$request->input('birthdate');

        DB::update('update teachers set firstname =?,lastname=?,email=?,phone=?,address=?,gender=?,birthdate=? where id = ?',[$firstname,$lastname,$email,$phone,$address,$gender,$birthdate,$id]);
        // echo "Record updated successfully.<br/>";
        return redirect('/main/teachers');

    }


    public function destroy($teacher_id)
    {
        
        DB::table('teachers')->where('id', $teacher_id)->delete();
        // echo ('student '.$student_id." has deleted");
        return redirect('/main/teachers')->with('completed', 'Record has been deleted');
          
    }

}

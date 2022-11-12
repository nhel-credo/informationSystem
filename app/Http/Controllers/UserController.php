<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use DB;

class UserController extends Controller
{
   


	function insert(Request $request)
	{



		$this->validate($request,[
			'name'=>'required',
			'email'=> 'required',
			'password'=> 'required',
			           
		]);


		// $user= new User;
		// $user->name = $request->input('name');
		// $user->email = $request->input('email');
		// $user->password=$request->input('password');
		$password=$request->input('password');

		 DB::table('users')->insert([
            'name' =>$request->input('name'),
            'email' =>$request->input('email'),
            'password' =>bcrypt($password),            
        ]);         

		 // echo bcrypt($password);
		
		return redirect('/main/users')->with('completed', 'success');
	}



	function update(Request $request)
	{
		// echo $request;

		$id=$request->input('update-id');
		$name = $request->input('update-name');
		$email = $request->input('update-email');
		$password=bcrypt($request->input('update-password'));


		DB::update('update users set name =?,email=?,password=? where id = ?',[$name,$email,$password,$id]);
        // echo "Record updated successfully.<br/>";
		return redirect('/main/users');

	}


	public function destroy($id)
	{
		

		DB::table('users')->where('id', $id)->delete();
        // echo ('student '.$student_id." has deleted");
		return redirect('/main/users')->with('completed', 'Record has been deleted');

	}


}

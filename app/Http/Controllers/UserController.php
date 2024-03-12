<?php

namespace App\Http\Controllers;

use App\Models\MajorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Models\RoleModel;

class UserController extends Controller
{
    public function importExcel(){
        return view('import_excel');
    }
    public function saveImportedExcel(Request $request){
        $file = $request->file('file')->store('import');
        //dd($file);
        //Excel::import(new UsersImport, $request->file);
        $import = new UsersImport;
        $import->import($file);
        return redirect('/user-list');
        //return back()->withStatus('successfully');
    }
    public function insertUser(Request $request){
        $user = new UserModel();
        $user->user_student_id = request('user_student_id');
        $user->user_fname = request('user_fname');
        $user->user_lname = request('user_lname');
        $user->user_email = request('user_email');
        $user->user_password = Hash::make(request('user_password'));
        $user->user_role_id = (int)$request->input('user_role_id');
        $user->user_profile_image = "test";
        $user->user_major_id = (int)$request->input('user_major_id');
        $user->save();
        return redirect('user-list');
    }
    public function showUserList(){
        $user_data = UserModel::paginate(5);
        $major_data = MajorModel::all();
        $role_data = RoleModel::all();
        return view('user_list',['oe_users'=>$user_data, 'oe_majors'=>$major_data, 'oe_roles'=>$role_data]);
    }
    public function deleteUser($user_id){
        $user = UserModel::find($user_id);
        $user->delete();
        return Redirect::back();
    }
    public function editUser($user_id){
        $user_data = UserModel::find($user_id);
        $major_data = MajorModel::all();
        $role_data = RoleModel::all();
        return view('edit_user',['oe_users'=>$user_data, 'oe_majors'=>$major_data, 'oe_roles'=>$role_data]);
    }
    public function updateUser(Request $request){
        $user = UserModel::find(request('user_id'));
        $user->user_student_id = request('user_student_id');
        $user->user_fname = request('user_fname');
        $user->user_lname = request('user_lname');
        $user->user_email = request('user_email');
        $password = request('password');
        if($password!= null){
            $user->user_password = Hash::make(request('user_password'));
        }
        $user->user_role_id = (int)$request->input('user_role_id');
        $user->user_profile_image = "test";
        $user->user_major_id = (int)$request->input('user_major_id');
        $user->save();
        return redirect('/user-list');
    }
    public function searchUser(Request $request){
        $search_data = $request->input('search_user');
        $user_data = UserModel::where('user_student_id','LIKE','%'.$search_data.'%')
        ->orWhere('user_fname','LIKE','%'.$search_data.'%')
        ->orWhere('user_lname','LIKE','%'.$search_data.'%')
        ->paginate(5);
        if(!$user_data || !$user_data->count()){
            return redirect('/user-list');
        }
        $major_data = MajorModel::all();
        $role_data = RoleModel::all();
        return view('user_list',['oe_users'=>$user_data, 'oe_majors'=>$major_data, 'oe_roles'=>$role_data]);
    }
    public function showUserProfile($user_id){
        $user_data = UserModel::find($user_id);
        $major_data = MajorModel::all();
        $role_data = RoleModel::all();
        return view('user_profile2',['oe_users'=>$user_data, 'oe_majors'=>$major_data, 'oe_roles'=>$role_data]);
    }
    /*
    public function updateUserDetail($user_id, $Detail_name, Request $request){
        $user = UserModel::find($user_id);
        if($Detail_name == "fname"){
            $user->user_fname = request('user_fname');
        }elseif($Detail_name == 'lname'){
            $user->user_lname = request('user_lname');
        }elseif($Detail_name == 'student-id'){
            $user->user_student_id = request('user_student_id');
        }elseif($Detail_name == 'major'){
            $user->user_major_id = (int)$request->input('user_major_id');
        }elseif($Detail_name == 'email'){
            $user->user_email = request('user_email');
        }elseif($Detail_name == 'phone'){
            $user->user_phone = request('user_phone');
        }
        $user->save();
        return redirect('/user-profile/'.$user_id);
    }
    */
    public function updateUserDetail($user_id, Request $request){
        $user = UserModel::find($user_id);
        $user->user_fname = request('user_fname');
        $user->user_lname = request('user_lname');
        $user->user_student_id = request('user_student_id');
        $user->user_major_id = (int)$request->input('user_major_id');
        $user->user_email = request('user_email');
        $user->user_phone = request('user_phone');
        $user->save();
        return redirect('/user-profile/'.$user_id);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Role_user;
use App\Ptj;
use App\Bahagian;
use App\Jawatan;
use App\Gred;
use Gate;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::all();
        $ptj = Ptj::orderBy('ptj','asc')->get();
        $jawatan = Jawatan::orderBy('jawatan','asc')->get();

        
        $roles = Role::orderBy('name','asc')->get();

        $users = User::select('users.*', 'ptj.ptj','jawatan.jawatan as nama_jawatan')
                    ->leftjoin('ptj', 'ptj.id', '=', 'users.ptj_id')
                    ->leftjoin('jawatan', 'jawatan.id', '=', 'users.jawatan_id')
                    ->orderBy('users.name','asc')
                    ->paginate(25);

        return view('admin.users.index', [
            'users' => $users,
            'ptj' => $ptj,
            'jawatan' => $jawatan,
            'roles' => $roles,
        ])
        ->with('fusername')
        ->with('fptj_id')
        ->with('fname')
        ->with('frole_id')
        ->with('fjawatan_id')
        ->with('fno_telefon');
    
    }

    public function password()
    {
        //$users = User::all();
        //$users = User::orderBy('name','asc')->get();
        $users = DB::table('users')
            ->select('users.*')
            ->paginate(25);
        return view('admin.users.password')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  if(Gate::denies('edit-users')){
        //     return redirect(route('admin.users.index'));
        // }

        $id = Auth::id();

        $ptj = Ptj::orderBy('ptj','asc')->get();
        $jawatan = Jawatan::orderBy('jawatan','asc')->get();
        $roles = Role::all();

        return view('admin.users.create')->with([
            'ptj' => $ptj,
            'jawatan' => $jawatan,
            'roles' => $roles,
        ]);
    }


    public function getRoles($user_id) 
    {
        $role = Role_user::where('user_id',$user_id)
                ->leftjoin('roles', 'roles.id', '=', 'Role_user.role_id')
                ->pluck("roles.role_id");

        return json_encode($role);
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
          'email' => 'required|email',
          'name' => 'required',
          'password' => 'required|string|confirmed',
          'password_confirmation' => 'required',
        
        ]);

        $roles = request('roles');

        $user = User::create([
            'username' => request('username'),
            'name' => request('name'),
            'ptj_id' => request('ptj_id'),
            'email' => request('email'),
            'password' => Hash::make(request('password'))
        ]);
        

        $ptj = PTJ::select('id')->where('id',request('ptj_id'))->first();

        $user->roles()->attach($roles);
        
        $user->save();

        return redirect()->route('admin.users.index');
    }


    public function edit(User $user)
    {

        $ids =Auth::id();

        $role_user = Auth::user()->roles;

        foreach ($role_user as $key => $row) {
             if ($row->name == 'User' && $ids <> $user->id) {
                return redirect('/admin/users/'.$ids.'/edit/');
             }
        }
       
        if ($user->id==1 && $ids<>1) {  //administrator
            return redirect()->route('admin.users.index');
        } 

        $user = User::findOrFail($user->id);
        
        $ptj = Ptj::orderBy('ptj', 'asc')->get();
        $bahagian = Bahagian::orderBy('bahagian', 'asc')
            ->where('ptj_id',$user->ptj_id)
            ->get();

        $jawatan = Jawatan::orderBy('jawatan', 'asc')->get();
        $gred = gred::orderBy('gred', 'asc')->get();

        //$user = User::findOrFail($id);


        //$roles = Role::findOrFail($id);
        $roles = Role::all();

         return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles,
            'ptj' => $ptj,
            'bahagian' => $bahagian,
            'jawatan' => $jawatan,
            'gred' => $gred,
        ]);
    }

     public function edit_password(User $id)
    {
        if(Gate::denies('edit-users')){
            return redirect(route('admin.users.password'));
        }

        $roles = Role::all();

        return view('admin.users.edit_password')->with([
            'user' => $id,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, User $user)
    {
       /* $user= new User();*/
        $user->id = $request->id;
        $user->username = $request->username;
        $user->name = $request->name;
        $user->ptj_id = $request->ptj_id;
        $user->bahagian_id = $request->bahagian_id;
        $user->jawatan_id = $request->jawatan_id;
        $user->gred_id = $request->gred_id;
        $user->no_telefon = $request->no_telefon;
        $user->email = $request->email;

        $user->roles()->sync($request->roles);

        $new_password = $request->new_password;
        $confirm_new_password = $request->confirm_new_password;

        if ($new_password<>NULL) {
            if (strcmp($new_password, $confirm_new_password) <> 0) {
                return back()->with('error','Your new password does not match with confirm new password');
            }

            $user->password = bcrypt($new_password);
        }

        $user_role = Role_user::where('user_id',$user->id)
                ->leftjoin('users', 'users.id', '=', 'Role_user.user_id')
                ->first();

        if($user->save()){
            $request->session()->flash('success', $user->name . ' has been updated');
        }
        else{
            $request->session()->flash('success', 'There was an error updating the user');
        }


        if ($user_role->role_id=='3') {
            return redirect('/admin/users/'.$user->id.'/edit/'); // code...
        } else {
            return redirect()->route('admin.users.index');
        }
    }

    public function update_password(Request $request)
    {

        $request->validate([
          'password' => 'required|string|confirmed',
          'password_confirmation' => 'required',
        
        ]);

        //$user->roles()->sync($request->roles);

        /*$user->name = $request->name;
        $user->email = $request->email;

        $user->password = Hash::make($request->password);

               
        if($user->save()){
            $request->session()->flash('success', $user->name . ' has been updated');
        }
        else{
            $request->session()->flash('success', 'There was an error updating the user');
        }
*/

         $users=DB::table('users')
            ->where('id',$request->id)
            ->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password' =>  Hash::make($request->password)
                ]);
        //return redirect('/admin/users/password'.$id.'/')->with('success','Maklumat berjaya dikemaskini.');

        

        return redirect()->route('admin.users.password');
    }

    public function search(){

        $id = Auth::id();

        //$user = User::orderBy('name', 'asc')->get();

        $ptj = ptj::orderBy('ptj','asc')->get();
        $roles = Role::orderBy('name','asc')->get();
        $jawatan = Jawatan::orderBy('jawatan','asc')->get();

        $username = request('username');
        $ptj_id = request('ptj_id');
        $name = request('name');
        $role_id = request('role_id');
        $jawatan_id = request('jawatan_id');
        $no_telefon = request('no_telefon');

        $users = User::select('users.*','jawatan.jawatan as nama_jawatan', 'ptj.ptj')
                    ->leftjoin('ptj', 'ptj.id', '=', 'users.ptj_id')
                    ->leftjoin('jawatan', 'jawatan.id', '=', 'users.jawatan_id')
                    ->leftjoin('role_user', 'role_user.user_id', '=', 'users.id')
                    ->where('users.name','like', '%'.$name.'%')
                    ->where('users.username','like','%'.$username.'%')
                    ->where('users.ptj_id', 'like', '%' . $ptj_id . '%')
                    ->where('users.jawatan_id', 'like', '%' . $jawatan_id . '%')
                    ->where('users.no_telefon', 'like', '%' . $no_telefon . '%')
                    ->where('role_user.role_id', 'like', '%' . $role_id . '%')
                    ->orderBy('role_user.role_id','asc')
                    ->orderBy('ptj.ptj','asc')
                    ->orderBy('users.name','asc')
                    ->paginate(25);

        return view('admin.users.index', [
            'users' => $users,
            'ptj' => $ptj,
            'jawatan' => $jawatan,
            'roles' => $roles,
            
        ])
        ->with('fusername', $username)
        ->with('fptj_id' , $ptj_id)
        ->with('fname' , $name)
        ->with('frole_id' , $role_id)
        ->with('fjawatan_id' , $jawatan_id)
        ->with('fno_telefon' , $no_telefon);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::denies('delete-users')){
            return redirect(route('admin.users.index'));
        }

        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.users.index');
    }

}

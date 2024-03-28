<?php

namespace App\Providers;
/*namespace App\Http\Controllers;*/

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use DB;
use App\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-users', function($user){
            return $user->hasAnyRoles(
                ['Admin','Penyelaras']

            );
        });

        Gate::define('admin-menu', function($user){
            return $user->hasRoles('Admin');
        });

        Gate::define('user-menu', function($user){
            return $user->hasRoles('User');
        });

        Gate::define('edit-records', function($user){
            return $user->hasAnyRoles(['Admin','Penyelaras']);
        });

        Gate::define('delete-records', function($user){
            return $user->hasRoles('Admin');
        });
    
        
        //pengguna
         Gate::define('view-pengguna', function($user){

            $peranan = [];

            $roles = DB::table('roles')->select('*')->where('view_pengguna',1)->get();

            foreach ($roles as $role) {
                array_push($peranan, $role->name);
            }
             return $user->hasAnyRoles($peranan);
        });


        Gate::define('add-pengguna', function($user){

            $peranan = [];

            $roles = DB::table('roles')                 
                        ->select('*')         
                        ->where('add_pengguna',1)
                        ->get();

            foreach ($roles as $role) {
                array_push($peranan, $role->name);
            }

            return $user->hasAnyRoles($peranan);
        });

        Gate::define('edit-penggunas', function($user){

            $peranan = [];

            $roles = DB::table('roles')
                    
                        ->select('*')         
                        ->where('edit_pengguna',1)
                        ->get();


        foreach ($roles as $role) {
            array_push($peranan, $role->name);
         
        }

            return $user->hasAnyRoles($peranan);
        });

        Gate::define('delete-pengguna', function($user){

            $peranan = [];

            $roles = DB::table('roles')
                    
                        ->select('*')         
                        ->where('delete_pengguna',1)
                        ->get();


        foreach ($roles as $role) {
            array_push($peranan, $role->name);
         
        }

            return $user->hasAnyRoles($peranan);
        });

        //pegawai
        $role_pegawai = ['add_pegawai','edit_pegawai','delete_pegawai', 'view-pegawai'];

        Gate::define('view-pegawai', function($user){
            $peranan = [];
            $roles = DB::table('roles')
                        ->select('*')         
                        ->where('view_pegawai',1)
                        ->get();


            foreach ($roles as $role) {
                array_push($peranan, $role->name);
             
            }

            return $user->hasAnyRoles($peranan);
        });

        Gate::define('add-pegawai', function($user){

            $peranan = [];

            $roles = DB::table('roles')
                        ->select('*')         
                        ->where('add_pegawai',1)
                        ->get();


            foreach ($roles as $role) {
                array_push($peranan, $role->name);
             
            }

            return $user->hasAnyRoles($peranan);
        });

        Gate::define('edit-pegawai', function($user){

            $peranan = [];

            $roles = DB::table('roles')
                    
                        ->select('*')         
                        ->where('edit_pegawai',1)
                        ->get();


            foreach ($roles as $role) {
                array_push($peranan, $role->name);
             
            }

            return $user->hasAnyRoles($peranan);
        });

        Gate::define('delete-pegawai', function($user){

            $peranan = [];

            $roles = DB::table('roles')
                    
                        ->select('*')         
                        ->where('delete_pegawai',1)
                        ->get();


            foreach ($roles as $role) {
                array_push($peranan, $role->name);
             
            }

            return $user->hasAnyRoles($peranan);
        });

        //penyelaras
        Gate::define('view-penyelaras', function($user){

            $peranan = [];

            $roles = DB::table('roles')
                    
                        ->select('*')         
                        ->where('view_penyelaras',1)
                        ->get();


            foreach ($roles as $role) {
                array_push($peranan, $role->name);
             
            }

            return $user->hasAnyRoles($peranan);
        });

        Gate::define('add-penyelaras', function($user){

            $peranan = [];

            $roles = DB::table('roles')
                    
                        ->select('*')         
                        ->where('add_penyelaras',1)
                        ->get();


            foreach ($roles as $role) {
                array_push($peranan, $role->name);
             
            }

            return $user->hasAnyRoles($peranan);
        });

        Gate::define('edit-penyelaras', function($user){

            $peranan = [];

            $roles = DB::table('roles')
                    
                        ->select('*')         
                        ->where('edit_penyelaras',1)
                        ->get();


            foreach ($roles as $role) {
                array_push($peranan, $role->name);
             
            }

            return $user->hasAnyRoles($peranan);
        });

        Gate::define('delete-penyelaras', function($user){

            $peranan = [];

            $roles = DB::table('roles')
                    
                        ->select('*')         
                        ->where('delete_penyelaras',1)
                        ->get();


            foreach ($roles as $role) {
                array_push($peranan, $role->name);
             
            }

            return $user->hasAnyRoles($peranan);
        });



    }
}


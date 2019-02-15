<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }



    public function setpermission($modelo, $usuario){

        $permissions = [
            'write '.$modelo, 
            'read '.$modelo, 
            'delete '.$modelo
        ];

        $usuario = User::find($usuario);
        /*//criando permissão 
        foreach($permissions as $permission){
            Permission::create(['name' => $permission]);
        }*/

        //dando permissão ao usuario1
        foreach($permissions as $permission){
            $usuario->givePermissionTo($permission);
        }
        

        //obtendo todas as permissões do usuario;

        $permissoes = $usuario->getAllPermissions();
        dd($permissoes);


        /*$permission = Permission::create(['name' => 'edit articles']);
        return $permission;*/
    }

    public function revokepermission($modelo, $usuario){
        $usuario = User::find($usuario);
        //criando permissão 
        //$permission = Permission::create(['name' => 'edit '.$modelo]);
        //dando permissão ao usuario
        $permissoes = $usuario->revokePermissionTo($permission);
        //obtendo todas as permissões do usuario;

        $permissoes = $usuario->getAllPermissions();
        dd($permissoes);
    }


}

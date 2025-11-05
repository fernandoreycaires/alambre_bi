<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Avatar;
use App\Models\Perfil;
use App\Models\PerfilCatalogo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function listaUsers()
    {

        $usuarios = User::all()->sortBy('name');
        $permissoes = Perfil::where('id_user', Auth::user()->id)->with('perfil_catalogo')->get();


        return view('web/administracao/usuarios/usuarios', [
            'usuarios' => $usuarios,
            'permissoes' => $permissoes,
        ]);
    }

    public function theme(Request $request, User $id)
    {
       
        $id->theme_body = $request->theme_body;
        $id->theme_navbar = $request->theme_navbar;
        $id->save();

        return redirect()->route("dashboard") ;
    }

    public function addUsuarios(Request $request)
    {
        // dd($request);
        // User::create([
        //     'name' => $request->nome,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'status' => 'Ativo'
        // ]);

        $user = new User();
        $user->name = $request->nome;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = 'Ativo';
        $user->save();

        return redirect()->route("usuarios") ;
    }

    public function editUsuarios(Request $request, User $id)
    {
        $id->name = $request->nome;
        $id->email = $request->email;
        if ($request->password != "") {
            $id->password = Hash::make($request->password);
        }
        if ($request->avatar_select != "" && $request->avatar_select == "on" || $request->avatar_select == "") {
            $id->profile_photo_path = $id->profile_photo_path;
        }else {
            $id->profile_photo_path = $request->avatar_select;
        }
                
        $id->save();

        return redirect()->route("usuarios") ;
    }

    public function editStatusUsuarios(Request $request, User $id)
    {
        
        $id->status = $request->status;
                
        $id->save();

        return redirect()->route("usuarios") ;
    }

    public function deleteUsuarios(User $id)
    {
        $id->delete();

        return redirect()->route("usuarios");
    }

    public function usuariosPerfil(User $id)
    {
        $perfis = Perfil::where('id_user', $id->id)->with('perfil_catalogo')->get();
        $catalogo = PerfilCatalogo::all();
        $permissoes = Perfil::where('id_user', Auth::user()->id)->with('perfil_catalogo')->get();
        $avatares = Avatar::all();


        return view('web/administracao/usuarios/usuariosPerfil', [
            'usuario' => $id,
            'catalogo' => $catalogo,
            'perfis' => $perfis,
            'permissoes' => $permissoes,
            'avatares' => $avatares,
        ]);
    }

    public function addPerfil(User $id, Request $request)
    {
        $perfil = new Perfil();
        $perfil->id_catalogo =  $request->perfil;
        $perfil->id_user =  $id->id;
        $perfil->save();

        return redirect()->route('usuariosPerfil', [
            'id' => $id,
        ]);
    }

    public function delPerfil(User $id, Request $request)
    {
        $perfil = Perfil::where('id', $request->perfil)->first();
        $perfil->delete();

        return redirect()->route('usuariosPerfil', [
            'id' => $id,
        ]);
    }
    
}

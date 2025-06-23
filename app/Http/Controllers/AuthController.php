<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        //form validation (duas maneiras: paipe | e array [])
        $request->validate(
            //rules
            [
                'cpf' => 'required',
                'senha' => 'required',
            ],
            //error messages
            [
                'cpf.required' => ' O CPF obrigatório!',
                'senha.required' => 'A senha é obrigatória!'
            ]
        );

        //get user input
        // $cpf = $request->input('cpf');
        $cpf = $request['cpf'];
        $senha = $request['senha'];

        //check if user exists
        $user = DB::connection('rh')->table('usuarios')->where('cpf', $cpf)->first();
        if(!$user) return $this->loginError('Usuário não cadastrado!');
        if($user->rh == '0')return $this->loginError('Usuário não autorizado!');
        $user = DB::connection('rh')->table('usuarios')->where(['cpf'=> $cpf, 'senha'=> md5($senha)])->first();
        if(!$user)return $this->loginError('Dados incorretos!');

        //login user
        session([
            'user' => [
                'id' => $user->id,
                'nome' => $user->nome,
                'nivel' => $user->suporte,
            ]
        ]);

        return redirect()->to('/');
    }

    private function loginError(string $message)
    {
        return redirect()
        ->back()
        ->withInput()
        ->with('loginError', $message);
    }
}

<?php
namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        // Redireciona o usuário para o Facebook para autenticação
        return Socialite::driver('facebook')->redirect();
    }

    // Recebe o retorno do Facebook e autentica ou cria o usuário
    public function handleFacebookCallback()
    {
        try {
            // Obtém os dados do usuário autenticado do Facebook
            $facebookUser = Socialite::driver('facebook')->user();

            // Verifica se já existe um usuário com o facebook_id
            $user = User::where('facebook_id', $facebookUser->getId())->first();

            if (!$user) {
                // Se o usuário não existir, cria um novo
                $user = User::create([
                    'name' => $facebookUser->getName(),
                    'email' => $facebookUser->getEmail(),
                    'facebook_id' => $facebookUser->getId(),
                    'avatar' => $facebookUser->getAvatar(),
                    'password' => bcrypt(str_random(24)), // Cria uma senha aleatória (não necessária, já que o login será via Facebook)
                ]);
            }

            // Autentica o usuário
            Auth::login($user, true);

            // Redireciona para a página inicial ou para o painel de controle
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            // Se algo der errado, redireciona com uma mensagem de erro
            return redirect()->route('login')->with('error', 'Erro ao autenticar com o Facebook.');
        }
    }
}

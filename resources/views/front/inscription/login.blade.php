@extends('layouts.front_app')
@section('content')
    <style>
        .login-form-container {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
        }

        .login-form-container form {
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            flex-direction: column;
            border: 3px solid #0451b0;
            border-radius: 4px;
            gap: 50px;
            max-width: 80%;
            /* 80% de la largeur de l'écran */
            width: 800px;
            /* Largeur fixe du formulaire */
            margin: 0 auto;
            /* Centrage horizontal */
            height: 80vh;
            /* 80% de la hauteur de l'écran */
            /* Centrage vertical */
        }

        .login-form-container .text {
            font-size: 45px;
            color: #0451b0;
        }

        .input-field {
            width: 80%;
            border: 2px solid #1e9dfe;
            padding: 8px;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .button {
            background-color: #0451b0;
            color: white;
            font-weight: 600;
            border: none;
            padding: 15px 40px;
            border-radius: 4px;
            transition: background-color 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }


        .button:hover {
            background-color: #1367a7;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        @media screen and (max-width: 900px) {
            .login-form-container form {

                width: 90vw;
            }

        }

        @media screen and (max-width: 700px) {
            .login-form-container form {
                gap: 40px;
                width: 90vw;
            }

        }

        @media screen and (max-width: 500px) {
            .login-form-container form {
                height: 70vh;
            }

            .login-form-container .text {
                font-size: 40px;
            }

            .input-field {
                width: 90%;
                margin-bottom: 10px;
            }
        }

        @media screen and (max-width: 400px) {
            .login-form-container .text {
                font-size: 35px;
            }

            .login-form-container form {
                gap: 30px;
            }
        }
    </style>
    <div class="login-form-container">
        <form action="{{ route('connexion.index') }}" method="post">
            @csrf
            @include('components.message')
            <h1 class="text">Connexion</h1>
            <center>
                <div class="">
                    <input type="text" name="phone" class="input-field" value="{{ old('phone') }}"
                           placeholder="Numéro de téléphone" required>
                    <input type="password" name="password" class="input-field" value="{{ old('password') }}"
                           placeholder="Mot de passe" required>
                </div>
            </center>

            <button type="submit" class="button">Connexion</button>

        </form>
        <a href="/">Retourner à la page d&apos;accueil</a>
    </div>
@endsection

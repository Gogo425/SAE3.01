<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form_account</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 650px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            color: #4a4a4a;
            margin-bottom: 20px;
            font-size: 28px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        /* Label styles */
        label {
            font-size: 16px;
            color: #333;
            margin-bottom: 8px;
            font-weight: 500;
        }

        /* Input fields */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        input[type="submit"] {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="date"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.4);
        }

        /* Submit button */
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Checkboxes */
        .checkbox-group {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .checkbox-group label {
            display: flex;
            align-items: center;
            font-size: 16px;
            color: #555;
        }

        .checkbox-group input {
            margin-right: 10px;
        }

        /* Message style */
        .message {
            text-align: center;
            font-size: 18px;
            color: #28a745;
            margin-top: 30px;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }

            input[type="submit"] {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Créer un compte</h1>
        <form action="{{url('/create-account')}}" method="post">
            @csrf
            <div>
                <label for="name">Nom</label>
                <input type="text" name="name" id="name" placeholder="Entrer le nom" required />
            </div>
            <div>
                <label for="surname">Prénom</label>
                <input type="text" name="surname" id="surname" placeholder="Entrer le prénom" required />
            </div>
            <div>
                <label for="mail_adress">Email</label>
                <input type="email" name="mail_adress" id="mail_adress" placeholder="Entrer l'email" required />
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Entrer le mot de passe" required />
            </div>
            <div>
                <label for="password_confirmation">Confirmation Mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmer le mot de passe" required />
            </div>
            <div>
                <label for="licence_number">Numéro de licence</label>
                <input type="text" name="licence_number" id="licence_number" placeholder="Entrer le numéro de licence" required />
            </div>
            <div>
                <label for="medical_certificate_date">Date du certificat médical</label>
                <input type="date" name="medical_certificate_date" id="medical_certificate_date" required />
            </div>
            <div>
                <label for="birth_date">Date de naissance</label>
                <input type="date" name="birth_date" id="birth_date" required />
            </div>
            <div>
                <label for="adress">Adresse</label>
                <input type="text" name="adress" id="adress" placeholder="2 rue du papillon" required />
            </div>
            
            <div class="checkbox-group">
                <div>
                    <input type="checkbox" name="roles[]" value="Initiator" id="Initiator">
                    <label for="Initiator">Initiateur</label>
                </div>
                <div>
                    <input type="checkbox" name="roles[]" value="Trainingmanager" id="Trainingmanager">
                    <label for="Trainingmanager">Responsable Formation</label>
                </div>
                <div>
                    <input type="checkbox" name="roles[]" value="Student" id="Student">
                    <label for="Student">Élèves</label>
                </div>
            </div>

            <div>
                <input type="submit" value="Inscrire" />
            </div>
        </form>

        @if (isset($message))
            <p class="message">{{ $message }}</p>
        @endif
    </div>
</body>
</html>

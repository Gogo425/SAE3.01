<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form_account</title>
</head>
<body>
<form action="{{url('/create-account')}}" method="post" class="">
  @csrf
  <div class="">
    <label for="name">Nom </label>
    <input type="text" name="name" id="name" placeholder="Entrer le nom" required />
  </div>
  <div class="">
    <label for="surname">Prénom: </label>
    <input type="text" name="surname" id="surname" placeholder="Entrer le prénom" required />
  </div>
  <div class="">
    <label for="mail_adress">Email: </label>
    <input type="email" name="mail_adress" id="mail_adress" placeholder="Entrer l'email" required />
  </div>
  <div class="">
    <label for="password">Mot de passe </label>
    <input type="password" name="password" id="password" placeholder="Entrer le mot de passe" required />
  </div>
  <div class="">
    <label for="password_confirmation">Confirmation Mot de passe </label>
    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmer le mot de passe" required />
  </div>
  <div class="">
    <label for="licence_number">Numéro de licence: </label>
    <input type="text" name="licence_number" id="licence_number" placeholder="Entrer le numero de licence" required />
  </div>
  <div class="">
    <label for="medical_certificate_date">Date du certificat médical: </label>
    <input type="date" name="medical_certificate_date" id="medical_certificate_date" placeholder="Entrer la date du certificat médical" required />
  </div>
  <div class="">
    <label for="birth_date">Date de naissance: </label>
    <input type="date" name="birth_date" id="birth_date" placeholder="Entrer la date de naissance" required />
  </div>
  <div class="">
    <label for="adress">Adresse: </label>
    <input type="text" name="adress" id="adress" placeholder="2 rue du papillon" required />
  </div>
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
    <label for="Student">Elèves</label>
  </div>
  <div class="">
    <input type="submit" value="Inscrire" />
  </div>
</form>



@if (isset($message))
  <p>{{ $message }}</p>
@endif
    
</body>
</html>
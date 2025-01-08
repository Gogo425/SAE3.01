<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form_account</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const initiatorRadio = document.getElementById('Initiator');
        const studentRadio = document.getElementById('Student');
        const additionalLevels = document.getElementById('additional-levels');
        const studentsLevels = document.getElementById('students-levels');

        
        function toggleLevels() {
            if (initiatorRadio.checked) {
                
                additionalLevels.style.display = 'block';
                studentsLevels.style.display = 'none'; 
            } else if (studentRadio.checked) {
                
                studentsLevels.style.display = 'block';
                additionalLevels.style.display = 'none'; 
            }
        }

        
        initiatorRadio.addEventListener('change', toggleLevels);

        
        studentRadio.addEventListener('change', toggleLevels);

        
        toggleLevels();
    });
    </script>


</head>
<body>
  
<form action="{{url('/create-account')}}" method="post" class="">
<h1>Inscrivez-vous</h1>
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
    <label for="email">Email: </label>
    <input type="email" name="email" id="email" placeholder="Entrer l'email" required />
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
    <input type="text" name="licence_number" id="licence_number" placeholder="Entrer le numero de licence format A-03-253653" required />
        @error('licence_number')
            <span class="text-danger">{{ $message }}</span>
        @enderror
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

  <!-- Roles Section -->
  <div class="roles-section">
    <div>
      <input type="radio" name="roles[]" value="Initiator" id="Initiator">
      <label for="Initiator">Initiateur</label>
    </div>
    <div>
      <input type="radio" name="roles[]" value="Student" id="Student">
      <label for="Student">Elève</label>
    </div>
  </div>

  <!-- Additional Levels (Only visible when "Initiator" is selected) -->
  <div class="level-section" id="additional-levels" style="display: none;">
    <div>
      <input type="radio" name="level[]" value="ni2" id="ni2">
      <label for="ni2">Niveau 2</label>
    </div>
    <div>
      <input type="radio" name="level[]" value="ni3" id="ni3">
      <label for="ni3">Niveau 3</label>
    </div>
    <div>
      <input type="radio" name="level[]" value="ni4" id="ni4">
      <label for="ni4">MF1</label>
    </div>
    <div>
      <input type="radio" name="level[]" value="ni5" id="ni5">
      <label for="ni5">MF2</label>
    </div>
  </div>

  <!-- Students Levels (Only visible when "Student" is selected) -->
  <div class="level-section" id="students-levels" style="display: none;">
    <div>
      <input type="radio" name="level[]" value="ni0" id="ni0">
      <label for="ni0">Pas de Niveau</label>
    </div>
    <div>
      <input type="radio" name="level[]" value="ni1" id="ni1">
      <label for="ni1">Niveau 1</label>
    </div>
    <div>
      <input type="radio" name="level[]" value="ni2" id="ni2">
      <label for="ni2">Niveau 2</label>
    </div>
    <div>
      <input type="radio" name="level[]" value="ni3" id="ni3">
      <label for="ni3">Niveau 3</label>
    </div>
  </div>

  <div>
    <input type="submit" value="Inscrire" />
  </div>
</form>


</body>
</html>

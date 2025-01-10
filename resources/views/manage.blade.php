<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants et initiateurs</title>
    <link rel="stylesheet" href="{{asset('css/style_list.css')}}">
    <style>
        .hidden {
            display: none;
        }
        .action-buttons button {
            margin: 0 5px;
        }
    </style>
    <script>
        function toggleDisplay(type) {
            // Cache toutes les sections
            document.getElementById('studentsTable').classList.add('hidden');
            document.getElementById('initiatorsTable').classList.add('hidden');
            document.getElementById('training_managersTable').classList.add('hidden');

            // Affiche la section sélectionnée
            if (type === 'students') {
                document.getElementById('studentsTable').classList.remove('hidden');
            } 
            else if (type === 'initiators') {
                document.getElementById('initiatorsTable').classList.remove('hidden');
            }
            else if (type === 'training_managers') {
                document.getElementById('training_managersTable').classList.remove('hidden');
            }
        }
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/tailwind.config.js"></script>
</head>
<body>

    @include('header')
    <h1>Gestion des élèves, initiateurs et responsables formations</h1>

    <!-- Boutons pour afficher les sections -->
    <button onclick="toggleDisplay('students')">Afficher les Élèves</button>
    <button onclick="toggleDisplay('initiators')">Afficher les Initiateurs</button>
    <button onclick="toggleDisplay('training_managers')">Afficher les Responsables Formations</button>
    <a href="{{route('account.form')}}"><button>Créer un utilisateur</button></a>
    <!-- Tableau des élèves -->
    <table id="studentsTable" class="hidden">
       
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Numéro de licence</th>
                <th>Date certificat médical</th>
                <th>Date d'anniversaire</th>
                <th>Adresse</th>
                <th>Niveau en cours</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->surname }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->licence_number }}</td>
                    <td>{{ $student->medical_certificate_date }}</td>
                    <td>{{ $student->birth_date }}</td>
                    <td>{{ $student->adress }}</td>
                    <td>{{ $student->description }}</td>
                    <td class="action-buttons">
                    <form action="{{ route('student.delete', $student->ID_PER) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élève ?')">Supprimer</button>
                    </form>
                    <form action="{{ route('persons.edit', $student->ID_PER) }}" method="GET" style="display:inline;">
                        @csrf
                        <button type="submit">Modifier</button>
                    </form>
                        
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>

    <!-- Tableau des initiateurs -->
    <table id="initiatorsTable" class="hidden">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Numéro de licence</th>
                <th>Date certificat médical</th>
                <th>Date d'anniversaire</th>
                <th>Adresse</th>
                <th>Niveau en cours</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($initiators as $initiator)
                <tr>
                    <td>{{ $initiator->name }}</td>
                    <td>{{ $initiator->surname }}</td>
                    <td>{{ $initiator->email }}</td>
                    <td>{{ $initiator->licence_number }}</td>
                    <td>{{ $initiator->medical_certificate_date }}</td>
                    <td>{{ $initiator->birth_date }}</td>
                    <td>{{ $initiator->adress }}</td>
                    <td>{{ $initiator->description }}</td>
                    <td class="action-buttons">
                        <form action="{{ route('initiator.delete', $initiator->ID_PER) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet initiateur ?')">Supprimer</button>
                        </form>
                        <form action="{{ route('persons.edit', $initiator->ID_PER) }}" method="GET" style="display:inline;">
                        @csrf
                        <button type="submit">Modifier</button>
                    </form>
                    </td>
                   
                </tr>
            @endforeach
        </tbody>
    </table>

    <table id="training_managersTable" class="hidden">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Numéro de licence</th>
                <th>Date certificat médical</th>
                <th>Date d'anniversaire</th>
                <th>Adresse</th>
                <th>Niveau en cours</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($training_managers as $training_manager)
                <tr>
                    <td>{{ $training_manager->name }}</td>
                    <td>{{ $training_manager->surname }}</td>
                    <td>{{ $training_manager->email }}</td>
                    <td>{{ $training_manager->licence_number }}</td>
                    <td>{{ $training_manager->medical_certificate_date }}</td>
                    <td>{{ $training_manager->birth_date }}</td>
                    <td>{{ $training_manager->adress }}</td>
                    <td>{{ $training_manager->description }}</td>

                    <td class="action-buttons">
                        <form action="{{ route('training_managers.delete', $training_manager->ID_PER) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer le rôle du responsable formation ?')">Supprimer</button>
                        </form>
                        <form action="{{ route('persons.edit', $training_manager->ID_PER) }}" method="GET" style="display:inline;">
                            @csrf
                        <button type="submit">Modifier</button>
                    </form>
                    </td>
                   
                </tr>
            @endforeach
        </tbody>
    </table>

    @include('footer')

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Liste des étudiants</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Âge</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id_per }}</td>
                    <td>{{ $student->id_level }}</td>
                    <td>{{ $student->id_formation }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
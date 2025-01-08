<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil</title>
</head>
<body>
    <?php
        $id = Auth::id();

        $infos = DB::select('select * from persons where id = :id', ['id' => $id])[0];
    ?>
    <h1>Informations</h1>
    <p>Nom : <?php echo $infos->NAME; ?></p>
    <p>Prénom : <?php echo $infos->SURNAME; ?></p>
    <p>Date de naissance : <?php echo $infos->BIRTH_DATE; ?></p>
    <p>Date du certificat médical : <?php echo $infos->MEDICAL_CERTIFICATE_DATE; ?></p>
    <p>Numéro de licence : <?php echo $infos->LICENCE_NUMBER; ?></p>
    <p>Adresse : <?php echo $infos->ADRESS; ?></p>
</body>
</html>
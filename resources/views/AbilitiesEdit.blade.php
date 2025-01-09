<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title> 
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/tailwind.config.js"></script>

</head>
<body>
   @include("header")

   <?php
    $abilities = [];
    $skills = [];
    ?>

                <tr>
                    <th scope="row">Karen</th>
                    <td>Web performance</td>
                    <td>36</td>
                </tr>


   <table>
            <thead>
                <tr>
                    <th scope="col">Skills</th>
                    <th scope="col">Abilities</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($skills as $skill){
                        $check = 1;
                        foreach($abilities as $abiliti){
                            echo '<tr>';
                            if($chek === 1){
                                echo '<th scope="col">'.$Skills.'</th>
                                      <th scope="col">'.$Abilities.'</th>';
                                $check = 0;
                            }else{
                                echo '<th scope="col"></th>
                                      <th scope="col">'.$Abilities.'</th>';
                            }
                            echo '</tr>';
                        } 
                    }
                ?>            
            </tbody>
    </table>
   

 @include("footer")
</body>

</html>
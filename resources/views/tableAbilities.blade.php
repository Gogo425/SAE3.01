<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        table {
        border-collapse: collapse;
        border: 2px solid rgb(140 140 140);
        font-family: sans-serif;
        font-size: 0.8rem;
        letter-spacing: 1px;
        }

        caption {
        caption-side: bottom;
        padding: 10px;
        font-weight: bold;
        }

        thead,
        tfoot {
        background-color: rgb(228 240 245);
        }

        th,
        td {
        border: 1px solid rgb(160 160 160);
        padding: 8px 10px;
        }

        td:last-of-type {
        text-align: center;
        }
    </style>

    
    <?php
    use App\Models\skills;
    use App\Models\abilities;
    use App\Models\sessions;

    function getAndRemoveFirstElement(&$array) {
        if (empty($array)) {
            return null;
        }
        $firstElement = array_shift($array);
        return $firstElement;
    }


    $skillsArray = [];
    $skills = (new skills)->selectbyLevel(1);
    foreach($skills as $skill){
            array_push($skillsArray, $skill->ID);
        }
    


    $abilitiesArray = [];
    foreach($skillsArray as $skill){
        $abilities = (new abilities)->selectBySkill($skill);
        foreach($abilities as $abiliti){
            array_push($abilitiesArray, $abiliti->ID);
            }
    }
    
    $dateSessionsArray = [];
    $sessions = (new sessions)->selectAllTable();
    foreach($sessions as $session){
        array_push($dateSessionsArray, $session->DATE_SESSION);
        }
    ?>
    <table>
        <col>
        <colgroup span="2"></colgroup>
        <colgroup span="2"></colgroup>
        <tr>
            <td rowspan="1"></td>
            <?php
                foreach($skillsArray as $skillID){
                    $cpt = (new abilities)->countBySkill($skillID);
                    echo '<th colspan="'. $cpt .'" scope="colgroup">' .'C'.$skillID.'</th>';
                }
            ?>
        </tr>
        <tr>

            <?php
                echo '<th scope="col"></th>';
                foreach($abilitiesArray as $abi){
                    echo '<th scope="col">A'.$abi.'</th>';
                }
            ?>
        </tr>
        


            
            <?php
                
                //affichage de chaque ligne
                while(!empty($dateSessionsArray)){
                    echo '<tr>';
                    echo '<th scope="row">'.getAndRemoveFirstElement($dateSessionsArray).'</th>';
                    for($i = 0; $i < 5; $i++){
                        echo '<td>50,000</td>';
                    }
                    //foreach($abilitiesArray as $abi){
                    //    echo '<td>50,000</td>';
                    //}
                    echo '</tr>';
                }
                
                
            ?>
            
            
            
        
    </table>

</body>
</html>

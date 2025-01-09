<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/tableAbilities.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    use App\Models\skills;
    use App\Models\abilities;
    use App\Models\Evaluations;
    use App\Models\sessions;
    use App\Models\status;
    use App\Models\persons;
use App\Models\Students;
use Illuminate\Support\Facades\Auth;

    $idUser = 2 /*Auth::id()*/;

    $nameUser = (new persons)->getNameOf($idUser);

    $levelUser = DB::select('select ID_LEVEL from students where id_per = :id', ['id' => $idUser])[0]->ID_LEVEL;
    $idFormation = DB::select('select ID_FORMATION from students where id_per = :id', ['id' => $idUser])[0]->ID_FORMATION;

    $skillsArray = [];
    $skills = (new skills)->selectbyLevel($levelUser);
    foreach($skills as $skill){
            array_push($skillsArray, $skill->ID_SKILLS);
        }
    


    $abilitiesArray = [];
    foreach($skillsArray as $skill){
        $abilities = (new abilities)->selectBySkill($skill);
        foreach($abilities as $abiliti){
            array_push($abilitiesArray, $abiliti->ID_ABILITIES);
            }
    }
    $idSessionsArray = [];
    $dateSessionsArray = [];
    $sessions = (new sessions)->selectByForamtion($idFormation);
    foreach($sessions as $session){
        array_push($dateSessionsArray, $session->DATE_SESSION);
        }
    foreach($sessions as $session){
        array_push($idSessionsArray,$session->ID_SESSIONS);
        }

    ?>
    <table class="responsive-table">
        <?php
            echo '<caption>'.$nameUser.'</caption>';
        ?>
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
            while(!empty($dateSessionsArray)){
                $date = array_shift($dateSessionsArray);
                $idSession = array_shift($idSessionsArray);
                echo '<tr>';
                echo '<th scope="row">'.$date.'</th>';
                
                foreach($abilitiesArray as $abiliti){
                    $case = "";
                    $class = "vide";
                    $eval = (new evaluations)->getObservation($idSession,$abiliti,$idUser);
                    
                    foreach($eval as $evaluation){
                        $idStatus = $evaluation->ID_STATUS;
                        $descStatus = (new status)->getDesc($idStatus);
                        foreach($descStatus as $desc){
                            $case = $case . $desc->DESCRIPTION;
                            if($case == "Non évalué") {
                                $class = "non-evalue"; // Gris
                            } elseif ($case == "En cours") {
                                $class = "en-cours"; // Orange
                            } elseif ($case == "Acquis") {
                                $class = "acquis"; // Vert
                            }
                        }
                    }
                    echo '<td class="' . $class . '">' . $case . '</td>';
                }
                echo '</tr>';
                }  
            ?>  
    </table>
</body>
</html>

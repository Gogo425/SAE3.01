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
        use App\Models\students;
        use App\Models\abilities;
        use App\Models\Evaluations;
        use App\Models\persons;
        use App\Models\status;
        use App\Models\sessions;

        $levelSelected = 1;


        $skillsArray = [];
        $skills = (new skills)->selectbyLevel($levelSelected);
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
        
        $idStudent = [];
        $nameStudent = [];
        $students = (new students)->selectAllTable();
        foreach($students as $student){
            array_push($idStudent, $student->ID_PER);
        }
        foreach($idStudent as $id){
            array_push($nameStudent, (new persons)->getNameOf($id));
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
            while(!empty($nameStudent)){
                $name = array_shift($nameStudent);
                $id = array_shift($idStudent);
                echo '<tr>';
                echo '<th scope="row">'.$name.'</th>';
                
                foreach($abilitiesArray as $abiliti){
                    $case = "";
                    $classe = "vide";
                    $a = (new Evaluations)->getEvaluationsStudent($id, $abiliti);
                    if($a){
                        $case = "Acquis";
                        $classe = "acquis";
                    }else{
                        $case = "En cours";
                        $classe = "en-cours";
                    }

                    echo '<td class="'.$classe.'">'.$case.'</td>';
                }
                echo '</tr>';
                }  
            ?>  
        
    </table>

    
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/tableAbilities.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/tailwind.config.js"></script>
    <title>Document</title>
</head>
<body>
    <?php
    // Exemple de fonction PHP
    function myFunction($parameter)
    {
        echo "La fonction PHP a été appelée avec le paramètre : $parameter";
    }

    @include("header");
    // Vérifier si le formulaire a été soumis
    if (isset($_POST['call_function'])) {
        $param = $_POST['call_function'];
        myFunction($param);
    }
    ?>
    
    <?php
        use App\Models\skills;
        use App\Models\students;
        use App\Models\abilities;
        use App\Models\Evaluations;
        use App\Models\persons;
        use App\Models\status;
        use App\Models\sessions;


        

        $levelSelected = isset($_POST['level']) ? $_POST['level'] : 1;


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
        $students = (new students)->selectByLevel($levelSelected);
        foreach($students as $student){
            array_push($idStudent, $student->ID_PER);
        }
        foreach($idStudent as $id){
            array_push($nameStudent, (new persons)->getNameOf($id));
        }
    ?>
    <!-- Formulaire pour sélectionner le niveau -->
    <form method="POST" action="">
        @csrf
        <label for="level">Select Level:</label>
        <select name="level" id="level" onchange="this.form.submit()">
            <option value="1" <?= $levelSelected == 1 ? 'selected' : '' ?>>Level 1</option>
            <option value="2" <?= $levelSelected == 2 ? 'selected' : '' ?>>Level 2</option>
            <option value="3" <?= $levelSelected == 3 ? 'selected' : '' ?>>Level 3</option>
        </select>
    </form>
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
                $valide = 0;
                $name = array_shift($nameStudent);
                $id = array_shift($idStudent);
                echo '<tr>';
                echo '<th scope="row">'.$name.'</th>';
                
                foreach($abilitiesArray as $abiliti){
                    $case = "";
                    $classe = "vide";
                    $a = (new Evaluations)->getEvaluationsStudent($id, $abiliti);
                    if($a){
                        $valide = $valide + 1;
                        $case = "Acquis";
                        $classe = "acquis";
                    }else{
                        $case = "En cours";
                        $classe = "en-cours";
                    }
                    //echo '<td class="'.$classe.'">'.$case.'</td>';
                    echo '<td class="'.$classe.'" data-label="Ability A'.$abiliti.'">'.$case.'</td>';
                    
                }
                echo '<td>';
                    if($valide == count($abilitiesArray)) {
                        echo '<form method="POST" action="' . route('validate') . '" >
                        ' . csrf_field() . '
                         <input type="hidden" name="student_id" value="' . $id . '">
                        <button type="submit" class="btn btn-valid">
                            <span class="icon valid"></span> Valider
                        </button>
                    </form>';
                    }else {
                        echo '<div class="button-container">
                            <button class="btn btn-in-progress" disabled>
                                <span class="icon in-progress"></span> En cours
                            </button>
                        </div>';
                    }
                echo '</td>';
                echo '</tr>';
            } 

            ?>  

    </table>
    @include("footer")

</body>
</html>











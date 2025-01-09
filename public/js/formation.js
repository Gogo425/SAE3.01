document.addEventListener("DOMContentLoaded", function () {

    const levelSelect = document.getElementById("id_level");

    const studentsContainer = document.getElementById("students-list");
    const students = studentsContainer.querySelectorAll(".form-check");

    const initiatorsContainer = document.getElementById("initiators-list");
    const initiators = initiatorsContainer.querySelectorAll(".form-check");

    // Fonction pour filtrer les élèves en fonction du niveau sélectionné
    function filterStudentsByLevel() {
        const selectedLevel = parseInt(levelSelect.value);

        students.forEach(student => {
            const studentLevel = parseInt(student.querySelector("input").getAttribute("data-level"));

            // Vérifier si le niveau de l'élève est égal au niveau sélectionné moins 1
            if (studentLevel === selectedLevel ) {
                student.style.display = "block"; // Afficher l'élève
            } else {
                student.style.display = "none"; // Masquer l'élève
            }
        });
    }

    function filterInitiatorsByLevel() {
        const selectedLevel = parseInt(levelSelect.value);

        initiators.forEach(initiator => {
            const initiatorLevel = parseInt(initiator.querySelector("input").getAttribute("data-level"));

            // Vérifier si le niveau de l'élève est égal au niveau sélectionné moins 1
            if (initiatorLevel > selectedLevel ) {
                initiator.style.display = "block"; // Afficher l'élève
            } else {
                initiator.style.display = "none"; // Masquer l'élève
            }
        });
    }

    // Appliquer le filtre au changement du niveau sélectionné
    levelSelect.addEventListener("change", filterStudentsByLevel);
    levelSelect.addEventListener("change", filterInitiatorsByLevel);

    // Appliquer le filtre au chargement initial
    filterStudentsByLevel();
    filterStudentsByLevel();
});

document.addEventListener("DOMContentLoaded", function () {

    const levelSelect = document.getElementById("id_level");

    const studentsContainer = document.getElementById("students-list");
    const students = studentsContainer.querySelectorAll(".form-check input");

    const initiatorsContainer = document.getElementById("initiators-list");
    const initiators = initiatorsContainer.querySelectorAll(".form-check input");

    const responsibleSelect = document.querySelector("select[name='name']");

    // Fonction pour filtrer les élèves en fonction du niveau sélectionné
    function filterStudentsByLevel() {
        const selectedLevel = parseInt(levelSelect.value);

        students.forEach(student => {
            const studentLevel = parseInt(student.getAttribute("data-level"));

            if (studentLevel === selectedLevel) {
                student.closest(".form-check").style.display = "block";
            } else {
                student.closest(".form-check").style.display = "none";
            }
        });
    }

    // Fonction pour filtrer les initiateurs
    function filterInitiatorsByLevel() {
        const selectedLevel = parseInt(levelSelect.value);

        initiators.forEach(initiator => {
            const initiatorLevel = parseInt(initiator.getAttribute("data-level"));
            const selectedResponsible = responsibleSelect.value;

            if (initiatorLevel > selectedLevel && initiator.value !== selectedResponsible) {
                initiator.closest(".form-check").style.display = "block";
            } else {
                initiator.closest(".form-check").style.display = "none";
            }
        });
    }

    // Fonction pour limiter le nombre d'élèves cochés
    function limitStudentSelection() {
        const checkedInitiators = Array.from(initiators).filter(init => init.checked).length;
        const maxStudents = checkedInitiators * 2;

        const checkedStudents = Array.from(students).filter(student => student.checked);

        if (checkedStudents.length >= maxStudents) {
            students.forEach(student => {
                if (!student.checked) {
                    student.disabled = true;
                }
            });
        } else {
            students.forEach(student => {
                student.disabled = false;
            });
        }
    }

    // Fonction pour filtrer les responsables de formation
    function filterResponsiblesByLevel() {
        const selectedLevel = parseInt(levelSelect.value);

        responsibleSelect.innerHTML = "";

        initiators.forEach(initiator => {
            const initiatorLevel = parseInt(initiator.getAttribute("data-level"));

            if (initiatorLevel > selectedLevel + 1) {
                const option = document.createElement("option");
                option.value = initiator.value;
                option.textContent = initiator.closest(".form-check").querySelector("label").textContent;
                responsibleSelect.appendChild(option);
            }
        });

        // Appeler la fonction pour synchroniser la liste des initiateurs
        filterInitiatorsByLevel();
    }

    // Fonction pour synchroniser les initiateurs avec le responsable sélectionné
    function syncInitiatorsWithResponsible() {
        filterInitiatorsByLevel();
    }

    // **Nouvelle fonction pour décocher toutes les cases**
    function uncheckAllCheckboxes() {
        students.forEach(student => {
            student.checked = false;
            student.disabled = false; // Réinitialise le statut désactivé
        });
        initiators.forEach(initiator => {
            initiator.checked = false;
            initiator.disabled = false; // Réinitialise le statut désactivé
        });
    }

    // Ajouter des écouteurs pour surveiller les changements
    levelSelect.addEventListener("change", () => {
        filterStudentsByLevel();
        filterInitiatorsByLevel();
        filterResponsiblesByLevel();
    });
    responsibleSelect.addEventListener("change", syncInitiatorsWithResponsible);
    initiators.forEach(initiator => initiator.addEventListener("change", limitStudentSelection));
    students.forEach(student => student.addEventListener("change", limitStudentSelection));

    // Appliquer les filtres et restrictions au chargement initial
    uncheckAllCheckboxes(); // Décoche toutes les cases au chargement
    filterStudentsByLevel();
    filterInitiatorsByLevel();
    filterResponsiblesByLevel();
    limitStudentSelection();
});

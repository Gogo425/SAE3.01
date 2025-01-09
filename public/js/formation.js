document.addEventListener("DOMContentLoaded", function () {

    // Selected level for the formation
    const levelSelect = document.getElementById("id_level");

    // Selected students
    const studentsContainer = document.getElementById("students-list");
    const students = studentsContainer.querySelectorAll(".form-check input");

    // Selected initiators
    const initiatorsContainer = document.getElementById("initiators-list");
    const initiators = initiatorsContainer.querySelectorAll(".form-check input");

    // The selected training manager
    const responsibleSelect = document.querySelector("select[name='name']");

    /**
     * Function to filter students by selected level
     * @author @hugotheault
     */
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

    /**
     * Function to filter initiators
     * @author @hugotheault
     */
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

    /**
     * Function to limit the number of students you can select
     * @author @hugotheault
     */
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

    /**
     * Function to filter the training managers
     * @author @hugotheault
     */
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

        // Call function to synchronize initiators list
        filterInitiatorsByLevel();
    }

    /**
     * Call function to synchronize initiators with the selectted training manager
     * @author @hugotheault
     */
    function syncInitiatorsWithResponsible() {
        filterInitiatorsByLevel();
    }

    /**
     * Function to uncheck all boxes
     * @author @hugotheault
     */
    function uncheckAllCheckboxes() {
        students.forEach(student => {
            student.checked = false;
            student.disabled = false; 
        });
        initiators.forEach(initiator => {
            initiator.checked = false;
            initiator.disabled = false;
        });
    }

    // Add listener to monitor changes
    levelSelect.addEventListener("change", () => {
        filterStudentsByLevel();
        filterInitiatorsByLevel();
        filterResponsiblesByLevel();
    });
    responsibleSelect.addEventListener("change", syncInitiatorsWithResponsible);
    initiators.forEach(initiator => initiator.addEventListener("change", limitStudentSelection));
    students.forEach(student => student.addEventListener("change", limitStudentSelection));

    // Apply filters and restrictions to the initial load
    uncheckAllCheckboxes(); 
    filterStudentsByLevel();
    filterInitiatorsByLevel();
    filterResponsiblesByLevel();
    limitStudentSelection();
});

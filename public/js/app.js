//require('./bootstrap');

let nbStudent = 1;

function addStudent() {

    nbStudent += 1;

    const form_students = document.getElementById('students');

    // Récupérer les options depuis les listes invisibles
    const studentOptions = document.getElementById('student1').innerHTML;
    const abilityOptions = document.getElementById('abilities11').innerHTML;
    const initiatorOptions = document.getElementById('initiator1').innerHTML;
    
    let newStudent = `
        <div id='student_${nbStudent}'>
            <select name="student${nbStudent}" id="student${nbStudent}">
                ${studentOptions}
            </select>

            <select name="abilities1${nbStudent}" id="abilities1${nbStudent}">
                ${abilityOptions}
            </select>

            <select name="abilities2${nbStudent}" id="abilities2${nbStudent}">
                ${abilityOptions}
            </select>

            <select name="abilities3${nbStudent}" id="abilities3${nbStudent}">
                ${abilityOptions}
            </select>

            <select name="initiator${nbStudent}" id="initiator${nbStudent}">
                ${initiatorOptions}
            </select>
        </div>
        <br>
    `;

    form_students.insertAdjacentHTML("beforeend", newStudent);
}

let specialChars = "<>@!#$%^&*()_+[]{}?:;|'\"\\,./~`-=e";
let cC = document.querySelector('#course_code');
let cCA = document.querySelector('.cCA');
let validCourseCode = false;
let cT = document.querySelector("#course");
cC.addEventListener("focus", function() {
    cCA.style.display = "block"
})
cC.addEventListener("blur", function() {
    cCA.style.display = "none"
})

cC.addEventListener("keyup", function() {
    let courseCode = document.querySelector("#course_code");
    courseCode.value = cC.value.toUpperCase();
    courseCode.value = courseCode.value.replace(/\s/g, '');

    if (courseCode.value.length > 6){ swal.fire({
        title: 'Code length cannot be more than 6 character!',
        icon: 'warning',
        text: 'The 1st number after the 3rd letter represents the CLASS, the 6th number represents the TERM.'
    })}else if(courseCode.value.length === 6){
        validCourseCode = true;
    }
    let checkForSpecialChar = function(string) {
        for (i = 0; i < specialChars.length; i++) {
            if (string.indexOf(specialChars[i]) > -1) {
                return true
            }
        }
        return false;
    }

    if (checkForSpecialChar(courseCode.value)) {
        validCourseCode = false;
        swal.fire({
            title: 'Code should not include any symbol',
            icon: 'warning',
            text: 'The 1st number after the 3rd letter represents the CLASS, the 6th number represents the TERM.'
            
        })
    } else {
        validCourseCode = true;
    }
})

cT.addEventListener('keyup', function(){
    let courseTitle = document.getElementById("course");
    courseTitle.value = cT.value.toUpperCase();
})

function addCourse(form){
    if(cC.value.length != 6){
    swal.fire({
            title: 'Invalid Course Code',
            text: 'Create a valid Course Code',
            icon: 'warning'
        })
    }else{
        form.submit()
    }
    return false;
}



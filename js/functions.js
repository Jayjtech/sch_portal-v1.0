let baseUrl = "http://localhost/sch_portal-v1.0";
function viewPassword(){
    let x = document.querySelector("#password");
    let eyeEl = document.querySelector("#eye-el");
    if(x.type === "password"){
        x.type = "text"
        eyeEl.innerHTML = `<i class="mdi mdi-eye-off"></i>`
    }else{
        x.type = "password"
        eyeEl.innerHTML = `<i class="mdi mdi-eye"></i>`
    }
}

function viewPassword2(){
    let x = document.querySelector("#rPassword");
    let eyeEl = document.querySelector("#eye-el2");
    if(x.type === "password"){
        x.type = "text"
        eyeEl.innerHTML = `<i class="mdi mdi-eye-off"></i>`
    }else{
        x.type = "password"
        eyeEl.innerHTML = `<i class="mdi mdi-eye"></i>`
    }
}

/**Validating Password */
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}

/**Select User-type for registration */
 $(document).ready(function() {
        $(".user-category").change(function() {
            var userCategory = $(this).val();
            var request = 'userCategory=' + userCategory;

            $.ajax({
                type: "POST",
                url: `${baseUrl}/functions/selectUser.php`,
                data: request,
                cache: false,
                success: function(station) {
                    $(".categoryResponse").html(station);
                }
            });
        });
    });

/**Process Registration */
$("form#registerForm").on("submit", function (e) {
    e.preventDefault()
    let name = $("#name").val();
    let email = $("#email").val();
    let userCategory = $("#userCategory").val();
    let myClass = $("#myClass").val();
    let staffType = $("#staffType").val();
    let password = $("#password").val();
    let rPassword = $("#rPassword").val();
    let lowerCaseLetters = /[a-z]/g;
    let upperCaseLetters = /[A-Z]/g;
    let numbers = /[0-9]/g;
    let os = $("#os").val();
    let ip = $("#ip").val();
    let device = $("#device").val();
   
    if(name === ""){
        swal({title: `Kindly provide your full name!`, text: `The name field is required.`, icon: "warning", button: "Ok", dangerMode: false})
    }else if(name.length < "10"){
        swal({title: `The name provided is too short!`, text: `Full name should not be less than 10 characters.`, icon: "warning", button: "Ok", dangerMode: false})
    }else if(!email.includes('@')){
        swal({title: `Invalid Email-ID!`, text: `A valid Email-ID is required.`, icon: "warning", button: "Ok", dangerMode: false})
    }else if(userCategory === ""){
        swal({title: `Kindly select your category!`, text: `The category field is required.`, icon: "warning", button: "Ok", dangerMode: false})
    }else if(myClass === ""){
        swal({title: `Kindly select your current class!`, text: `The class field is required.`, icon: "warning", button: "Ok", dangerMode: false})
    }else if(staffType === ""){
        swal({title: `Kindly select staff type!`, text: `The staff type field is required.`, icon: "warning", button: "Ok", dangerMode: false})
    }else if(!password.match(upperCaseLetters) || !password.match(lowerCaseLetters) || !password.match(numbers) || password.length < 8){
        swal({title: `Password too weak!`, text: `Password must contain uppercase letter, lowercase letter, number and shouldn't be less than 8 characters.`, icon: "warning", button: "Ok", dangerMode: false})
    }else if(password != rPassword){
        swal({title: `The two passwords do not match!`, text: `Password and Repeat password fields must have the same value.`, icon: "warning", button: "Ok", dangerMode: false})
    }else{
          let btnSuc = document.querySelector(".createUser");
            btnSuc.innerHTML = `<div class=""><em>Setting up account...</em><div>
            <div class="progress mt-3">
                <div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar" style="width: 60%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>`;
        $.post(`${baseUrl}/functions/log_user.php`, {
            key: "getData",
            name: name,
            email: email,
            myClass: myClass,
            userCategory: userCategory,
            os: os,
            ip: ip,
            device: device,
            staffType: staffType,
            password: password
        },
        function (response){
            $('.registerResponse').html(response);
        });
    }

});


/**User Login */



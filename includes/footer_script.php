<script>
function viewKey() {
    let x = document.querySelector("#disbursementKey");
    let eyeEl = document.querySelector("#eye-el");
    if (x.type === "password") {
        x.type = "text"
        eyeEl.innerHTML = `<i class="mdi mdi-eye-off"></i>`
    } else {
        x.type = "password"
        eyeEl.innerHTML = `<i class="mdi mdi-eye"></i>`
    }
}

function viewPassword() {
    let x = document.querySelector("#password");
    let eyeEl = document.querySelector("#eye-el");
    if (x.type === "password") {
        x.type = "text"
        eyeEl.innerHTML = `<i class="mdi mdi-eye-off"></i>`
    } else {
        x.type = "password"
        eyeEl.innerHTML = `<i class="mdi mdi-eye"></i>`
    }
}

$(document).ready(function() {
    $(".result-type").change(function() {
        var resultType = $(this).val();
        var request = 'resultType=' + resultType;
        $.ajax({
            type: "POST",
            url: "<?= $resultTypeSetter; ?>",
            data: request,
            cache: false,
            success: function(station) {
                $(".resultTypeResponse").html(station);
            }
        });
    });
});


function previewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("quest-img").files[0]);

    oFReader.onload = function(oFREvent) {
        document.getElementById("quest-img-preview").src = oFREvent.target.result;
    };
};

/**Profile image uploader */
$(document).ready(function() {
    $(document).on('change', '#file', function() {
        var name = document.getElementById("file").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            alert("Invalid Image File");
        }

        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file").files[0]);
        var f = document.getElementById("file").files[0];
        var fsize = f.size || f.fileSize;
        if (fsize > 2000000) {
            alert("Image File Size is very big");
        } else {
            form_data.append("file", document.getElementById('file').files[0]);
            $.ajax({
                url: "<?= $profileUploader; ?>",
                method: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#uploaded_image').html(
                        "<label class='text-success'>Image Uploading...</label>"
                    );
                },
                success: function(data) {
                    $('#uploaded_image').html(data);
                }
            });
        }
    });
});
/**End */

/**School logo uploader */
$(document).ready(function() {
    $(document).on('change', '#logo_file', function() {
        var name = document.getElementById("logo_file").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            alert("Invalid Image File");
        }

        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("logo_file").files[0]);
        var f = document.getElementById("logo_file").files[0];
        var fsize = f.size || f.fileSize;
        if (fsize > 2000000) {
            alert("Image File Size is very big");
        } else {
            form_data.append("logo_file", document.getElementById('logo_file').files[0]);
            $.ajax({
                url: "<?= $schLogoUploader; ?>",
                method: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#uploaded_image').html(
                        "<label class='text-success'>Image Uploading...</label>"
                    );
                },
                success: function(data) {
                    $('#uploaded_image').html(data);
                }
            });
        }
    });
});
/**End */


function updateQuest(form) {
    let questionText = document.getElementById("question-text").value;
    let optionA = document.getElementById("optionA").value;
    let optionB = document.getElementById("optionB").value;
    let optionC = document.getElementById("optionC").value;
    let optionD = document.getElementById("optionD").value;
    // let optionE = document.getElementById("optionE").value;
    if (questionText.includes('"') || optionA.includes('"') || optionB.includes('"') || optionC.includes('"') || optionD
        .includes('"') /*|| optionE.includes("'")*/ || questionText.includes("'") || optionA.includes("'") || optionB
        .includes("'") || optionC
        .includes("'") || optionD.includes("'") /*|| optionE.includes("'")*/ ) {
        swal.fire({
            title: `Question or answer text must not contain quotation[" or '] mark!`,
            text: ``,
            icon: "error",
            showDenyButton: false,
            confirmButtonText: 'Ok'
        })
    } else {
        swal.fire({
            title: `Are you sure you want to save changes?`,
            text: ``,
            icon: "info",
            showDenyButton: true,
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    }
    return false;
}

function delForm(form) {
    swal.fire({
        title: "Are you sure you want to delete this file",
        text: "The file will no longer exist",
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        } else if (result.isDenied) {
            Swal.fire('File left untouched!', '', 'info')
        }
    })
    return false;
}

function setLoan(form) {
    swal.fire({
        title: `Are you sure you want to save changes?`,
        text: ``,
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        } else if (result.isDenied) {
            Swal.fire(`Changes was not saved!`, '', 'info')
        }
    })
    return false;
}

function loanApproval(form) {
    swal.fire({
        title: `Are you sure you want to approve this loan?`,
        text: ``,
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
    return false;
}

function cancelLoan(form) {
    swal.fire({
        title: `Are you sure you want to cancel your loan request?`,
        text: ``,
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
    return false;
}

function requestLoan(form) {
    let loanAmount = parseInt(document.querySelector("#loanAmount").value);
    if (loanAmount > <?= $admin_det->loan_max_amount;?>) {
        Swal.fire({
            title: `You can't request a loan above <?= $currency; ?><?= number_format($admin_det->loan_max_amount); ?>`,
            icon: `info`,
            confirmButtonText: 'Ok'
        })
    } else {
        swal.fire({
            title: `Are you sure you want to request for a loan?`,
            text: ``,
            icon: "warning",
            showDenyButton: true,
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            } else if (result.isDenied) {
                Swal.fire(`Loan request cancelled!`, '', 'info')
            }
        })
    }
    return false;
}


/**Calculate Salary to be disbursed */
$(document).ready(function() {
    $(".payroll-period").change(function() {
        var payRollPeriod = $(this).val();
        var request = 'payRollPeriod=' + payRollPeriod;
        // alert(request);
        $.ajax({
            type: "POST",
            url: `<?= BASE_URL?>/functions/calculate_salary.php`,
            data: request,
            cache: false,
            success: function(station) {
                $(".salary_response").html(station);
            }
        });
    });
});


function bioData(form) {
    swal.fire({
        title: "Are you sure you have filled the correct details?",
        text: "Details can only be updated ones",
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        } else if (result.isDenied) {
            Swal.fire('Data was not updated!', 'You make your adjustment and update', 'info')
        }
    })
    return false;
}


function enrolCourse(form) {
    swal.fire({
        title: `Are you sure you want to enrol for this course?`,
        text: "It will appear on the list of your registered courses",
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        } else if (result.isDenied) {
            Swal.fire(`You didn't enrol!`, '', 'info')
        }
    })
    return false;
}

function delCourse(form) {
    swal.fire({
        title: `Are you sure you want to delete this course?`,
        text: "It will no longer appear on the list of courses you registered for",
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        } else if (result.isDenied) {
            Swal.fire(`Course left untouched!`, '', 'info')
        }
    })
    return false;
}

function delTimeTbl(form) {
    swal.fire({
        title: `Are you sure you want to delete this time table?`,
        text: "It will no longer exist",
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        } else if (result.isDenied) {
            Swal.fire(`Time-table left untouched!`, '', 'info')
        }
    })
    return false;
}

/**Validating password during user revision */
function show() {
    let pass = document.querySelector("#password").value;
    let pFormat = document.querySelector(".p-format")
    let lowerCaseLetters = /[a-z]/g;
    let upperCaseLetters = /[A-Z]/g;
    let numbers = /[0-9]/g;
    if ((pass.length < 8) || (!pass.match(lowerCaseLetters)) || (!pass.match(
            upperCaseLetters)) || (!pass.match(
            numbers))) {
        pFormat.style.display = "block"
        pValid = 0
    } else {
        pFormat.style.display = "none"
        pValid = 1
    }
}

function revStaff(form) {
    if (!pValid) {
        swal.fire({
            title: `Invalid password format`,
            text: `Minimum length: 8; at least an uppercase and a lowercase letter eg. Math14ew`,
            icon: "warning",
            showDenyButton: false,
            confirmButtonText: 'Ok'
        })
    } else {
        swal.fire({
            title: `Are you sure you want to save changes?`,
            text: `Staff's details will be updated!`,
            icon: "warning",
            showDenyButton: true,
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            } else if (result.isDenied) {
                Swal.fire(`Nothing was changed!`, '', 'info')
            }
        })
    }
    return false;
}


function revStu(form) {
    if (!pValid) {
        swal.fire({
            title: `Invalid password format`,
            text: `Minimum length: 8; at least an uppercase and a lowercase letter eg. Math14ew`,
            icon: "warning",
            showDenyButton: false,
            confirmButtonText: 'Ok'
        })
    } else {
        swal.fire({
            title: `Are you sure you want to save changes?`,
            text: `Student's details will be updated!`,
            icon: "warning",
            showDenyButton: true,
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            } else if (result.isDenied) {
                Swal.fire(`Nothing was changed!`, '', 'info')
            }
        })
    }
    return false;
}

function delQuest(form) {
    swal.fire({
        title: `Are you sure you want delete this file?`,
        text: `Questions on this course will no longer exist!`,
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
    return false;
}

function delPayroll(form) {
    swal.fire({
        title: `Are you sure you want delete this payroll?`,
        text: `Payroll will no longer exist!`,
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
    return false;
}

function updateDisKey(form) {
    swal.fire({
        title: `Are you sure you want save the changes you made?`,
        text: ``,
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
    return false;
}

function uploadQuest(form) {
    let questType = document.getElementById("quest_type").value;
    swal.fire({
        title: `You are about to upload ${questType} QUESTIONS`,
        text: `Click yes to upload QUESTIONS.`,
        icon: "info",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
    return false;
}

function uploadInstruct(form) {
    let questType = document.getElementById("quest_type2").value;
    let courseCode = document.getElementById("course-code-el2").value;
    swal.fire({
        title: `You are about to upload ${questType} INSTRUCTIONS`,
        text: `Click yes to upload INSTRUCTIONS.`,
        icon: "info",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
    return false;
}

function fundWallet(form) {
    let studentName = document.getElementById("studentName").value;
    let fundAmount = document.getElementById("fundAmount").value;
    swal.fire({
        title: `<?= $currency; ?>${fundAmount} will be added to ${studentName}'s wallet balance`,
        text: `Click yes to proceed.`,
        icon: "info",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
    return false;
}


function schInfo(form) {
    swal.fire({
        title: `Are you sure you want to save the changes you made?`,
        text: `It will affect other sectors on the portal!`,
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        } else if (result.isDenied) {
            Swal.fire(`You didn't enrol!`, '', 'info')
        }
    })
    return false;
}

function delMat(form) {
    swal.fire({
        title: `Are you sure you want to delete this material?`,
        text: ``,
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
    return false;
}

function addToDisburse(form) {
    swal.fire({
        title: `Are you sure you want to add this staff to the disbursement list?`,
        text: ``,
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
    return false;
}

function removeFromDisburse(form) {
    swal.fire({
        title: `Are you sure you want to remove this staff from the disbursement list?`,
        text: ``,
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
    return false;
}


function reTakeExam(form) {
    swal.fire({
        title: `Are you sure you want this student to re-take this exam?`,
        text: ``,
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
    return false;
}

function sortBill(form) {
    let wallBalance = parseInt(document.querySelector("#wallet-balance").value);
    let totalAmount = parseInt(document.querySelector("#total-amount").value);
    if (totalAmount > wallBalance) {
        swal.fire({
            title: `<?= $currency; ?>${wallBalance}: wallet balance is not enough to clear the bill!`,
            text: `Fund student's wallet to continue.`,
            icon: `info`
        })
    } else {
        swal.fire({
            title: `Are you sure you want to pay <?= $currency; ?>${totalAmount}?`,
            text: ``,
            icon: "warning",
            showDenyButton: true,
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    }
    return false;
}


function disburse(form) {
    Swal.fire({
        title: 'Disbursement key',
        input: 'password',
        inputAttributes: {
            autocapitalize: 'off',
            required: 'on',
            placeholder: 'Disbursement key'
        },
        showCancelButton: false,
        confirmButtonText: 'Verify',
        showLoaderOnConfirm: true,
        preConfirm: (disburseKey) => {
            return fetch(`functions/verifyKey.php?disburseKey=${disburseKey}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    Swal.showValidationMessage(
                        `Request failed: ${error}`
                    )
                })
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: result.value.text,
                icon: result.value.icon,
            })
            if (result.value.icon === "success") {
                form.submit()
            }
        }
    })
    return false;
}

function startTest(form) {
    swal.fire({
        title: `Are you sure you want to proceed to exam page?`,
        text: ``,
        icon: "info",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit()
        } else if (result.isDenied) {
            Swal.fire(`You didn't proceed!`, '', 'info')
        }
    })
    return false;
}
</script>
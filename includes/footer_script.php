<script>
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

function revStaff(form) {
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
    return false;
}

function revStu(form) {
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
        } else if (result.isDenied) {
            Swal.fire(`File was not deleted!`, '', 'info')
        }
    })
    return false;
}

function uploadQuest(form) {
    let questType = document.getElementById("quest_type").value;
    let courseCode = document.getElementById("course-code-el").value;
    swal.fire({
        title: `You are about to upload ${courseCode} ${questType} QUESTIONS`,
        text: `Click yes to upload QUESTIONS.`,
        icon: "info",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        } else if (result.isDenied) {
            Swal.fire(`${courseCode} ${questType} QUESTIONS were not uploaded!`, '', 'info')
        }
    })
    return false;
}

function uploadInstruct(form) {
    let questType = document.getElementById("quest_type2").value;
    let courseCode = document.getElementById("course-code-el2").value;
    swal.fire({
        title: `You are about to upload ${courseCode} ${questType} INSTRUCTIONS`,
        text: `Click yes to upload INSTRUCTIONS.`,
        icon: "info",
        showDenyButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        } else if (result.isDenied) {
            Swal.fire(`${courseCode} ${questType} INSTRUCTIONS were not uploaded!`, '', 'info')
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

let totalBox = document.querySelector(".total-box");

setInterval(sumBill, 1000);

function sumBill() {
    let schFee = parseInt(document.getElementById("sch_fee").value);
    let iCT = parseInt(document.getElementById("ict").value);
    let mUS = parseInt(document.getElementById("music").value);
    let hEA = parseInt(document.getElementById("health").value);
    let tRANS = parseInt(document.getElementById("transport").value);
    let eXC = parseInt(document.getElementById("excursion").value);
    let vS = parseInt(document.getElementById("vs_fee").value);
    let pTA = parseInt(document.getElementById("pta").value);
    let deV = parseInt(document.getElementById("development").value);
    let oTH = parseInt(document.getElementById("others").value);
    let sPOR = parseInt(document.getElementById("sport").value);

    /**If value is NaN, set value to 0 */
    if (!schFee) schFee = 0
    if (!iCT) iCT = 0
    if (!mUS) mUS = 0
    if (!hEA) hEA = 0
    if (!tRANS) tRANS = 0
    if (!eXC) eXC = 0
    if (!vS) vS = 0
    if (!pTA) pTA = 0
    if (!deV) deV = 0
    if (!oTH) oTH = 0
    if (!sPOR) sPOR = 0

    let totalBill = schFee + iCT + mUS + hEA + tRANS + eXC + vS + pTA + deV + oTH + sPOR;
    totalBox.innerHTML = `
        <div class="input-group">
        <span class="input-group-text">Total: <?= $currency; ?></span>
        <input readonly value="${totalBill}" class="form-control"></div>`;
}

/**To view bills */
let billContainer = document.querySelector(".bill-container");
billContainer.style.display = "none"

function openBills() {
    billContainer.style.display = "block";
    document.querySelector(".navigator").innerHTML = ` 
    <a class="btn btn-danger" onclick="closeBills();"><i class="mdi mdi-receipt"></i> Click to
                                close
                                student's bills</a>`;
}

function closeBills() {
    billContainer.style.display = "none";
    document.querySelector(".navigator").innerHTML = ` 
    <a class="btn btn-light" onclick="openBills();"><i class="mdi mdi-receipt"></i> Click to
                                view
                                student's bills</a>`;
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
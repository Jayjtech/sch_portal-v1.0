<script>
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
    let regFee = parseInt(document.getElementById("reg_fee").value);
    let uniform = parseInt(document.getElementById("uniform").value);
    let sWear = parseInt(document.getElementById("sport_wear").value);
    let cardigan = parseInt(document.getElementById("cardigan").value);
    let idCard = parseInt(document.getElementById("id_card").value);
    let hBook = parseInt(document.getElementById("handbook").value);
    let sMedia = parseInt(document.getElementById("sch_media").value);
    let security = parseInt(document.getElementById("security").value);
    let lesson = parseInt(document.getElementById("lesson").value);
    let club = parseInt(document.getElementById("club").value);
    let bFee = parseInt(document.getElementById("boarding_fee").value);
    let vocational = parseInt(document.getElementById("vocational").value);
    let sBadge = parseInt(document.getElementById("sch_badge").value);

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
    if (!regFee) regFee = 0
    if (!uniform) uniform = 0
    if (!sWear) sWear = 0
    if (!cardigan) cardigan = 0
    if (!idCard) idCard = 0
    if (!hBook) hBook = 0
    if (!sMedia) sMedia = 0
    if (!security) security = 0
    if (!lesson) lesson = 0
    if (!club) club = 0
    if (!bFee) bFee = 0
    if (!vocational) vocational = 0
    if (!sBadge) sBadge = 0

    let totalBill = schFee + iCT + mUS + hEA + tRANS + eXC + vS + pTA + deV + oTH + sPOR + regFee + uniform +
        sWear +
        cardigan + idCard + hBook + sMedia + security + lesson + club + bFee + vocational + sBadge;
    totalBox.innerHTML =
        `<div class="input-group">
        <span class="input-group-text">Total: <?= $currency; ?></span>
        <input readonly type="text" id="total-amount" name="total_amount" value="${totalBill}" class="form-control"></div>`;
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
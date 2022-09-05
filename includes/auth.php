<?php if($_SESSION['check_result'] > 1): 
    unset($_SESSION['userId']);
    if($det->userId){
        ?>
<script>
window.location.href = ""
</script>
<?php
    }
    ?>

<script>
Swal.fire({
    title: 'Enter your admission number to continue',
    input: 'text',
    inputAttributes: {
        autocapitalize: 'off',
        required: 'on'
    },
    showCancelButton: false,
    confirmButtonText: 'Verify',
    showLoaderOnConfirm: true,
    preConfirm: (login) => {
        return fetch(`functions/verifyUser.php?id=${login}`)
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
            imageUrl: result.value.avatar_url
        })
        if (result.value.icon === "error") {
            window.location.href = "logout"
        } else if (result.value.icon === "success") {
            window.location.href = "dashboard"
        }
    }
})
</script>
<?php endif; ?>
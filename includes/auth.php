<?php if($_SESSION['userCategory'] == true): ?>
<script>
Swal.fire({
    title: 'Enter your five digits pin',
    input: 'password',
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
            window.location.href = "login"
        }
    }
})
</script>
<?php endif; ?>
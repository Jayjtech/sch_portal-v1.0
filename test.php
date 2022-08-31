<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <input type="number" id="num" onkeyup="check();">
    <div class="response"></div>
    <script type="text/javascript">
    function check() {
        let userId = document.querySelector("#num").value;
        let res = document.getElementById("num")
        res.value = userId.toUpperCase();
        let response = document.querySelector(".response")
        response.textContent = userId * 5;
    }
    </script>




    <button onclick="clickMe()">Click Me</button>
    <script>
    function clickMe() {
        Swal.fire({
            title: 'Submit your Github username',
            input: 'number',
            inputAttributes: {
                autocapitalize: 'off',
                required: 'on'
            },
            showCancelButton: true,
            confirmButtonText: 'Look up',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                return fetch(`call.php?id=${login}`)
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
            }
        })
    }
    </script>
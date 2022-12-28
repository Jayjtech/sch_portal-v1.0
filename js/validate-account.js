// const accountNo = document.querySelector("#accountNo");
// const bankCode = document.querySelector("#bankCode");
// let nuBan = accountNo.value;
// accountNo.addEventListener("keyup", () => {
//     if(accountNo.value.length === 10){
//         validateAccount();
//     }
// })

// async function validateAccount(){
//     const request = await fetch("https://api.monnify.com//api/v1/disbursements/account/validate?accountNumber="+nuBan+"&bankCode=033");
//     const data = request.json();
//     console.log(data);
// }

$(document).ready(function(){
   $("#accountNo").keyup(function(){
    var nuBan = $("#accountNo").val();
    var bank = $("#bank").val();
    var split_bank = bank.split("|");
    var bank_title = split_bank[0];
    var bank_code = split_bank[1];
    var loading = $(".loading-img");

    if(bank === ""){
        swal.fire({
            title:"Please re-select your bank name!",
            text:"",
            icon:"warning"
        })
    }else if(nuBan.length === 10){
        loading.show();
        $.ajax({
            type:"POST",
            url: "./functions/payment_gateway/validate_account.php",
            data:{
                account_no:nuBan,
                bank_code: bank_code,
                bank_title: bank_title
            },
            success:(data) =>{
                let response = JSON.parse(data);
                const bankHolder = document.querySelector("#bankHolder");
                const valid = document.querySelector("#valid");
                if(response.responseMessage === "success"){
                    bankHolder.value=response.responseBody.accountName;
                    valid.value = 1;
                    loading.hide();
                }else{
                    loading.hide();
                    valid.value = 0;
                    swal.fire({
                        title:response.responseMessage+'!',
                        text:"Provide a valid bank account number",
                        icon:"warning"
                    })
                    
                }
            }
        })
    }
   }) 
})
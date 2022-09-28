<script>
/**Auto change status */
function walletBalance() {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "functions/payment_gateway/getWalletBal.php", false);
    xmlhttp.send(null);
    document.getElementById("walletResponse").innerHTML = xmlhttp.responseText;
}
walletBalance();
setInterval(function() {
    walletBalance();
}, 20000);

function getStatus() {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "functions/payment_gateway/getTransferStatus.php", false);
    xmlhttp.send(null);
    document.getElementById("statusResponse").innerHTML = xmlhttp.responseText;
}
getStatus();
setInterval(function() {
    getStatus();
}, 2000);
</script>
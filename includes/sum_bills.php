<script>
/**Calculate total bill */
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
</script>
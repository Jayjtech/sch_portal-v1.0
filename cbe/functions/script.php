<script>
const instructions = JSON.parse('<?= $instructions_json;?>');
const examDetails = JSON.parse('<?= $exam_detail; ?>');
const questions = JSON.parse(`<?= $output; ?>`);
const passageText = `<?= $passage; ?>`;

const startBtn = document.querySelector("#start-btn");
const reportForm = document.querySelector("#reportForm");
const mainEl = document.querySelector(".main-container");
const prevBtn = document.querySelector("#prev-btn");
const nextBtn = document.querySelector("#next-btn");
const questEl = document.querySelector(".quest-el");
const instructEl = document.getElementById("instruct-el");
const courseTitleEl = document.querySelector("#course-el");
const questCountEl = document.querySelector("#questCount-el");
const mainBody = document.querySelector(".container");
const submitBtn = document.querySelector(".btn-submit");
const passageEl = document.querySelector(".passage-el");
let showQuest = ""
let showOptions = ""
let answeredQuestions = []
let answeredEl = document.querySelector(".answered-el");
let nextSolBtn = document.querySelector("#next-sol");
let prevSolBtn = document.querySelector("#prev-sol");
let scoreHolder = document.querySelector("#score-holder");
let countDown = document.querySelector("#countDown-el");
let answeredQuest = document.querySelector("#answeredQuest");
let remainingMin = document.querySelector("#min-left");
let progressBar = document.querySelector(".progress");
let questNo = 0
let qNo = questNo + 1
isCorrect = ""
let score = []
let minLeft = 0;
let newScore = 0
let durationVal = examDetails.duration;

/**Checking if there is any tagged question*/
let taggQ = '<?= $tagged_questions; ?>';
let taggedQuestions = [];
if (taggQ == true) {
    taggedQuestions = JSON.parse(`<?= $tagged_questions; ?>`);
}



/**Checking the initial value of the score on the local storage */
if (localStorage.getItem('score')) {
    score = JSON.parse(localStorage.getItem('score'))
    let scoreDataLength = score.length - 1
    newScore = score[scoreDataLength];
} else {
    score = [];
}

/**Display continue exam if score array is not empty */
if (score.length != 0) {
    startBtn.textContent = "CONTINUE EXAM"
    // startBtn.style.backgroundColor = "rgb(234, 181, 46)"
    startBtn.classList.remove("btn-primary")
    startBtn.classList.add("btn-warning")
}

const questionLength = questions.length

/**Show course and number of questions dynamically */
// courseTitleEl.textContent += "CSS"

/*To get value of selected option, and check if correct */
/**When an answer is selected, move to the next question */
let selectAns = (chosenOpt) => {
    /**A temporary storage where I saved answered questions */
    isCorrect = questions[questNo].isCorrect
    answeredStorage = {
        questNum: questNo,
        qText: questions[questNo].quest,
        options: questions[questNo].ans,
        yourAns: chosenOpt,
        correctAns: isCorrect
    }


    /**Checking answeredQuestions Storage if question has been taken before*/
    const foundQuest = answeredQuestions.findIndex(function(find, foundQuest) {
        return find.questNum === answeredStorage.questNum
    })

    /**If question has not been answered, save into storage */
    if (foundQuest === questNo) {
        /**Calculate score */
        let prevAns = answeredQuestions[questNo].yourAns
        let newAns = chosenOpt

        /**Score Logic */
        if (prevAns === isCorrect && newAns === isCorrect) {
            newScore = newScore
        } else if (prevAns === isCorrect && newAns != isCorrect) {
            newScore = newScore - <?= $unit; ?>
        } else if (prevAns != isCorrect && newAns === isCorrect) {
            newScore = newScore + <?= $unit; ?>
        }
        answeredQuestions[questNo] = answeredStorage
    } else if (foundQuest != questNo) {
        /**Calculate newScore */
        if (chosenOpt === isCorrect) {
            newScore = newScore + <?= $unit; ?>
        }
        answeredQuestions[questNo] = answeredStorage
        score.push(newScore)
    }
    console.log(<?= $unit; ?>)
    /**Clear navigator container */
    answeredEl.innerHTML = ""

    for (i = 0; i < answeredQuestions.length; i++) {
        /**Calling chosen answer from answered storage and assigned to myChoice  */
        let myChoice = answeredQuestions[i].yourAns
        /**Converting chosen options to alphabet */
        let option = []
        if (myChoice === 0) {
            option = "A"
        } else if (myChoice === 1) {
            option = "B"
        } else if (myChoice === 2) {
            option = "C"
        } else if (myChoice === 3) {
            option = "D"
        }
        let nav = `<button class="btn btn-primary p-2" onclick="navigate(${i})">${i+1} ${option}</button>`
        answeredEl.innerHTML += nav
    }

    /**Creating local database */
    localStorage.setItem('answeredQuestions', JSON.stringify(answeredQuestions));
    let my_database = JSON.parse(localStorage.getItem('answeredQuestions'));
    answeredQuestions = my_database
    /**Save score to local storage after answering */
    saveScoreLocalStorage();
    nextQuest();
}

//Render instructions
for (i = 0; i < instructions.length; i++) {
    instructEl.innerHTML += `<li>${instructions[i]}</li>`
}

/**When start exam btn is clicked */
startBtn.addEventListener("click", function() {
    if (!localStorage.getItem('score')) {
        /**This will initiate the count down once the start button is clicked */
        setInterval(updateCountDown, 1000);
    }
    // setInterval(updateCountDown, 1000); /**Uncomment this if time should stop after refresh */
    saveScoreLocalStorage()
    nextBtn.style.display = "inline-flex"
    mainEl.innerHTML = ""
    submitBtn.style.display = "inline-flex"

    /**Save answered questions in local storage */
    if (localStorage.getItem('answeredQuestions')) {
        answeredQuestions = JSON.parse(localStorage.getItem('answeredQuestions'))
    } else {
        /**Create navigator */
        for (i = 0; i < questions.length; i++) {
            answeredQuestions.push("");
        }
    }
    renderQuestion()
})

if (localStorage.getItem('score')) {
    /**This will continue the countdown even if student refreshes the page */
    setInterval(updateCountDown, 1000);
}

/**Render question */
function renderQuestion() {
    /**questId like Q1, Q2... */
    /**Check if question was tagged for passage */
    const questTag = taggedQuestions.find((check) => {
        return check === questions[questNo].qId
    })

    if (questTag) {
        /**Display passage if question exist in the tag */
        passageEl.innerHTML = passageText
    } else {
        passageEl.innerHTML = ""
    }
    /*save question*/
    if (questions[questNo].quest && questions[questNo].questImg) {
        showQuest = `
                <div class="row mb-3">
                    <span class="font-weight-bold col-sm-4 p-2 mt-2 mb-2"> ${qNo}. ${questions[questNo].quest}</span>
                    <div class="col-sm-8">
                        <img src="../images/exam/${questions[questNo].questImg}" width="500" height="350"  alt="Question Image">
                    </div>
                </div>
                    `;
    } else if (questions[questNo].questImg && !questions[questNo].quest) {
        showQuest = `
            <div class="row mb-3">
            ${qNo}
                    <div class="col-sm-12">
                        <img src="../images/exam/${questions[questNo].questImg}" width="500" height="350"  alt="Question Image">
                    </div>
                </div>
                    `;
    } else if (questions[questNo].quest && !questions[questNo].questImg) {
        showQuest = `<span class="font-weight-bold  p-2 mt-2 mb-2"> ${qNo}. ${questions[questNo].quest}</span>`;
    } else {
        showQuest = "";
    }

    questEl.innerHTML += showQuest
    isCorrect = questions[questNo].quest
    /*Call Options*/
    renderAnswers()
    questCountEl.textContent = `Question ${qNo} of ${questionLength}`
}

/**Assign letter to all options */
function assignLetterToOptions() {
    if (i === 0) {
        option = "A"
    } else if (i === 1) {
        option = "B"
    } else if (i === 2) {
        option = "C"
    } else if (i === 3) {
        option = "D"
    }
}

function renderAnswers() {
    for (i = 0; i < questions[questNo].ans.length; i++) {
        assignLetterToOptions()
        showOptions = `<div class="answer-btn">
                            <button id="ans" class="btn btn-primary" onclick="selectAns(${i})">${option}. ${questions[questNo].ans[i]}</button>
                        </div>`
        questEl.innerHTML += showOptions
    }
}

/**When Previous btn is clicked */
function nextQuest() {

    if (qNo < questionLength) {
        questNo++
        qNo++
        questEl.innerHTML = ""
        renderQuestion();
        if (qNo > 1) {
            prevBtn.style.display = "inline-flex"
        }
        if (qNo === questionLength) {
            nextBtn.style.display = "none"
        } else {
            nextBtn.style.display = "inline-flex"
        }
    }
    sendTotalScore()
}

/**When Previous btn is clicked */
function prevQuest() {
    if (qNo > 1) {
        questNo--
        qNo--
        questEl.innerHTML = ""
        renderQuestion();
        if (qNo === 1) {
            prevBtn.style.display = "none"
        } else if (qNo > 1) {
            nextBtn.style.display = "inline-flex"
        } else {
            prevBtn.style.display = "inline-flex"
        }
    }
}

/**To navigate questions */
let navigate = (chosenQuest) => {
    questEl.innerHTML = ""
    questNo = chosenQuest
    qNo = chosenQuest + 1
    if (qNo === 1) {
        prevBtn.style.display = "none"
        nextBtn.style.display = "inline-flex"
    } else if (qNo === questionLength) {
        nextBtn.style.display = "none"
    } else if (qNo > 1) {
        nextBtn.style.display = "inline-flex"
        prevBtn.style.display = "inline-flex"
    }
    renderQuestion();
}

function saveScoreLocalStorage() {
    /**Save score on local storage */
    if (localStorage.getItem('score')) {
        score = JSON.parse(localStorage.getItem('score'))
    } else {
        score = [];
    }
    score.push(newScore);
    localStorage.setItem('score', JSON.stringify(score));
    /**Proceed to the next question */
}


/**Sending score to the main database */
function sendTotalScore() {
    /**what mark does each question carry? */
    let markPerQuestion = 1
    /**Getting the number of values in the score array, 
     * in order to get the last value(The most recent score) */
    let scoreLength = score.length - 1
    /**Selecting the last value in the array */
    let totalScore = score[scoreLength]
    totalScore = markPerQuestion * totalScore
    /**Send total score to main database */
    scoreHolder.value = totalScore
}



// countDown
let startingMinute = durationVal;
let time = startingMinute * 60;

let timeLeft = [];
const initialDuration = time;

function updateCountDown() {
    let minutes = Math.floor(time / 60);
    let seconds = (time % 60);

    /**Get time left from local storage */
    if (localStorage.getItem('timeLeft')) {
        timeLeft = JSON.parse(localStorage.getItem('timeLeft'))
    } else {
        timeLeft = []
    }
    let timeLeftLength = timeLeft.length;
    if (timeLeftLength != false) {
        time = timeLeft[timeLeftLength - 1];
    } else {
        time = time;
    }

    seconds = seconds < 10 ? '0' + seconds : seconds;
    countDown.innerHTML = `Time left: ${minutes}m : ${seconds}s`;
    time--;

    let progress = (time / initialDuration) * 100;
    let proCol = "";
    if (progress < 10) {
        proCol = "danger"
    } else if (progress < 50) {
        proCol = "warning"
    } else if (progress >= 50) {
        proCol = "success"
    }
    /**Save time to local storage */
    progressBar.innerHTML = `<div class="progress-bar progress-bar-striped bg-${proCol} progress-bar-animated"
                                role="progressbar" style="width: ${progress}%;" aria-valuenow="25" aria-valuemin="0"
                                aria-valuemax="100"></div>`
    timeLeft.push(time);
    localStorage.setItem('timeLeft', JSON.stringify(timeLeft));
    minLeft = Math.floor(time / 60);
    if (time === 180) {
        notification();
    } else if (time <= 0) {
        /**Auto submit when time is up */
        answeredQuest.value = JSON.stringify(answeredQuestions);
        remainingMin.value = minLeft;
        /**Report form will be submitted automatically when time is up */
        reportForm.submit();
        localStorage.removeItem('score');
        localStorage.removeItem('answeredQuestions');
        localStorage.removeItem('timeLeft');
    }

    function notification() {
        if (progress > 0) {
            swal({
                title: `You have less than 3 minutes left`,
                text: `Exam will be submitted in less than 5 minutes`,
                icon: "warning",
                buttons: ["Continue", "Submit"],
                dangerMode: true

            }).then((isOkay) => {
                if (isOkay) {
                    reportForm.submit();
                }
            })
        } else {
            reportForm.submit();
        }
        return false;
    }
}

function submitExam(form) {
    swal({
        title: `Are you sure you want to submit?`,
        text: `You won't be able to take this course anymore after you have submitted!`,
        icon: "warning",
        buttons: ["No", "Yes"],
        dangerMode: true

    }).then((isOkay) => {
        if (isOkay) {
            answeredQuest.value = JSON.stringify(answeredQuestions);
            remainingMin.value = minLeft;
            form.submit();
            localStorage.removeItem('score');
            localStorage.removeItem('answeredQuestions');
            localStorage.removeItem('timeLeft');
        }
    })
    return false;
}
</script>
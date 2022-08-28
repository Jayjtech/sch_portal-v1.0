    const startBtn = document.querySelector("#start-btn")
    const mainEl = document.querySelector(".main-container")
    const prevBtn = document.querySelector("#prev-btn")
    const nextBtn = document.querySelector("#next-btn")
    const questEl = document.querySelector(".quest-el")
    const instructEl = document.getElementById("instruct-el")
    const courseTitleEl = document.querySelector("#course-el")
    const questCountEl = document.querySelector("#questCount-el")
    const mainBody = document.querySelector(".container")
    const submitBtn = document.querySelector(".btn-submit")
    let showQuest = ""
    let showOptions = ""
    let answeredQuestions = []
    let answeredEl = document.querySelector(".answered-el")
    let nextSolBtn = document.querySelector("#next-sol")
    let prevSolBtn = document.querySelector("#prev-sol")
    /**Instructions */
let instructions = [
                    "Read the questions carefully",
                    "No examination malpractice",
                    "No side talk",
                    "If you have any question, simply signify"
                ]
    /**Questions */

let questions = [
                {
                    quest: "What is the full meaning of CSS?",
                    ans:[
                        "Cascaded Style Sheet",
                        "Cascaded Sheet Style",
                        "Communication Style Shaft",
                        "Computing Style Sheet"
                    ],
                    isCorrect: 0
                },
                {
                    quest: "HTML stands for ______",
                    ans:[
                        "Hyper Transfer Markup Language",
                        "Hyper Text Markup Language",
                        "High Translator Makeup Language",
                        "Help Transfer Markup Language"
                    ],
                    isCorrect: 1
                },
                {
                    quest: "Which of these is not a data type in JavaScript",
                    ans:[
                        "String",
                        "Array",
                        "Function",
                        "Integer"
                    ],
                    isCorrect: 2
                },
                {
                    quest: "Who is the father of computer",
                    ans:[
                        "Bill Gate",
                        "Isaac Newton",
                        "Charles Babbage",
                        "Micheal Faraday"
                    ],
                    isCorrect: 2
                },
                {
                    quest: "______ is the fastest means of transportation",
                    ans:[
                        "Land",
                        "Air",
                        "Pipe",
                        "Water"
                    ],
                    isCorrect: 1
                },
                {
                    quest: "ICT stands for ________",
                    ans:[
                        "Information and Community Technology",
                        "Information and Communication Technology",
                        "Informal Communication Technology",
                        "Independent Commission Telecommunication"
                    ],
                    isCorrect: 1
                },
                {
                    quest: "_______ has made the world a global society",
                    ans:[
                        "Food",
                        "Vacations",
                        "Entertainment",
                        "Computer"
                    ],
                    isCorrect: 3
                }
            ]

let questNo = 0
let qNo = questNo+1
isCorrect = ""
let score = []
let newScore = 0

/**Checking the initial value of the score on the local storage */
if(localStorage.getItem('score')){
    score = JSON.parse(localStorage.getItem('score'))
    let scoreDataLength = score.length - 1
        newScore = score[scoreDataLength];
}else{
    score = [];
}

/**Display continue exam if score is not equal to 0 */
if(newScore != 0){
    startBtn.textContent = "CONTINUE EXAM"
    startBtn.style.backgroundColor = "rgb(234, 181, 46)"
}

const questionLength = questions.length

/**Show course and number of questions dynamically */
courseTitleEl.textContent += "CSS"

/*To get value of selected option, and check if correct */
/**When an answer is selected, move to the next question */
    let selectAns = (choosenOpt)=>{
        /**A temporary storage where I saved answered questions */
        isCorrect = questions[questNo].isCorrect
        answeredStorage = {
            questNum: questNo,
            qText:  questions[questNo].quest,
            options:  questions[questNo].ans,
            yourAns: choosenOpt,
            correctAns: isCorrect
        }

       
            /**Checking answeredQuestions Storage if question has been taken before*/
         const foundQuest = answeredQuestions.findIndex(function(find, foundQuest){
                return find.questNum === answeredStorage.questNum
            })

            /**If question has not been answered, save into storage */
            if(foundQuest === questNo){
                /**Calculate score */
               let prevAns = answeredQuestions[questNo].yourAns
               let newAns = choosenOpt
            
               /**Score Logic */
               if(prevAns === isCorrect && newAns === isCorrect){
                    newScore = newScore
               }else if(prevAns === isCorrect && newAns != isCorrect){
                    newScore = newScore - 1
               }else if(prevAns != isCorrect && newAns === isCorrect){
                    newScore = newScore + 1
               }
               answeredQuestions[questNo] = answeredStorage
            } else if(foundQuest != questNo){
                /**Calculate newScore */
                if(choosenOpt === isCorrect){
                    newScore = newScore + 1 
                }
                answeredQuestions[questNo] = answeredStorage
                score.push(newScore)
            }
            /**Clear navigator container */
             answeredEl.innerHTML = ""
             
            for(i = 0; i < answeredQuestions.length; i++){
                /**Calling chosen answer from answered storage and assigned to myChoice  */
                let myChoice = answeredQuestions[i].yourAns
                /**Converting chosen options to alphabet */
                    let option = []
                    if(myChoice === 0){
                        option = "A"
                    }else if(myChoice === 1){
                        option = "B"
                    }else if(myChoice === 2){
                        option = "C"
                    }else if(myChoice === 3){
                        option = "D"
                    }
                let nav = `<button onclick="navigate(${i})">${i+1} ${option}</button>`
                    answeredEl.innerHTML += nav
            }

          /**Creating local database */
        localStorage.setItem('answeredQuestions', JSON.stringify(answeredQuestions));
        let my_database  = JSON.parse(localStorage.getItem('answeredQuestions'));
        answeredQuestions = my_database

        saveScoreLocalStorage();
        nextQuest();
    }

//Render instructions
for(i = 0; i < instructions.length; i++){
    instructEl.innerHTML += `<li>${instructions[i]}</li>`
}


/**When start exam btn is clicked */
startBtn.addEventListener("click", function(){
    saveScoreLocalStorage()
    nextBtn.style.display = "inline-flex"
    mainEl.innerHTML = ""
    submitBtn.style.display = "inline-flex"
      /**Save answered questions in local storage */
        if(localStorage.getItem('answeredQuestions')){
            answeredQuestions = JSON.parse(localStorage.getItem('answeredQuestions'))
        }else{
             /**Create navigator */
            for(i = 0; i < questions.length; i++){
                answeredQuestions.push("")
            }
        }
    renderQuestion()
})

/**Render question */
function renderQuestion(){
    /*save question*/
    showQuest = `<p> ${qNo}. ${questions[questNo].quest}</p>`
    questEl.innerHTML += showQuest
    isCorrect = questions[questNo].quest
    /*Call Options*/
    renderAnswers()
    questCountEl.textContent = `Question ${qNo} of ${questionLength}`
}

/**Assign letter to all options */
function assignLetterToOptions(){
        if(i === 0){
            option = "A"
        }else if(i === 1){
            option = "B"
        }else if(i === 2){
            option = "C"
        }else if(i === 3){
            option = "D"
        }
}


function renderAnswers(){
for(i = 0; i < questions[questNo].ans.length; i++){
        assignLetterToOptions()
        showOptions = `<div class="answer-btn">
                            <button id="ans" onclick="selectAns(${i})">${option}. ${questions[questNo].ans[i]}</button>
                        </div>`
        questEl.innerHTML += showOptions
    }
}

/**When Previous btn is clicked */
function nextQuest(){
    
    if(qNo < questionLength){
        questNo++
        qNo++
        questEl.innerHTML = ""
        renderQuestion();
        if(qNo > 1){
            prevBtn.style.display = "inline-flex"
        }
        if(qNo === questionLength){
            nextBtn.style.display = "none"
        }else{
            nextBtn.style.display = "inline-flex"
        }
    }
}

/**When Previous btn is clicked */
function prevQuest(){
    if(qNo > 1){
        questNo--
        qNo--
        questEl.innerHTML = ""
        renderQuestion();
        if(qNo === 1){
            prevBtn.style.display = "none"
        }else if(qNo > 1){
            nextBtn.style.display = "inline-flex"
        }else{
            prevBtn.style.display = "inline-flex"
        }
    }
}

/**To navigate questions */
let navigate = (chosenQuest) => {
    questEl.innerHTML = ""
    questNo = chosenQuest
    qNo = chosenQuest+1
    if(qNo === 1){
        prevBtn.style.display = "none"
        nextBtn.style.display = "inline-flex"
    }else if(qNo === questionLength){
        nextBtn.style.display = "none"
    }else if(qNo > 1){
        nextBtn.style.display = "inline-flex"
        prevBtn.style.display = "inline-flex"
    }
    renderQuestion();
}

function saveScoreLocalStorage(){
        /**Save score on local storage */
        if(localStorage.getItem('score')){
            score = JSON.parse(localStorage.getItem('score'))
        }else{
            score = [];
        }
        score.push(newScore);
        localStorage.setItem('score', JSON.stringify(score));
        /**Proceed to the next question */
    }    






function submitExam(){
    let scoreLength = score.length - 1
    let totalScore = score[scoreLength]
    submitBtn.style.display = "none"

    /**Calculating Score */
    let supposedPercentage = 100
    let percentScore = (totalScore/questionLength)*100
        percentScore = Math.round(percentScore)
    
    if(percentScore === 100){
        msgObj = {
            color: "Green",
            imgUrl: "img/excellent.png",
            remark: "An excellent",
            message: `Congratulations dear, you scored ${percentScore}%`
                }
        }else if(percentScore >= 70) {
        msgObj = {
            color: "lightGreen",
            imgUrl: "img/good.png",
            remark: "A good",
            message: `You scored ${percentScore}% out of ${supposedPercentage}%`
        }
    }else if(percentScore >= 45){
        msgObj = {
                color: "orange",
                imgUrl: "img/good.png",
                remark: "A fair",
                message: `You scored ${percentScore}% out of ${supposedPercentage}%`
            }
    }else if(percentScore >= 1){
        msgObj = {
                color: "red",
                imgUrl: "img/poor.png",
                remark: "A poor",
                message: `You scored ${percentScore}% out of ${supposedPercentage}%`
            }
    }else if(percentScore === 0){
        msgObj = {
                color: "red",
                imgUrl: "img/vpoor.png",
                remark: "An extremely poor",
                message: `Too bad, You scored nothing.`
            }
    }

    let result = `
        <div class="result">
            <img src="${msgObj.imgUrl}" width=100 all="">
            <h4 class="remark">${msgObj.remark} result!<h4>
            <p style="color:${msgObj.color};">${msgObj.message}</p>
            <button id="view-sol" onclick="viewSolution()">View solution</button>
        </div>
    `
    mainBody.innerHTML = ""
    mainBody.innerHTML = result
}

function viewSolution(){
    mainBody.innerHTML = questEl.innerHTML = ""
    questNum = 0
    qNo = questNum+1
            
   renderSol()
    }
function renderSol(){
     solQuest = `<p>${qNo}. ${answeredQuestions[questNum].qText}</p>`
    mainBody.innerHTML = questEl.innerHTML += solQuest
    for(i = 0; i < answeredQuestions[questNum].options.length; i++){
            assignLetterToOptions()
            correctAns = answeredQuestions[questNum].correctAns
            yourAns = answeredQuestions[questNum].yourAns

            if(i === correctAns){color = "lightGreen"}else{color = null}
            if(i === yourAns){colorWrong = "red"}else{colorWrong = null}

            showOptions = `<div class="solution-view">
                                <button style="background-color:${color};color:${colorWrong};">${option}. ${answeredQuestions[questNum].options[i]}</button>
                            </div>`
            mainBody.innerHTML += showOptions
    }
    questCountEl.textContent = `Question ${qNo} of ${questionLength}`
    nextSolBtn.style.display = "inline-flex"
}
  
/**When Previous btn is clicked */

function nextSol(){
    mainBody.innerHTML = questEl.innerHTML = ""
 if(qNo < answeredQuestions.length){
        questNum++
        qNo++
     renderSol()
   if(qNo > 1){
            prevSolBtn.style.display = "inline-flex"
        }
        if(qNo === answeredQuestions.length){
            nextSolBtn.style.display = "none"
        }else{
            nextSolBtn.style.display = "inline-flex"
        }
    }
}
/**When Previous btn is clicked */
function prevSol(){
    mainBody.innerHTML = questEl.innerHTML = ""
  if(qNo > 1){
        questNum--
        qNo--

        renderSol()
        if(qNo === 1){
            prevSolBtn.style.display = "none"
        }else if(qNo > 1){
            nextSolBtn.style.display = "inline-flex"
        }else{
            prevSolBtn.style.display = "inline-flex"
        }
    }
}
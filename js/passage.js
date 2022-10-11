const screenEl = document.querySelector("#screen-el");
const passage = document.querySelector("#passage");
const questListEl = document.querySelector(".quest-list-el");
let taggedQ = []
if (screenEl.value == "") {
    taggedQ = []
} else {
    taggedQ = JSON.parse(screenEl.value)
}

let addQuest = (chosenQuest) => {
    if (!screenEl.value.includes(chosenQuest)) {
        taggedQ.push(chosenQuest)
    } else {
        /**Arrow function to remove question number */
        let removeElement = (array, n) => {
            let newArray = [];
            for (let i = 0; i < array.length; i++) {
                if (array[i] !== n) {
                    newArray.push(array[i]);
                }
            }
            return newArray;
        };

        let passed_in_array = taggedQ;
        let element_to_be_removed = chosenQuest;
        taggedQ = removeElement(passed_in_array, element_to_be_removed);
    }
    screenEl.textContent = JSON.stringify(taggedQ);
    /**Clear question list */
    questListEl.innerHTML = ""
    for (x = 0; x < (taggedQ.length); x++) {
        let questList = `${taggedQ[x]}, `;
        questListEl.innerHTML += `<span>${questList}</span>`
    }
}

function addPassage(form) {
    if (screenEl.value == '[]') {
        swal.fire({
            title: `You haven't tagged any question yet?`,
            text: ``,
            icon: `info`
        })
    } else if (passage.value.length < 10) {
        swal.fire({
            title: `Passage too short?`,
            text: ``,
            icon: `info`
        })
    } else {
        swal.fire({
            title: `Are you sure you want to save changes?`,
            text: ``,
            icon: `info`,
            showDenyButton: true,
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit()
            }
        })
    }
    return false
}
                       
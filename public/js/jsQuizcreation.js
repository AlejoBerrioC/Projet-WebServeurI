const questionContainer = document.getElementById('question-container');
const addQuestionButton = document.getElementById('add-question');

let questionCount = 5;

// Function to add a new question
function createQuestionElement(number){
    const questionDiv = document.createElement('div');
    questionDiv.className = 'question-container';

    questionDiv.innerHTML = `
        <label for="question-${number}">Question ${number}:</label>
        <input type="text" id="question-${number}" name="question-${number}" placeholder="Enter the question" required>
        <br><br>
        <label for="answer-${number}">Answer ${number}:</label>
        <input type="text" id="answer-${number}" name="answer-${number}" placeholder="Enter the answer" required>
        <br><br>
        <button type="button" id="remove-question" onclick="removeQuestion(this)">Remove Question</button>
    `;

    return questionDiv;
}

for (let i = 1; i <= questionCount; i++) {
    questionContainer.appendChild(createQuestionElement(i));
}

addQuestionButton.addEventListener('click', () => {
    questionCount++;
    const newQuestion = createQuestionElement(questionCount);
    questionContainer.appendChild(newQuestion);
});

// Function to remove a question
function removeQuestion(button) {
    const questionDiv = button.parentElement;
    questionContainer.removeChild(questionDiv);
}
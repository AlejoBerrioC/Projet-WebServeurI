document.getElementById('save-answer-btn').addEventListener('click', function(event) {
    event.preventDefault();
    const currentQuestionId = this.getAttribute('data-current-question-id');
    const selectedAnswer = document.querySelector('input[name="answer"]:checked');
    

    
    if(!selectedAnswer) {
        alert('Please select an answer!');
        return;
    }   

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/Projet-WebServeurI/app/Controllers/QuizController.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if(response.status === 'success') {
                if(response.nextQuestion){
                    updateQuestion(response.nextQuestion);
                } else {
                    document.getElementById('quiz-resultat').innerHTML = `<p>You have completed the quiz!</p>`;
                }
            } else{
                alert(response.message);
            }
        }
    };
    xhr.send(`currentQuestionId=${currentQuestionId}&answerId=${selectedAnswer.value}`);

});

function updateQuestion(question) {
    const quizContainer = document.getElementById('question-container');

    quizContainer.innerHTML = `
        <div class="question-container" id="question-${question.id}">
            <div class="image-question">
                <img src="${question.image_url}" alt="Question Image">
            </div>
            <div class="question-options">
                <div class="question-text">
                    <h1>${question.text}</h1>
                </div>
                <form action="" method="post" class="question-form" id="question-form-${question.id}">
                    <div class="answers">
                        <table class="answers-table">
                            <tr>
                                ${question.answers.map(answer => `
                                    <td>
                                        <input type="radio" name="answer" id="answer-${answer.id}" value="${answer.id}">
                                        <label for="answer-${answer.id}">${answer.answer_text}</label>
                                    </td>
                                `).join('')}
                            </tr>
                        </table>
                        <button type="button" name="save-answer" id="save-answer-btn" data-current-question-id="${question.id}">Save Answer</button>
                    </div>    
                </form>
            </div>
        </div>
    `;


    document.getElementById('save-answer-btn').addEventListener('click', function(event) {
        event.preventDefault();
        const currentQuestionId = this.getAttribute('data-current-question-id');
        const selectedAnswer = document.querySelector('input[name="answer"]:checked');
        
    
        
        if(!selectedAnswer) {
            alert('Please select an answer!');
            return;
        }   
    
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/Projet-WebServeurI/app/Controllers/QuizController.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if(response.status === 'success') {
                    if(response.nextQuestion){
                        updateQuestion(response.nextQuestion);
                    } else {
                        document.getElementById('quiz-resultat').innerHTML = `<p>You have completed the quiz!</p>`;
                    }
                } else{
                    alert(response.message);
                }
            }
        };
        xhr.send(`currentQuestionId=${currentQuestionId}&answerId=${selectedAnswer.value}`);
    
    });
}
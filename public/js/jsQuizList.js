//Function pour la creation d'un quiz
function creationQuiz(){
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'quizList.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const contentFrame = window.parent.document.querySelector('iframe[name="contentFrame"]');
            if (contentFrame){
                contentFrame.src = "./quizCreation.php";
            }
        }
    };

    xhr.send("action=createQuiz");
}

//Function pour la suppression d'un utilisateur
$(document).on('click', '[data-target="#delete-quiz-modal"]', function () {
    var quizId = $(this).data('quiz-id');
    $('#delete-quiz-id').val(quizId);
});

function deleteQuiz(){
    var quizId = $('#delete-quiz-id').val();
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'quizList.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            if(xhr.responseText === 'success') {
                $('#quiz-row-' + quizId).remove();
                location.reload();
            } else {
                alert('Une erreur est survenue lors de la suppression de l\'utilisateur.');
            }
        }
    };
    xhr.send('delete-quiz-id=${quizId}');
}
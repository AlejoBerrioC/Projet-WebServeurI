function creationQuiz(){
    const contentFrame = window.parent.document.querySelector('iframe[name="contentFrame"]');
    if (contentFrame){
        contentFrame.src = "./quizCreation.php";
    } else{
        window.location.href = "./quizCreation.php";
    }
}
function startQuiz(){
    const contentFrame = window.parent.document.querySelector('iframe[name="contentFrame"]');
    if (contentFrame){
        contentFrame.src = "./quizPage.php";
    } else{
        window.location.href = "./quizPage.php";
    }
}
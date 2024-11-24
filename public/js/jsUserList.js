function creationAdmin(){
    const contentFrame = window.parent.document.querySelector('iframe[name="contentFrame"]');
    if (contentFrame){
        contentFrame.src = "./adminCreation.php";
    } else{
        window.location.href = "./adminCreation.php";
    }
}
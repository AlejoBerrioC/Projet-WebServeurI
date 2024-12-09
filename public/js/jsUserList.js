//Ajouter un admin
function creationAdmin(){
    const contentFrame = window.parent.document.querySelector('iframe[name="contentFrame"]');
    if (contentFrame){
        contentFrame.src = "./adminCreation.php";
    } else{
        window.location.href = "./adminCreation.php";
    }
}

//Function pour la suppression d'un utilisateur
$(document).on('click', '[data-target="#delete-user-modal"]', function () {
    var userId = $(this).data('user-number');
    $('#delete-user-id').val(userId);
});

function deleteUser(){
    var userId = $('#delete-user-id').val();
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'userList.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            if(xhr.responseText === 'success') {
                $('#user-row-' + userId).remove();
                location.reload();
            } else {
                alert('Une erreur est survenue lors de la suppression de l\'utilisateur.');
            }
        }
    };
    xhr.send('delete-user-id=${userId}');
}
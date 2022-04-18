window.revealEditComment = function revealEditComment(id) {
    var formElement = document.querySelector('#edit-comment-form-' + id);
    if (formElement.style.display != 'none') {
        formElement.style.display = 'none';
    }
    else {
        formElement.style.display = 'flex';
    }
};
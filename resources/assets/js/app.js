window.onload = function() {
    var editComment = document.getElementsByClassName('comment--edit'),
    editForm = document.getElementById('edit-comment-form'),
    commentPanels = document.getElementsByClassName('comment_panel'),
    newCommentForm = document.getElementById('comment-add-form'),
    commentContent = null,
    commentId = null;

    if (editForm) {
        var editField = editForm.querySelector('#edited-content'),
        editCommentSubmit = document.getElementById('comment--submit-edit');
    }

    for (var i = 0; i < editComment.length; i++) {
        editComment[i].addEventListener('click', function() {

            for (var i = commentPanels.length - 1; i >= 0; i--) {
                commentPanels[i].classList.add('is-display-none');
            }

            newCommentForm.classList.add('is-display-none');

            editForm.classList.add('is-display-block');
            commentId = this.parentNode.dataset.commentid;
            commentContent = this.parentNode.getElementsByClassName('comment-content')[0].innerHTML;

            editField.value = commentContent;
            editForm.action = (editForm.action + '/' + commentId);
            editForm.querySelector('#comment_id').value = commentId;
        });
    }

    if (editCommentSubmit && editForm && commentPanels) {
        editForm.classList.remove('is-display-block');
        newCommentForm.classList.remove('is-display-none');
        newCommentForm.classList.add('is-display-block');

        for (var i = commentPanels.length - 1; i >= 0; i--) {
            commentPanels[i].classList.remove('is-display-none');
            commentPanels[i].classList.add('is-display-block');
        }
    }
};
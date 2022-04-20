const axios = require('axios').default;

window.newComment = function (postid) {
    // Get the relevant body
    body = document.body.querySelector('#body-' + postid).value;
    console.log(body);
    // Params are (URL, body, options)
    axios.post(
        '/comments',
        {
            'post_id': postid,
            'body': body
        },
        {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
            }
        })
        .then(function (response) {
            console.log(response);
            // Get our old comments
            var currentComments = document.body.querySelector('.post-comments-' + postid);
            // Now we need to make it html to query select it
            var text = response.data;
            const parser = new DOMParser();
            const htmlDocument = parser.parseFromString(text, "text/html");
            // Get our new comment
            htmlDocument.documentElement.querySelector('#see-more-' + postid).style.display = 'block';
            newComments = htmlDocument.documentElement.querySelector('.post-comments-' + postid);
            // Replace the divs
            currentComments.replaceWith(newComments);
        })
        .catch(function (error) {
            console.log(error);
        });
}

window.revealCommentSectionElem = function revealCommentSectionElem(id, isNew) {
    var prefix = (isNew === false) ? '#edit-comment-form-' : '#new-comment-';
    var formElement = document.querySelector(prefix + id);
    if (formElement.style.display != 'none') {
        formElement.style.display = 'none';
    }
    else {
        formElement.style.display = 'block';
    }
};

window.seeMore = function revealSeeMore(postid) {
    var seeMoreElem = document.querySelector('#see-more-' + postid);
    if (seeMoreElem.style.display != 'none') {
        seeMoreElem.style.display = 'none';
    }
    else {
        seeMoreElem.style.display = 'block';
    }
};
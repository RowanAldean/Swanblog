const axios = require('axios').default;

window.newComment = function (postid, body) {
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
            var currentComments = document.body.querySelector('#comment-section-' + postid);
            // Now we need to make it html to query select it
            var text = response.data;
            const parser = new DOMParser();
            const htmlDocument = parser.parseFromString(text, "text/html");
            // Get our new comments
            const newComments = htmlDocument.documentElement.querySelector('#comment-section-' + postid);
            // Replace the divs
            currentComments.replaceWith(newComments);
            // Now let's update the recent comment
            var oldRecent = document.body.querySelector('#recent-comment-' + postid);
            recent = htmlDocument.documentElement.querySelector('#comment-section-' + postid + ' .comment-card');
            recent.id = '#recent-comment-' + postid;
            oldRecent.replaceWith(recent);
            console.log(recent);
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
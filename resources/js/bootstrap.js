window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

var myModalEl = document.getElementById('notif-modal');
var modal = bootstrap.Modal.getOrCreateInstance(myModalEl);

window.Echo.private('users.' + window.Laravel.user)
    .notification((notification) => {
        var commenter = notification['commenter'];
        var comment = notification['comment-received'];
        var post_id = comment['post_id'];

        var modalContentElem = document.getElementById('notif-content');
        var url = "http://swanblog.test/p/" + post_id;
        var anchor = "<a class='text-indigo-700' href='" + url + "'>" + url + "</a>";
        modalContentElem.innerHTML = "<span>You received a new comment on your post from " + commenter +
            "<br>Click here to view: " + anchor + "</span > ";
        modal.show();
    });

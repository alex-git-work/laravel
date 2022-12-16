import _ from 'lodash';
import axios from 'axios';
import io from 'socket.io-client';
import Echo from 'laravel-echo';

window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

window.io = io;

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

/**
 * Restores default state of modal window when it's closed.
 */
$('#staticBackdrop').on('hidden.bs.modal', function () {
    $('#staticBackdropLabel').text('');
    $('.modal-body').empty();
    $('.modal-footer').empty().prepend($('<button>', {
        type: 'button',
        class: 'btn btn-secondary js-close',
        text: 'Закрыть'
    }).attr('data-dismiss', 'modal'));
});

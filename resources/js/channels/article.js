Echo.private('admin.article').listen('.article.updated', (e) => {
    $('#staticBackdropLabel').text('Статья обновлена');

    let body = $('.modal-body');

    body.append(
        $('<h3>', {text: e.title}),
        $('<p>', {class: 'text-danger font-weight-bold', text: 'Было:'})
    );

    $.each(e.old, function (key, value) {
        body.append(
            $('<p>', {text: value}).prepend($('<span>', {class: 'font-weight-bold', text: key + ': '}))
        );
    });

    body.append(
        $('<p>', {class: 'text-success font-weight-bold', text: 'Стало:'})
    );

    $.each(e.current, function (key, value) {
        body.append(
            $('<p>', {text: value}).prepend($('<span>', {class: 'font-weight-bold', text: key + ': '}))
        );
    });

    $('.modal-footer').prepend($('<a>', {
        class: 'btn btn-primary js-link',
        text: 'Посмотреть',
        href: e.link
    }));

    $('#staticBackdrop').modal('show');
});

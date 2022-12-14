Echo.private('admin.article').listen('.article.updated', (e) => {
    console.log(e.title);
});

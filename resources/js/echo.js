Echo.channel('blog_testing').listen('TestEvent', (e) => {
    alert(e.string);
    console.log(e.string);
});

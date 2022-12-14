Echo.channel('testing').listen('TestEvent', (e) => {
    alert(e.string);
    console.log(e.string);
});

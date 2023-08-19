requirejs.config({
        // baseUrl: '/js/libs',
        baseUrl: '/dist',
        paths: {
            app: '../app',
        },
        urlArgs: "v=" + (new Date()).getTime(),
});

require(
    [
        'app.bundle',
    ],
    function(
        appBundle,
        ) {

    }
);
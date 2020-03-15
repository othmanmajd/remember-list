$(document).ready(function () {
    /** List of items, they are selected */
    var dtCBoxList = [];
    $('.dt-cbox').on('click', function () {
        dtCBoxList = [];
        $('.dt-cbox').each(function () {
            var elem = $(this).data('id');
            if ($(this).is(":checked")) {
                dtCBoxList.push(elem);
            }
        });
        $('#itemsSelected').val(dtCBoxList.join(","));
    });
});
/**
 * push Notification
 * @param msg
 */
function notifyMe(msg) {
    if (window.Notification && Notification.permission !== "granted") {
        Notification.requestPermission(function (status) {
            if (Notification.permission !== status) {
                Notification.permission = status;
            }
        });
    }
    // If the user agreed to get notified
    if (window.Notification && Notification.permission === "granted") {
        var n = new Notification('New Item: ' + msg, {
            body: "Remember List",
            icon: '/assets/img/logo-blue.png'
        });
        n.onclick = function () {
            window.open(document.URL);
        };
    } else if (window.Notification && Notification.permission !== "denied") {
        Notification.requestPermission(function (status) {
            // If the user said okay
            if (status === "granted") {
                var n = new Notification('New Product: ' + msg, {
                    body: "Remember the milk:",
                    icon: '/assets/img/logo-blue.png'
                });
                n.onclick = function () {
                    window.open(document.URL);
                };
            }
        });
    }
}

requestPermission();

/**
 * to ask clint allow to send Notifications
 * @returns {Promise<unknown>}
 */
function requestPermission() {
    return new Promise(function (resolve, reject) {
        const permissionResult = Notification.requestPermission(function (result) {
            // Handling deprecated version with callback.
            resolve(result);
        });

        if (permissionResult) {
            permissionResult.then(resolve, reject);
        }
    })
        .then(function (permissionResult) {
            if (permissionResult !== 'granted') {
                throw new Error('Permission not granted.');
            }
        });
}
function sendNotification(title, options,  force) {
    force =  force == null?false :force;
// Проверим, поддерживает ли браузер HTML5 Notifications
    if (!("Notification" in window)) {
        alert('Ваш браузер не поддерживает HTML Notifications, его необходимо обновить.');
    }

// Проверим, есть ли права на отправку уведомлений
    else if (Notification.permission === "granted") {
// Если права есть, отправим уведомление
        var notification = new Notification(title, options);

        function clickFunc() {
            alert('Пользователь кликнул на уведомление');
        }

        notification.onclick = clickFunc;
    }

// Если прав нет, пытаемся их получить
    else if (force||Notification.permission !== 'denied') {
        Notification.requestPermission(function (permission) {
// Если права успешно получены, отправляем уведомление
            if (permission === "granted") {
                var notification = new Notification(title, options);

            } else {
                alert('Вы запретили показывать уведомления'); // Юзер отклонил наш запрос на показ уведомлений
            }
        });
    } else {
// Пользователь ранее отклонил наш запрос на показ уведомлений
// В этом месте мы можем, но не будем его беспокоить. Уважайте решения своих пользователей.
    }
}
intervalID =  setInterval(function(){
    sendNotification('Что сделано ? ', {
        'body': 'Тестирование HTML5 Notifications',
        'icon': 'tasks-solid.svg',
        'requireInteraction':true,
        'dir': 'auto'
    });

},  3600*1000);
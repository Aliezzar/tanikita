<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .notification-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .notification-header {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .notification-list {
            list-style: none;
            padding: 0;
        }

        .notification-item {
            background: #f9f9f9;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>

    <div class="notification-container">
        <div class="notification-header">Notifikasi</div>
        <ul class="notification-list" id="notificationList">
            <li class="notification-item">Memuat notifikasi...</li>
        </ul>
    </div>

    <script>
        function fetchNotifications() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', '/api/get-notifications.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const notifications = JSON.parse(xhr.responseText);
                    const notificationList = document.getElementById('notificationList');
                    notificationList.innerHTML = '';

                    if (notifications.length > 0) {
                        notifications.forEach(notification => {
                            const li = document.createElement('li');
                            li.className = 'notification-item';
                            li.textContent = notification.message;
                            notificationList.appendChild(li);
                        });
                    } else {
                        notificationList.innerHTML = '<li class="notification-item">Tidak ada notifikasi.</li>';
                    }
                }
            };
            xhr.send();
        }

        // Fetch notifications on page load
        document.addEventListener('DOMContentLoaded', fetchNotifications);
    </script>
</body>

</html>
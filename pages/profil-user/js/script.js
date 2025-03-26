function deleteAccount() {
    if (confirm('Apakah kamu yakin ingin menghapus akun ini?')) {
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = 'pages/login-register/deleteAccount.php';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'deleteAccount';
        input.value = 'true';
        form.appendChild(input);

        document.body.appendChild(form);
        form.submit();
    }
}

function href(url) {
        window.location.href = url;
}

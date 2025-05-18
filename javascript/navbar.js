window.addEventListener("scroll", function() {
    var nav = this.document.querySelector("nav");
    nav.classList.toggle("sticky", window.scrollY > 0);
});


function href(url) {
    window.location.href = url;
}


function deleteAccount() {
    Swal.fire({
        title: 'Apakah kamu yakin?',
        text: "Akun ini akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '/tanikita/pages/login-register/deleteAccount.php';

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'deleteAccount';
            input.value = 'true';
            form.appendChild(input);

            document.body.appendChild(form);
            form.submit();
        }
    });
}


// untuk hamburger

const menuToggle = document.querySelector('.menu-toggle input');
const nav = document.querySelector('nav ul');

menuToggle.addEventListener('click', function() {
    nav.classList.toggle('slide')
});
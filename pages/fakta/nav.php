<style>
    /* Navbar */
    body {
        overflow-x: hidden;
    }

    @media screen and (max-width: 768px) {
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.6s;
            -webkit-transition: 0.6s;
            -moz-transition: 0.6s;
            -ms-transition: 0.6s;
            -o-transition: 0.6s;
            padding: 5px 10px;
            z-index: 999999;
            backdrop-filter: blur(3px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        nav.sticky {
            padding: 2px 100px;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(3px);
        }

        nav a.logo {
            color: var(--secondary);
            font-size: 2.5rem;
            /* width:150 */
        }

        nav .logo span {
            color: var(--primary);
        }


        nav ul {
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 70%;
            margin-bottom: 0px;
        }

        nav ul li {
            position: relative;
            list-style: none;
        }

        nav ul li a {
            position: relative;
            margin: 0 15px;
            text-decoration: none;
            color: var(--secondary);
            letter-spacing: 2px;
            font-weight: 500px;
            transition: 0.6s;
            -webkit-transition: 0.6s;
            -moz-transition: 0.6s;
            -ms-transition: 0.6s;
            -o-transition: 0.6s;
            overflow: hidden;
            display: inline-block;
        }

        nav ul li a::before,
        nav ul li a::after {
            content: '';
            position: absolute;
            width: 100%;
            left: 0;
        }

        nav ul li a::before {
            background-color: #dbeb00;
            height: 2px;
            bottom: 0;
            transform-origin: 100% 50%;
            transform: scaleX(0);
            transition: transform .3s cubic-bezier(0.76, 0, 0.24, 1);
            -webkit-transition: transform .3s cubic-bezier(0.76, 0, 0.24, 1);
            -moz-transition: transform .3s cubic-bezier(0.76, 0, 0.24, 1);
            -ms-transition: transform .3s cubic-bezier(0.76, 0, 0.24, 1);
            -o-transition: transform .3s cubic-bezier(0.76, 0, 0.24, 1);
            -webkit-transform: scaleX(0);
            -moz-transform: scaleX(0);
            -ms-transform: scaleX(0);
            -o-transform: scaleX(0);
        }

        nav ul li a::after {
            content: attr(data-replace);
            height: 100%;
            top: 0;
            transform-origin: 100% 50%;
            transform: translate3d(200%, 0, 0);
            transition: transform .3s cubic-bezier(0.76, 0, 0.24, 1);
            color: #C0EBA6;
            -webkit-transition: transform .3s cubic-bezier(0.76, 0, 0.24, 1);
            -moz-transition: transform .3s cubic-bezier(0.76, 0, 0.24, 1);
            -ms-transition: transform .3s cubic-bezier(0.76, 0, 0.24, 1);
            -o-transition: transform .3s cubic-bezier(0.76, 0, 0.24, 1);
            -webkit-transform: translate3d(200%, 0, 0);
            -moz-transform: translate3d(200%, 0, 0);
            -ms-transform: translate3d(200%, 0, 0);
            -o-transform: translate3d(200%, 0, 0);
        }

        nav ul li a:hover::before {
            transform-origin: 0% 50%;
            transform: scaleX(1);
            -webkit-transform: scaleX(1);
            -moz-transform: scaleX(1);
            -ms-transform: scaleX(1);
            -o-transform: scaleX(1);
        }

        nav ul li a:hover::after {
            transform: translate3d(0, 0, 0);
            -webkit-transform: translate3d(0, 0, 0);
            -moz-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            -o-transform: translate3d(0, 0, 0);
        }

        nav.sticky img,
        nav.sticky ul li a {
            color: var(--secondary);
        }

        .menu-toggle input {
            display: none;

        }

        /* Hamburger Menu */
        .menu-toggle {
            display: flex;
            flex-direction: column;
            height: 20px;
            justify-content: space-between;
            position: relative;
        }

        .menu-toggle input {
            display: block;
            position: absolute;
            width: 40px;
            height: 28px;
            left: -5px;
            top: -3px;
            opacity: 0;
            cursor: pointer;
            opacity: 0;
            z-index: 3;
        }

        .menu-toggle span {
            display: flex;
            width: 28px;
            height: 3px;
            background-color: green;
            border-radius: 3px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            -ms-border-radius: 3px;
            -o-border-radius: 3px;
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
            -ms-transition: all 0.5s;
            -o-transition: all 0.5s;
        }

        .menu-toggle span:nth-child(2) {
            transform-origin: 0 0;
        }

        .menu-toggle input:checked~span:nth-child(2) {
            background-color: white;
            transform: rotate(45deg) translate(-1px, -1px);
            -webkit-transform: rotate(45deg) translate(-1px, -1px);
            -moz-transform: rotate(45deg) translate(-1px, -1px);
            -ms-transform: rotate(45deg) translate(-1px, -1px);
            -o-transform: rotate(45deg) translate(-1px, -1px);
        }

        .menu-toggle span:nth-child(4) {
            transform-origin: 0 100%;
        }

        .menu-toggle input:checked~span:nth-child(4) {
            background-color: white;
            transform: rotate(-45deg) translate(-1px, 0);
            -webkit-transform: rotate(-45deg) translate(-1px, 0);
            -moz-transform: rotate(-45deg) translate(-1px, 0);
            -ms-transform: rotate(-45deg) translate(-1px, 0);
            -o-transform: rotate(-45deg) translate(-1px, 0);
        }

        .menu-toggle input:checked~span:nth-child(3) {
            opacity: 0;
            transform: scale(0);
            -webkit-transform: scale(0);
            -moz-transform: scale(0);
            -ms-transform: scale(0);
            -o-transform: scale(0);
        }

        /* Navbar end */
    }
</style>


<script>
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

    window.addEventListener("scroll", function() {
        var nav = this.document.querySelector("nav");
        nav.classList.toggle("sticky", window.scrollY > 0);
    });


    // untuk hamburger

    const menuToggle = document.querySelector('.menu-toggle input');
    const nav = document.querySelector('nav ul');

    menuToggle.addEventListener('click', function() {
        nav.classList.toggle('slide')
    });
</script>

<nav style="color: black;">
    <a href="../.." class="logo">Qualy<span>Check</span></a>
    <ul style="color: black;">
        <li><a href="../../#home">Home</a></li>
        <li><a href="../../#informasi">informasi</a></li>
        <li><a href="../about.php">Tentang Kami</a></li>
        <?php if (isset($_SESSION['username'])) { ?>
            <li>
                <a href="../login-register/logout.php">Log out</a>
            </li>
            <li>
                <a onclick="deleteAccount()" style="cursor: pointer;">Hapus Akun</a>
            </li>
        <?php } else { ?>
            <li>
                <a href="../login-register">Sign in / Sign up</a>
            </li>
        <?php } ?>
    </ul>
    <div class="menu-toggle">
        <input type="checkbox">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>
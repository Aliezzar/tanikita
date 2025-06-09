<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

    .wrapper-sidebar * {
        font-family: 'Poppins', sans-serif;
    }

    .wrapper-sidebar {
        height: 100%;
        width: 290px;
        position: relative;
    }

    .sidebar * {
        font-family: 'Poppins', sans-serif !important;
    }

    .sidebar {
        position: fixed;
        height: 100%;
        width: 270px;
        background-color: #404040;
        overflow: hidden;
    }

    .full-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
    }

    .sidebar .title {
        color: #f2f2f2;
        font-size: 25px;
        font-weight: 600;
        line-height: 65px;
        background: #333;
        text-align: center;
    }

    .sidebar .list-items {
        position: relative;
        background: #404040;
        height: 100%;
        width: 100%;
        list-style: none;
    }

    .sidebar .list-items li {
        padding-left: 40px;
        line-height: 50px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        border-bottom: 1px solid #333;
    }

    .sidebar .list-items li:hover {
        box-shadow: 0 0 10px 3px #222;
        border-top: 1px solid transparent;
        border-bottom: 1px solid transparent;
    }

    .sidebar .list-items li a {
        color: #fff;
        text-decoration: none;
        font-size: 18px;
        font-weight: 500;
        height: 100%;
        width: 100%;
        display: block;
    }

    .sidebar .list-items li a i {
        margin-right: 20px;
    }
</style>

<!-- sidebar -->
<aside class="wrapper-sidebar">
    <aside class="sidebar">
        <div class="title">
            Menu
        </div>

        <ul class="list-items">
            <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/pages/projek/index.php"><i class="fas fa-home"></i>Dashboard</a></li>
            <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/pages/projek/postinganSaya/index.php"><i class="fas fa-file-alt"></i>Postingan Saya</a></li>
            <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/pages/projek/history/index.php"><i class="fas fa-history"></i>History</a></li>
        </ul>
    </aside>
</aside>
<!-- sidebar end -->

<!-- javascript -->
<script>
    function ifSidebarScroll() {
        var aside = this.document.querySelector("aside.sidebar");
        aside.classList.toggle("full-sidebar", window.scrollY > 14);
    }

    window.addEventListener("scroll", ifSidebarScroll);
</script>
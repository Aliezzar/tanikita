<!-- Sidebar -->
<style>
    .sidebar {
        width: 16rem;
        background-color: #1f2937;
        color: white;
        height: 100vh;
        position: sticky;
        top: 0;
        z-index: 9999;
    }

    .title-sidebar {
        padding: 1rem;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .sidebar nav.sidebar-container {
        margin-top: 2.5rem;
        display: flex;
        flex-direction: column;
        gap: 2rem;
        align-items: center;
    }

    .sidebar nav.sidebar-container .child-sidebar {
        background-color: #1F2937;
        display: block;
        border-radius: 0.375rem;
        transition: 0.2s;
        color: white;
        text-decoration: none;
    }
</style>

<aside class="sidebar">
    <div class="title-sidebar">
        <span style="color: #9ca3af;">Panel</span> Admin
    </div>
    <nav class="sidebar-container">
        <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/admin/index.php" class="child-sidebar">
            <i class="fas fa-tachometer-alt" style="margin-right: 0.5rem;"></i> Manajemen Pengguna
        </a>
        <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/admin/manajemen_post/index.php" class="child-sidebar">
            <i class="fas fa-edit" style="margin-right: 0.5rem;"></i> Manajemen postingan
        </a>
        <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/admin/laporan_pengguna/index.php" class="child-sidebar">
            <i class="fas fa-flag" style="margin-right: 0.5rem; color: red;"></i> Laporan Pengguna
        </a>
    </nav>
</aside>
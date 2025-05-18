<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        footer {
            background-color: var(--primary);
            text-align: center;
            padding: 1rem 0 3rem;
            margin-top: 3rem;
        }

        footer .socials {
            padding: 1rem 0;
        }

        footer .socials a {
            color: white;
            margin: 1rem;
        }

        footer .socials a:hover,
        footer .links a:hover {
            color: var(--bg);
        }

        footer .links {
            margin-bottom: 1.4rem;
        }

        footer .links a {
            color: #000;
            padding: 0.7rem 1rem;
        }

        footer .credit {
            font-size: 0.8rem;
        }

        footer .credit a {
            color: var(--bg);
            font-weight: 700;
        }
    </style>
</head>

<body>
    <footer>
        <div class="socials">
            <a href="#"><i data-feather="instagram"></i></a>
            <a href="#"><i data-feather="twitter"></i></a>
            <a href="#"><i data-feather="facebook"></i></a>
        </div>

        <div class="links">
            <a href="<?= $_SERVER['DOCUMENT_ROOT']; ?>">Halaman Utama</a>
            <a href="#informasi">Tentang Kami</a>
            <a href="#menu">Menu</a>
            <a href="#contact">Kontak</a>
        </div>

        <div class="credit">
            <p>Creater by <a href="/tanikita/index.php">aliezzarwijaya</a>. | &copy; 2024.</p>
        </div>
    </footer>
</body>

</html>
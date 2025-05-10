@php
    $setting = \App\Models\Setting::first();
@endphp
<style>
    @media (max-width: 768px) {

        .navmenu a,
        .navmenu a:focus {
            color: black;
            padding: 0px !important;
            font-family: var(--nav-font);
            font-size: 18px !important;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: space-between;
            white-space: nowrap;
            transition: 0.3s;
            background: none !important
        }

        .bi::before,
        [class^="bi-"]::before,
        [class*=" bi-"]::before {
            display: inline-block;
            font-size: 17px !important;
        }

        .btn-getstarted {
            display: none !important
        }

        .header .logo img {
            max-height: 28px !important;
            margin-right: 8px;
        }
    }



    @media (max-width: 1199px) {

        .navmenu a,
        .navmenu a:focus {
            color: black;
            padding: 0px !important;
            font-family: var(--nav-font);
            font-size: 18px !important;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: space-between;
            white-space: nowrap;
            transition: 0.3s;
            background: none !important
        }
    }

    .header .logo img {
        max-height: 28px !important;
        margin-right: 8px;
    }

    .header .btn-getstarted,
    .header .btn-getstarted:focus {
        color: black;
        background: white;
        font-size: 20px;
        padding: 8px 25px;
        margin: 0 0 0 30px;
        border-radius: 35px;
        transition: 0.3s;
        font-weight: 600;
        border: 2px solid black;
    }

    .header .btn-getstarted,
    .header .btn-getstarted:hover {
        color: black;
        background: white;
        font-size: 20px;
        padding: 8px 25px;
        margin: 0 0 0 30px;
        border-radius: 35px;
        transition: 0.3s;
        font-weight: 600;
        border: 2px solid black;
    }
</style>


<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="/" class="logo d-flex align-items-center me-auto">
            <img src="{{ asset('assets/img/logo/' . $setting->logo) }}" style="max-width:200px!important;">
        </a>

        <nav id="navmenu" class="navmenu">
            <div class="social-links d-flex responsive-social-links">
                <a href="https://wa.me/6282210008380" target="_blank"><i style="font-size: 25px !important;"
                        class="bi bi-whatsapp"></i></a>
                <a href="https://www.tiktok.com/@satu.printing?_t=8sEIq5opyTg&_r=1" target="_blank"><i
                        style="font-size: 25px !important;" class="bi bi-tiktok"></i></a>
                <a href="#" target="_blank"><i style="font-size: 25px !important;" class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/satuprinting.id?igsh=dmxlczlyamlyMWg1" target="_blank"><i
                        style="font-size: 25px !important;" class="bi bi-instagram"></i></a>
                <a href="https://youtube.com/@satuprintingindonesia?si=TFJI704YpKeVO_lc" target="_blank"><i
                        style="font-size: 25px !important;" class="bi bi-youtube"></i></a>
                <a class="btn-getstarted" href="#kategori">DAFTAR HARGA</a>
            </div>
            <i class="mobile-nav-toggle d-xl-none bi bi-list d-none"></i>
        </nav>


    </div>
</header>

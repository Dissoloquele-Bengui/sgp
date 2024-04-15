<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================--><!--    Document Title--><!-- ===============================================-->
    <title>@yield('title')</title>

    <!-- ===============================================--><!--    Favicons--><!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicons/favicon.ico">
    <link rel="manifest" href="/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="/assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <script src="/assets/js/config.js"></script>
    <script src="/vendors/simplebar/simplebar.min.js"></script>

    <!-- ===============================================--><!--    Stylesheets--><!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <link href="/vendors/simplebar/simplebar.min.css" rel="stylesheet">
    <link href="/assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl">
    <link href="/assets/css/theme.min.css" rel="stylesheet" id="style-default">
    <link href="/assets/css/user-rtl.min.css" rel="stylesheet" id="user-style-rtl">
    <link href="/assets/css/user.min.css" rel="stylesheet">
    <script>
        var isRTL = JSON.parse(localStorage.getItem('isRTL'));
        if (isRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>
</head>

<body>
    <!-- ===============================================--><!--    Main Content--><!-- ===============================================-->
    <main class="main" id="top">
        <div class="container-fluid" data-layout="container">
            <nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
                <script>
                    var navbarStyle = localStorage.getItem("navbarStyle");
                    if (navbarStyle && navbarStyle !== 'transparent') {
                        document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
                    }
                </script>
                <div class="d-flex align-items-center">
                    <div class="toggle-icon-wrapper">
                        <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle"
                            data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Toggle Navigation"
                            data-bs-original-title="Toggle Navigation"><span class="navbar-toggle-icon"><span
                                    class="toggle-line"></span></span></button>
                    </div><a class="navbar-brand" href="../index.html">
                        <div class="d-flex align-items-center py-3">
                            <!-- <img class="me-2"
                        src="../assets/img/icons/spot-illustrations/falcon.png" alt="" width="40" /> -->
                            <span class="font-sans-serif text-primary bg-warnging">LAB-FÍSICA</span>
                        </div>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
                    <div class="navbar-vertical-content scrollbar">
                        <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                            <li class="nav-item"><!-- parent pages--><a class="nav-link dropdown-indicator"
                                    href="#cinematica" role="button" data-bs-toggle="collapse" aria-expanded="true"
                                    aria-controls="cinematica">
                                    <div class="d-flex align-items-center"><span class="nav-link-icon"><svg
                                                class="svg-inline--fa fa-chart-pie fa-w-17" aria-hidden="true"
                                                focusable="false" data-prefix="fas" data-icon="chart-pie" role="img"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 544 512"
                                                data-fa-i2svg="">
                                                <path fill="currentColor"
                                                    d="M527.79 288H290.5l158.03 158.03c6.04 6.04 15.98 6.53 22.19.68 38.7-36.46 65.32-85.61 73.13-140.86 1.34-9.46-6.51-17.85-16.06-17.85zm-15.83-64.8C503.72 103.74 408.26 8.28 288.8.04 279.68-.59 272 7.1 272 16.24V240h223.77c9.14 0 16.82-7.68 16.19-16.8zM224 288V50.71c0-9.55-8.39-17.4-17.84-16.06C86.99 51.49-4.1 155.6.14 280.37 4.5 408.51 114.83 513.59 243.03 511.98c50.4-.63 96.97-16.87 135.26-44.03 7.9-5.6 8.42-17.23 1.57-24.08L224 288z">
                                                </path>
                                            </svg><!-- <span class="fas fa-chart-pie"></span> Font Awesome fontawesome.com --></span>
                                        <span class="nav-link-text ps-1">Cinemática</span>
                                    </div>
                                </a>
                                <ul class="nav collapse show" id="cinematica">
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.labs.mru') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">MRU</span></div>
                                        </a><!-- more inner pages--></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.labs.mruv') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">MRUV</span></div>
                                        </a><!-- more inner pages--></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.labs.lo') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">L.O</span></div>
                                        </a><!-- more inner pages--></li>

                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.labs.mcu') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">MCU</span></div>
                                        </a><!-- more inner pages--></li>

                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.labs.mcuv') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">MCUV</span></div>
                                        </a><!-- more inner pages--></li>

                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('admin.labs.colisao') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Colisão</span></div>
                                        </a><!-- more inner pages--></li>

                                </ul>
                            </li>
                            <li class="nav-item"><!-- parent pages--><a class="nav-link dropdown-indicator"
                                    href="#estatica" role="button" data-bs-toggle="collapse" aria-expanded="true"
                                    aria-controls="estatica">
                                    <div class="d-flex align-items-center"><span class="nav-link-icon"><svg
                                                class="svg-inline--fa fa-chart-pie fa-w-17" aria-hidden="true"
                                                focusable="false" data-prefix="fas" data-icon="chart-pie"
                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 544 512" data-fa-i2svg="">
                                                <path fill="currentColor"
                                                    d="M527.79 288H290.5l158.03 158.03c6.04 6.04 15.98 6.53 22.19.68 38.7-36.46 65.32-85.61 73.13-140.86 1.34-9.46-6.51-17.85-16.06-17.85zm-15.83-64.8C503.72 103.74 408.26 8.28 288.8.04 279.68-.59 272 7.1 272 16.24V240h223.77c9.14 0 16.82-7.68 16.19-16.8zM224 288V50.71c0-9.55-8.39-17.4-17.84-16.06C86.99 51.49-4.1 155.6.14 280.37 4.5 408.51 114.83 513.59 243.03 511.98c50.4-.63 96.97-16.87 135.26-44.03 7.9-5.6 8.42-17.23 1.57-24.08L224 288z">
                                                </path>
                                            </svg><!-- <span class="fas fa-chart-pie"></span> Font Awesome fontawesome.com --></span>
                                        <span class="nav-link-text ps-1">Estática</span>
                                    </div>
                                </a>
                                <ul class="nav collapse show" id="estatica">
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('admin.labs.alavancas-maquinas-simples') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Máquinas Simples</span></div>
                                        </a><!-- more inner pages--></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('admin.labs.equilibrio-forca') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Equilibrio de uma força</span></div>
                                        </a><!-- more inner pages--></li>

                                </ul>
                            </li>

                            <li class="nav-item"><!-- parent pages--><a class="nav-link dropdown-indicator"
                                href="#dinamica" role="button" data-bs-toggle="collapse"
                                aria-expanded="true" aria-controls="dinamica">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg
                                            class="svg-inline--fa fa-chart-pie fa-w-17" aria-hidden="true"
                                            focusable="false" data-prefix="fas" data-icon="chart-pie"
                                            role="img" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 544 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M527.79 288H290.5l158.03 158.03c6.04 6.04 15.98 6.53 22.19.68 38.7-36.46 65.32-85.61 73.13-140.86 1.34-9.46-6.51-17.85-16.06-17.85zm-15.83-64.8C503.72 103.74 408.26 8.28 288.8.04 279.68-.59 272 7.1 272 16.24V240h223.77c9.14 0 16.82-7.68 16.19-16.8zM224 288V50.71c0-9.55-8.39-17.4-17.84-16.06C86.99 51.49-4.1 155.6.14 280.37 4.5 408.51 114.83 513.59 243.03 511.98c50.4-.63 96.97-16.87 135.26-44.03 7.9-5.6 8.42-17.23 1.57-24.08L224 288z">
                                            </path>
                                        </svg><!-- <span class="fas fa-chart-pie"></span> Font Awesome fontawesome.com --></span>
                                    <span class="nav-link-text ps-1">Dinâmica</span>
                                </div>
                            </a>
                            <ul class="nav collapse show" id="dinamica">
                            
                                <li class="nav-item"><a class="nav-link"
                                    href="{{ route('admin.labs.segunda-Lei-de-Newton') }}">
                                    <div class="d-flex align-items-center"><span
                                            class="nav-link-text ps-1">2ª Lei de Newton</span></div>
                                </a><!-- more inner pages--></li>
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('admin.labs.forca-aplicadas-dois-corpos') }}">
                                        <div class="d-flex align-items-center"><span
                                                class="nav-link-text ps-1">3ª Lei de Newton</span></div>
                                    </a><!-- more inner pages--></li>
                                    <li class="nav-item"><a class="nav-link"
                                        href="{{ route('admin.labs.forca-tensao') }}">
                                        <div class="d-flex align-items-center"><span
                                                class="nav-link-text ps-1">Força de Tensão</span></div>
                                    </a><!-- more inner pages--></li>
                                    <li class="nav-item"><a class="nav-link"
                                        href="{{ route('admin.labs.forca-de-tensao-com-polias') }}">
                                        <div class="d-flex align-items-center"><span
                                                class="nav-link-text ps-1">Força de Tensão Com Polias</span></div>
                                    </a><!-- more inner pages--></li>
                                    
                                    
                            </ul>
                        </li>

                            <li class="nav-item"><!-- parent pages--><a class="nav-link dropdown-indicator"
                                    href="#trabalho-energia" role="button" data-bs-toggle="collapse"
                                    aria-expanded="true" aria-controls="trabalho-energia">
                                    <div class="d-flex align-items-center"><span class="nav-link-icon"><svg
                                                class="svg-inline--fa fa-chart-pie fa-w-17" aria-hidden="true"
                                                focusable="false" data-prefix="fas" data-icon="chart-pie"
                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 544 512" data-fa-i2svg="">
                                                <path fill="currentColor"
                                                    d="M527.79 288H290.5l158.03 158.03c6.04 6.04 15.98 6.53 22.19.68 38.7-36.46 65.32-85.61 73.13-140.86 1.34-9.46-6.51-17.85-16.06-17.85zm-15.83-64.8C503.72 103.74 408.26 8.28 288.8.04 279.68-.59 272 7.1 272 16.24V240h223.77c9.14 0 16.82-7.68 16.19-16.8zM224 288V50.71c0-9.55-8.39-17.4-17.84-16.06C86.99 51.49-4.1 155.6.14 280.37 4.5 408.51 114.83 513.59 243.03 511.98c50.4-.63 96.97-16.87 135.26-44.03 7.9-5.6 8.42-17.23 1.57-24.08L224 288z">
                                                </path>
                                            </svg><!-- <span class="fas fa-chart-pie"></span> Font Awesome fontawesome.com --></span>
                                        <span class="nav-link-text ps-1">Trabalho e Energia</span>
                                    </div>
                                </a>
                                <ul class="nav collapse show" id="trabalho-energia">
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('admin.labs.trabalho-energia.energia_cinetica') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Energia Cinética</span></div>
                                        </a><!-- more inner pages--></li>
                                        <li class="nav-item"><a class="nav-link"
                                            href="{{ route('admin.labs.trabalho-energia.energia_potencial') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Energia Potencial</span></div>
                                        </a><!-- more inner pages--></li>
                                        <li class="nav-item"><a class="nav-link"
                                            href="{{ route('admin.labs.trabalho-energia.plano_inclinado') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Plano Inclinado (forca peso)</span></div>
                                        </a><!-- more inner pages--></li>
                                        <li class="nav-item"><a class="nav-link"
                                            href="{{ route('admin.labs.trabalho-energia.energia_potencial_elastica') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Energia Potencial Elástica</span></div>
                                        </a><!-- more inner pages--></li>
                                        {{-- <li class="nav-item"><a class="nav-link"
                                            href="{{ route('admin.labs.forca-aplicadas-dois-corpos') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">1ª Lei de Newton </span></div>
                                        </a><!-- more inner pages--></li> --}}
                                        
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>

            <div class="content">
                <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand" style="display: none;">
                    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
                        aria-controls="navbarVerticalCollapse" aria-expanded="false"
                        aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                                class="toggle-line"></span></span></button>
                    <a class="navbar-brand me-1 me-sm-3" href="../index.html">
                        <div class="d-flex align-items-center"><img class="me-2"
                                src="../assets/img/icons/spot-illustrations/falcon.png" alt=""
                                width="40" /><span class="font-sans-serif text-primary">LAB-FÍSICA</span></div>
                    </a>


                </nav>

                <div class="row mb-3">
                    <div class="col">
                        <div class="card bg-100 shadow-none border">
                            <div class="row gx-0 flex-between-center">
                                <div class=" d-flex align-items-center">
                                    <div class="flex-1">

                                        <h4 class="text-primary fw-bold mb-0 text-center">LABORATÓRIO VIRTUAL<span
                                                class="text-info fw-medium"></span></h4>
                                    </div><img class="ms-n4 d-md-none d-lg-block"
                                        src="../assets/img/illustrations/crm-line-chart.png" alt=""
                                        width="150" />
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @yield('conteudo')

                <footer class="footer">
                    <div class="row g-0 justify-content-between fs-10 mt-4 mb-3">
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">Todos os direitos reservados<span
                                    class="d-none d-sm-inline-block">|
                                </span><br class="d-sm-none" /> {{ date('Y') }} &copy; <a href="">ITEL</a>
                            </p>
                        </div>
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">v1.0.0</p>
                        </div>
                    </div>
                </footer>
            </div>

        </div>
    </main>
    <!-- ===============================================--><!--    End of Main Content--><!-- ===============================================-->

    <div class="offcanvas offcanvas-end settings-panel border-0" id="settings-offcanvas" tabindex="-1"
        aria-labelledby="settings-offcanvas">
        <div class="offcanvas-header settings-panel-header bg-shape">
            <div class="z-1 py-1">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h5 class="text-white mb-0 me-2"><span class="fas fa-palette me-2 fs-9"></span>Settings</h5>
                    <button class="btn btn-primary btn-sm rounded-pill mt-0 mb-0" data-theme-control="reset"
                        style="font-size:12px">
                        <span class="fas fa-redo-alt me-1" data-fa-transform="shrink-3"></span>Reset</button>
                </div>
                <p class="mb-0 fs-10 text-white opacity-75"> Set your own customized style</p>
            </div>
            <div class="z-1" data-bs-theme="dark"><button class="btn-close z-1 mt-0" type="button"
                    data-bs-dismiss="offcanvas" aria-label="Close"></button></div>
        </div>
        <div class="offcanvas-body scrollbar-overlay px-x1 h-100" id="themeController">
            <h5 class="fs-9">Color Scheme</h5>
            <p class="fs-10">Choose the perfect color mode for your app.</p>
            <div class="btn-group d-block w-100 btn-group-navbar-style">
                <div class="row gx-2">
                    <div class="col-4"><input class="btn-check" id="themeSwitcherLight" name="theme-color"
                            type="radio" value="light" data-theme-control="theme" /><label
                            class="btn d-inline-block btn-navbar-style fs-10" for="themeSwitcherLight"> <span
                                class="hover-overlay mb-2 rounded d-block"><img class="img-fluid img-prototype mb-0"
                                    src="/assets/img/generic/falcon-mode-default.jpg" alt="" /></span><span
                                class="label-text">Light</span></label></div>
                    <div class="col-4"><input class="btn-check" id="themeSwitcherDark" name="theme-color"
                            type="radio" value="dark" data-theme-control="theme" /><label
                            class="btn d-inline-block btn-navbar-style fs-10" for="themeSwitcherDark"> <span
                                class="hover-overlay mb-2 rounded d-block"><img class="img-fluid img-prototype mb-0"
                                    src="/assets/img/generic/falcon-mode-dark.jpg" alt="" /></span><span
                                class="label-text"> Dark</span></label></div>
                    <div class="col-4"><input class="btn-check" id="themeSwitcherAuto" name="theme-color"
                            type="radio" value="auto" data-theme-control="theme" /><label
                            class="btn d-inline-block btn-navbar-style fs-10" for="themeSwitcherAuto"> <span
                                class="hover-overlay mb-2 rounded d-block"><img class="img-fluid img-prototype mb-0"
                                    src="/assets/img/generic/falcon-mode-auto.jpg" alt="" /></span><span
                                class="label-text"> Auto</span></label></div>
                </div>
            </div>
            <hr />
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-start"><img class="me-2"
                        src="/assets/img/icons/left-arrow-from-left.svg" width="20" alt="" />
                    <div class="flex-1">
                        <h5 class="fs-9">RTL Mode</h5>
                        <p class="fs-10 mb-0">Switch your language direction </p><a class="fs-10"
                            href="documentation/customization/configuration.html">RTL Documentation</a>
                    </div>
                </div>
                <div class="form-check form-switch"><input class="form-check-input ms-0" id="mode-rtl"
                        type="checkbox" data-theme-control="isRTL" /></div>
            </div>
            <hr />
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-start"><img class="me-2" src="/assets/img/icons/arrows-h.svg"
                        width="20" alt="" />
                    <div class="flex-1">
                        <h5 class="fs-9">Fluid Layout</h5>
                        <p class="fs-10 mb-0">Toggle container layout system </p><a class="fs-10"
                            href="documentation/customization/configuration.html">Fluid Documentation</a>
                    </div>
                </div>
                <div class="form-check form-switch"><input class="form-check-input ms-0" id="mode-fluid"
                        type="checkbox" data-theme-control="isFluid" /></div>
            </div>
            <hr />
            <div class="d-flex align-items-start"><img class="me-2" src="/assets/img/icons/paragraph.svg"
                    width="20" alt="" />
                <div class="flex-1">
                    <h5 class="fs-9 d-flex align-items-center">Navigation Position</h5>
                    <p class="fs-10 mb-2">Select a suitable navigation system for your web application </p>
                    <div><select class="form-select form-select-sm" aria-label="Navbar position"
                            data-theme-control="navbarPosition">
                            <option value="vertical">Vertical</option>
                            <option value="top">Top</option>
                            <option value="combo">Combo</option>
                            <option value="double-top">Double Top</option>
                        </select></div>
                </div>
            </div>
            <hr />
            <h5 class="fs-9 d-flex align-items-center">Vertical Navbar Style</h5>
            <p class="fs-10 mb-0">Switch between styles for your vertical navbar </p>
            <p> <a class="fs-10" href="modules/components/navs-and-tabs/vertical-navbar.html#navbar-styles">See
                    Documentation</a></p>
            <div class="btn-group d-block w-100 btn-group-navbar-style">
                <div class="row gx-2">
                    <div class="col-6"><input class="btn-check" id="navbar-style-transparent" type="radio"
                            name="navbarStyle" value="transparent" data-theme-control="navbarStyle" /><label
                            class="btn d-block w-100 btn-navbar-style fs-10" for="navbar-style-transparent"> <img
                                class="img-fluid img-prototype" src="/assets/img/generic/default.png"
                                alt="" /><span class="label-text">
                                Transparent</span></label></div>
                    <div class="col-6"><input class="btn-check" id="navbar-style-inverted" type="radio"
                            name="navbarStyle" value="inverted" data-theme-control="navbarStyle" /><label
                            class="btn d-block w-100 btn-navbar-style fs-10" for="navbar-style-inverted"> <img
                                class="img-fluid img-prototype" src="/assets/img/generic/inverted.png"
                                alt="" /><span class="label-text">
                                Inverted</span></label></div>
                    <div class="col-6"><input class="btn-check" id="navbar-style-card" type="radio"
                            name="navbarStyle" value="card" data-theme-control="navbarStyle" /><label
                            class="btn d-block w-100 btn-navbar-style fs-10" for="navbar-style-card"> <img
                                class="img-fluid img-prototype" src="/assets/img/generic/card.png"
                                alt="" /><span class="label-text"> Card</span></label></div>
                    <div class="col-6"><input class="btn-check" id="navbar-style-vibrant" type="radio"
                            name="navbarStyle" value="vibrant" data-theme-control="navbarStyle" /><label
                            class="btn d-block w-100 btn-navbar-style fs-10" for="navbar-style-vibrant"> <img
                                class="img-fluid img-prototype" src="/assets/img/generic/vibrant.png"
                                alt="" /><span class="label-text"> Vibrant</span></label></div>
                </div>
            </div>
            <div class="text-center mt-5"><img class="mb-4" src="/assets/img/icons/spot-illustrations/47.png"
                    alt="" width="120" />
                <h5>Like What You See?</h5>
                <p class="fs-10">Get Falcon now and create beautiful dashboards with hundreds of widgets.</p><a
                    class="mb-3 btn btn-primary"
                    href="https://themes.getbootstrap.com/product/falcon-admin-dashboard-webapp-template/"
                    target="_blank">Purchase</a>
            </div>
        </div>
    </div><a class="card setting-toggle" href="#settings-offcanvas" data-bs-toggle="offcanvas">
        <div class="card-body d-flex align-items-center py-md-2 px-2 py-1">
            <div class="bg-primary-subtle position-relative rounded-start" style="height:34px;width:28px">
                <div class="settings-popover"><span class="ripple"><span
                            class="fa-spin position-absolute all-0 d-flex flex-center"><span
                                class="icon-spin position-absolute all-0 d-flex flex-center"><svg width="20"
                                    height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M19.7369 12.3941L19.1989 12.1065C18.4459 11.7041 18.0843 10.8487 18.0843 9.99495C18.0843 9.14118 18.4459 8.28582 19.1989 7.88336L19.7369 7.59581C19.9474 7.47484 20.0316 7.23291 19.9474 7.03131C19.4842 5.57973 18.6843 4.28943 17.6738 3.20075C17.5053 3.03946 17.2527 2.99914 17.0422 3.12011L16.393 3.46714C15.6883 3.84379 14.8377 3.74529 14.1476 3.3427C14.0988 3.31422 14.0496 3.28621 14.0002 3.25868C13.2568 2.84453 12.7055 2.10629 12.7055 1.25525V0.70081C12.7055 0.499202 12.5371 0.297594 12.2845 0.257272C10.7266 -0.105622 9.16879 -0.0653007 7.69516 0.257272C7.44254 0.297594 7.31623 0.499202 7.31623 0.70081V1.23474C7.31623 2.09575 6.74999 2.8362 5.99824 3.25599C5.95774 3.27861 5.91747 3.30159 5.87744 3.32493C5.15643 3.74527 4.26453 3.85902 3.53534 3.45302L2.93743 3.12011C2.72691 2.99914 2.47429 3.03946 2.30587 3.20075C1.29538 4.28943 0.495411 5.57973 0.0322686 7.03131C-0.051939 7.23291 0.0322686 7.47484 0.242788 7.59581L0.784376 7.8853C1.54166 8.29007 1.92694 9.13627 1.92694 9.99495C1.92694 10.8536 1.54166 11.6998 0.784375 12.1046L0.242788 12.3941C0.0322686 12.515 -0.051939 12.757 0.0322686 12.9586C0.495411 14.4102 1.29538 15.7005 2.30587 16.7891C2.47429 16.9504 2.72691 16.9907 2.93743 16.8698L3.58669 16.5227C4.29133 16.1461 5.14131 16.2457 5.8331 16.6455C5.88713 16.6767 5.94159 16.7074 5.99648 16.7375C6.75162 17.1511 7.31623 17.8941 7.31623 18.7552V19.2891C7.31623 19.4425 7.41373 19.5959 7.55309 19.696C7.64066 19.7589 7.74815 19.7843 7.85406 19.8046C9.35884 20.0925 10.8609 20.0456 12.2845 19.7729C12.5371 19.6923 12.7055 19.4907 12.7055 19.2891V18.7346C12.7055 17.8836 13.2568 17.1454 14.0002 16.7312C14.0496 16.7037 14.0988 16.6757 14.1476 16.6472C14.8377 16.2446 15.6883 16.1461 16.393 16.5227L17.0422 16.8698C17.2527 16.9907 17.5053 16.9504 17.6738 16.7891C18.7264 15.7005 19.4842 14.4102 19.9895 12.9586C20.0316 12.757 19.9474 12.515 19.7369 12.3941ZM10.0109 13.2005C8.1162 13.2005 6.64257 11.7893 6.64257 9.97478C6.64257 8.20063 8.1162 6.74905 10.0109 6.74905C11.8634 6.74905 13.3792 8.20063 13.3792 9.97478C13.3792 11.7893 11.8634 13.2005 10.0109 13.2005Z"
                                        fill="#2A7BE4"></path>
                                </svg></span></span></span></div>
            </div><small
                class="text-uppercase text-primary fw-bold bg-primary-subtle py-2 pe-2 ps-1 rounded-end">customize</small>
        </div>
    </a>

    <!-- ===============================================--><!--    JavaScripts--><!-- ===============================================-->
    <script src="/vendors/popper/popper.min.js"></script>
    <script src="/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="/vendors/anchorjs/anchor.min.js"></script>
    <script src="/vendors/is/is.min.js"></script>
    <script src="/vendors/echarts/echarts.min.js"></script>
    <script src="/vendors/fontawesome/all.min.js"></script>
    <script src="/vendors/lodash/lodash.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="/vendors/list.js/list.min.js"></script>
    <script src="/assets/js/theme.js"></script>
</body>

</html>

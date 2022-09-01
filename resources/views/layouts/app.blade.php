<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- <title>ACCOUNT : Dashboard</title> -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <link href="{{ URL::asset('public/assets/css/account_section.css') }}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/7e802998de.js" crossorigin="anonymous"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="{{ URL::asset('public/assets/libs/dist/builder.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @yield('customStyle')
</head>

<body>
    <header class="d-flex flex-wrap justify-content-center py-3  border-bottom">
        <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <img src="{{ URL::asset('public/assets/img/h_logo.jpg') }}"
                alt="Hybrid Mail Account" class="account_logo" />
            <span class="fs-4">Welcome {{ ucfirst(Cache::get('userName')) }}</span></a>


        <ul class="nav nav-pills">
            <li class="nav-item"><a href="account.php" class="nav-link active" aria-current="page">My Account</a></li>
            <li class="nav-item"><a href="help.php" class="nav-link">Help & Support</a></li>
            <li class="nav-item"><a onclick="logout()" href="#" class="nav-link">Logout</a></li>
        </ul>
    </header>

    <main>
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white my_sidebar"
            style="width: 280px; min-height: calc(100vh - 130px)">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link" aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor"
                            class="bi bi-house-door" viewBox="0 0 16 16">
                            <path
                                d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ url('/campaign') }}" class="nav-link text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor"
                            class="bi bi-envelope-fill" viewBox="0 0 16 16">
                            <path
                                d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
                        </svg>
                        Campaigns
                    </a>
                </li>
                <li>
                    <a href="{{ url('/contact') }}" class="nav-link text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor"
                            class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        </svg>
                        Contacts
                    </a>
                </li>
                <li>
                    <a href="{{ url('/report') }}" class="nav-link text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor"
                            class="bi bi-bar-chart-line-fill" viewBox="0 0 16 16">
                            <path
                                d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2z" />
                        </svg>
                        Reports
                    </a>
                </li>
                <li>
                    <a href="{{ url('/template') }}" class="nav-link text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor"
                            class="bi bi-window-split" viewBox="0 0 16 16">
                            <path
                                d="M2.5 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1Zm2-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Zm1 .5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1Z" />
                            <path
                                d="M2 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2Zm12 1a1 1 0 0 1 1 1v2H1V3a1 1 0 0 1 1-1h12ZM1 13V6h6.5v8H2a1 1 0 0 1-1-1Zm7.5 1V6H15v7a1 1 0 0 1-1 1H8.5Z" />
                        </svg>
                        Templates
                    </a>
                </li>
                <li>
                    <a href="{{ url('/form') }}" class="nav-link text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                        </svg>
                        Forms
                    </a>
                </li>
                <li>
                    <a href="{{ url('/setting') }}" class="nav-link text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor"
                            class="bi bi-gear" viewBox="0 0 16 16">
                            <path
                                d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                            <path
                                d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                        </svg>
                        Settings
                    </a>
                </li>
                <li>
                    <div class="account_info">
                        <?php if(Cache::get('userPlan') == 2 || Cache::get('userPlan') == 3) {?>
                        <p>Your plan is
                            {{ Cache::get('userPlan') == 2 ? 'BUSINESS' : 'ENTERPRISE' }},
                            however subscription is not processed yet.</p>
                        <?php }?>
                        <div class="txt_plan">Plan
                            {{ Cache::get('userLevel') == 1 ? 'FREE' : (Cache::get('userLevel') == 2 ? 'BUSINESS' : 'ENTERPRISE') }}
                        </div>
                        <?php if(Cache::get('userLevel') == 1) {?>
                        <strong>200</strong> emails per day<br>
                        Basic Templates<br>
                        Unlimited Contacts<br>
                        Encryption & Security<br>
                        Reports<br>
                        Cross-Platform<br>
                        <a class="txt_plan"
                            href="{{ env('base_url'). '/?page_id=492' }}">Upgrade</a>
                        <?php } else if(Cache::get('userLevel') == 2) {?>
                        <strong>500,000</strong> emails per month<br>
                        Unlimited Campaigns<br>
                        Contact Form Builder<br>
                        Featured Templates<br>
                        Live Chat Support<br>
                        <a class="txt_plan"
                            href="{{ env('base_url'). '/?page_id=492' }}">Upgrade</a>
                        <?php } else if(Cache::get('userLevel') == 3) {?>
                        <strong>1,500,000</strong> emails per month<br>
                        Premium Templates<br>
                        Branding Features<br>
                        Upgraded Statistics<br>
                        <?php }?>

                    </div>
                </li>
            </ul>
        </div>

        @yield('content')
    </main>

    <footer class="d-flex flex-wrap align-items-center">
        <div class="my_copy">©2022 Copyrights HybridMail | All rights reserved | Company Number: 0000000 | Powered by <a
                href="#">TECHICS</a></div>
    </footer>
    @yield('script')
    <script>
        function logout() {
            window.location.href = "<?php echo env('base_url'). '?page_id=396&ihcdologout=true'?>";
        }

    </script>
</body>

</html>

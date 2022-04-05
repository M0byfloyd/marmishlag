<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marmishlag</title>
    <?php wp_head(); ?>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-box">
        <div class="container-fluid justify-content-between navbar-container">
            <a class="navbar-brand navbar-title" href="/">MIJOTON</a>
            <button class="navbar-toggler navbar-burger" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon navbar-burger-icons"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php get_search_form(); ?>
                <a href="#" class="navbar-connexion" id="open-search">
                    <svg viewBox="0 0 32 32" class="navbar-connexion-user">
                        <title />
                        <g id="about">
                            <path d="M16,16A7,7,0,1,0,9,9,7,7,0,0,0,16,16ZM16,4a5,5,0,1,1-5,5A5,5,0,0,1,16,4Z" />
                            <path
                                d="M17,18H15A11,11,0,0,0,4,29a1,1,0,0,0,1,1H27a1,1,0,0,0,1-1A11,11,0,0,0,17,18ZM6.06,28A9,9,0,0,1,15,20h2a9,9,0,0,1,8.94,8Z" />
                        </g>
                    </svg>
                    Connexion
                </a>
            </div>
        </div>
    </nav>


    <div class="container">

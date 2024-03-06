<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kids Platform</title>
    <link rel="stylesheet" href="css_pages/style.css">

    <link   href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</head>
<body>
    
<nav>
    <label class="logo">Kids Platform</label>

    <ul>
        <li><a href="">HOME</a></li>
        <li><a href="">ABOUT</a></li>
        <li><a href="">CONTACT</a></li>
        <li><a href="php_pages\register.php">REGISTER</a></li>
        <li><a href="php_pages\login.php">LOGIN</a></li>
    </ul>
</nav>

 <div class="container">

            <!-- First images slider -->
            <div class="row">
                <div class="col-md-12">
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                                aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="images/top1.png" class="img w-100"alt="image">
                                <div class="carousel-caption d-none d-md-block">
                                    <h3 class="text-danger">The name of the game</h3>
                                    <p class="lead">Some representative content for the game.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="images/top2.png" class="img w-100" alt="image">
                                <div class="carousel-caption d-none d-md-block">
                                    <h3 class="text-danger">The name of the game</h3>
                                    <p class="lead">Some representative content for the game.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="images/BT PuzzlestoriesMoleCave1.png" class="img w-100"  alt="image">
                                <div class="carousel-caption d-none d-md-block">
                                    <h3 class="text-danger">The name of the game</h3>
                                    <p class="lead">Some representative content for the game.</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Second images slider -->
            <div class="mt-4 row mx-auto my-auto justify-content-center">
                <div id="recipeCarousel" class="carousel slide small" data-bs-ride="small">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active small-carousel-item">
                            <div class="col-md-3">
                                <div class="">
                                    <div class="card-img">
                                        <img src="images/circle1.png" class="small-img">
                                    </div>
                                    <div class=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item small-carousel-item">
                            <div class="col-md-3">
                                <div class="">
                                    <div class="card-img">
                                        <img src="images/circle2.png" class="small-img">
                                    </div>
                                    <div class=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item small-carousel-item">
                            <div class="col-md-3">
                                <div class="">
                                    <div class="card-img">
                                        <img src="images/circle3.png" class="small-img">
                                    </div>
                                    <div class=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item small-carousel-item">
                            <div class="col-md-3">
                                <div class="">
                                    <div class="card-img">
                                        <img src="images/circle4.png" class="small-img">
                                    </div>
                                    <div class=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item small-carousel-item">
                            <div class="col-md-3">
                                <div class="">
                                    <div class="card-img">
                                        <img src="images/circle5.png" class="small-img">
                                    </div>
                                    <div class=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item small-carousel-item">
                            <div class="col-md-3">
                                <div class="">
                                    <div class="card-img">
                                        <img src="images/circle6.png" class="small-img">
                                    </div>
                                    <div class=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item small-carousel-item">
                            <div class="col-md-3">
                                <div class="">
                                    <div class="card-img">
                                        <img src="images/circle7.png" class="small-img">
                                    </div>
                                    <div class=""></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev small-color  w-aut" href="#recipeCarousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </a>
                    <a class="carousel-control-next small-color w-aut" href="#recipeCarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </a>
                </div>
            </div>  

            <center>
                <div class="selected">
                <h3>Recommended</h3>
                </div>
            </center>


            <!-- Third images slider -->


               <div class="mt-4 row mx-auto my-auto justify-content-center">
                <div id="recipeCarouse2" class="carousel slide small" data-bs-ride="small">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active small-carousel-item">
                            <div class="col-md-3">
                                <div class="">
                                    <div class="card-img">
                                        <img src="images/film5.png" alt="film5" class="big-img">
                                    </div>
                                    <div class=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item small-carousel-item">
                            <div class="col-md-3">
                                <div class="">
                                    <div class="card-img">
                                        <img src="images/card2.png" alt="card2" class="big-img">
                                    </div>
                                    <div class=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item small-carousel-item">
                            <div class="col-md-3">
                                <div class="">
                                    <div class="card-img">
                                        <img src="images/card3.png" alt="card3" class="big-img">
                                    </div>
                                    <div class=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item small-carousel-item">
                            <div class="col-md-3">
                                <div class="">
                                    <div class="card-img">
                                        <img src="images/card4.png" alt="card4" class="big-img">
                                    </div>
                                    <div class=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item small-carousel-item">
                            <div class="col-md-3">
                                <div class="">
                                    <div class="card-img">
                                        <img src="images/film4.png" alt="film4" class="big-img">
                                    </div>
                                    <div class=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item small-carousel-item">
                            <div class="col-md-3">
                                <div class="">
                                    <div class="card-img">
                                        <img src="images/film2.png" alt="film2" class="big-img">
                                    </div>
                                    <div class=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item small-carousel-item">
                            <div class="col-md-3">
                                <div class="">
                                    <div class="card-img">
                                        <img src="images/film3.png" alt="film3" class="big-img">
                                    </div>
                                    <div class=""></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev small-color  w-aut" href="#recipeCarouse2" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </a>
                    <a class="carousel-control-next small-color w-aut" href="#recipeCarouse2" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </a>
                </div>
            </div>  

            

 </div>




    
</body>
        <script src="js/small_slider.js"></script>
</html>
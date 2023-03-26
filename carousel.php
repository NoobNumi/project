<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./css/bootstrap-grid.min.css">

    <title>Carousel</title>
  </head>
  <body>

    <style>
        .carousel-item {
            height: 32rem;
            background: #000;
            color: white;
            position: relative;
            background-position: center;
            background-size: cover;
        }
        .container{
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding-bottom: 50px;
        }
        .container h1{
            font-size:5.5rem ;
        }
        .container p{
            font-size:2rem ;
        }
        .overlay-image{
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            top: 0;
            background-position: center;
            background-size: cover;
            opacity: 0.5;
        }
    </style>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="overlay-image" style="background-image: url(./images/slider1.png);"></div>
                    <div class="container">
                        <h1>Check out our latest products for a chance to get discounts!</h1>
                        <p>50% discounts on all shops at December 12!</p>
                        <a href="shop.php" class="btn btn-lg btn-primary">Check out our products</a>
                    </div>

                </div>
                <div class="carousel-item">
                <div class="overlay-image"style="background-image: url(./images/slider2.png);"></div>
                    <div class="container">
                        <h1>Customer service open 24/7</h1>
                        <p>Do you have any feedbacks? Message us!</p>
                        <a href="contact.php" class="btn btn-lg btn-primary">Contact us</a>
                    </div>

                </div>
        </div>
        <a href="#myCarousel" class="carousel-control-prev" role="button" data-slide="prev">
            <span class="sr-only">Previous</span>
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a href="#myCarousel" class="carousel-control-next" role="button" data-slide="prev">
            <span class="sr-only">Next</span>
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    </div>
    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 10px;">
                    <h1 style="padding: 2rem;" class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h3 class="font-weight-semi-bold m-0">Quality Product</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 10px;">
                    <h1 style="padding: 2rem;" class="fa fa-shipping-fast text-primary m-0 mr-3"></h1>
                    <h3 class="font-weigt-semi-bold m-0">Free Shipping</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 3px;">
                    <h1 style="padding: 2.7rem;" class="fa-solid fa-right-left text-primary m-0 mr-3"></h1>
                    <h3 class="font-weight-semi-bold m-0">14-Day Return</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 10px;">
                    <h1 style="padding: 2rem;" class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h3 class="font-weight-semi-bold m-0 ">24/7 Support</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/jquery-1.10.2.min.js"></script>
</script>
</script>
</body>
</html>
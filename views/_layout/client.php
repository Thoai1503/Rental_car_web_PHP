<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Car Rent &mdash; Free Website Template by Colorlib</title>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <link
      href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="http://localhost/car_rent/public/client/fonts/icomoon/style.css" />

    <link rel="stylesheet" href="http://localhost/car_rent/public/client/css/bootstrap.min.css" />
    <link rel="stylesheet" href="http://localhost/car_rent/public/client/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="http://localhost/car_rent/public/client/css/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="http://localhost/car_rent/public/client/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="http://localhost/car_rent/public/client/css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="http://localhost/car_rent/public/client/fonts/flaticon/font/flaticon.css" />
    <link rel="stylesheet" href="http://localhost/car_rent/public/client/css/aos.css" />

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="http://localhost/car_rent/public/client/css/style.css" />


    <link rel="stylesheet" href="http://localhost/car_rent/public/client/css/open-iconic-bootstrap.min.css" />
    <link rel="stylesheet" href="http://localhost/car_rent/public/client/css/animate.css" />

   

  

    <link rel="stylesheet" href="http://localhost/car_rent/public/client/css/ionicons.min.css" />

    <link rel="stylesheet" href="http://localhost/car_rent/public/client/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="http://localhost/car_rent/public/client/css/jquery.timepicker.css" />

    <link rel="stylesheet" href="http://localhost/car_rent/public/client/css/flaticon.css" />
    <link rel="stylesheet" href="http://localhost/car_rent/public/client/css/icomoon.css" />
    <link rel="stylesheet" href="http://localhost/car_rent/public/client/css/style_copy.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
      /* Add this CSS to your style.css file or create a new stylesheet */
.dropdown-menu {
  border-radius: 8px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
  border: none;
  padding: 8px 0;
}

.dropdown-item {
  padding: 8px 20px;
  color: #333;
  transition: all 0.2s;
}

.dropdown-item:hover, .dropdown-item:focus {
  background-color: #f8f9fa;
  color: #007bff;
}

.dropdown-divider {
  margin: 5px 0;
}

.dropdown-toggle::after {
  display: none;
}

/* Ensure the dropdown appears on hover for desktop */
@media (min-width: 992px) {
  .dropdown:hover .dropdown-menu {
    display: block;
  }
}

/* Custom animation for dropdown */
.dropdown-menu {
  animation: fadeIn 0.2s ease-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
    </style>
  </head>


  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <div class="site-wrap" id="home-section">
      <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>

      <header class="site-navbar site-navbar-target" role="banner">
        <div class="container">
          <div class="row align-items-center position-relative">
            <div class="col-3">
              <div class="site-logo">
                <a href="index.html">CarRent</a>
              </div>
            </div>

            <div class="col-9 text-right">
              <span class="d-inline-block d-lg-none"
                ><a
                  href="#"
                  class="text-white site-menu-toggle js-menu-toggle py-5 text-white"
                  ><span class="icon-menu h3 text-white"></span></a
              ></span>

              <nav
                class="site-navigation text-right ml-auto d-none d-lg-block"
                role="navigation"
              >
                <ul class="site-menu main-menu js-clone-nav ml-auto">
                  <li class="active">
                    <a href="index" class="nav-link">Home</a>
                  </li>
                  <li><a href="service" class="nav-link">Services</a></li>
                  <li><a href="carlist" class="nav-link">Cars</a></li>  
                  <li><a href="about" class="nav-link">About</a></li>
                  <li><a href="#" class="nav-link">Blog</a></li>
                  <li><a href="contact" class="nav-link">Contact</a></li>
                  <?php
                 if (isset($_SESSION['user'])) {
                  echo '
                   <li><a href="logout" class="nav-link">Logout</a></li>
                  <li class="dropdown position-relative">
                    <a href="#" class="dropdown-toggle nav-link" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <img src="http://localhost/car_rent/public/client/images/person_1.jpg" style="width:30px;border-radius:50%" alt="user" class="img-fluid" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown" style="min-width: 200px;">
                      <div class="px-3 py-2">
                        <div class="d-flex align-items-center mb-2">
                          <img src="http://localhost/car_rent/public/client/images/person_1.jpg" style="width:40px;border-radius:50%" alt="user" class="img-fluid mr-2" />
                          <div>
                            <strong><?php echo $_SESSION["user"]["name"]; ?></strong>
                            <div class="small text-muted"><?php echo $_SESSION["user"]["email"] ?? "My name"; ?></div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="profile.html">
                        <i class="icon-user mr-2"></i> My Profile
                      </a>
                      <a class="dropdown-item" href="http://localhost/car_rent/mybookings">
                        <i class="icon-calendar mr-2"></i> My Bookings
                      </a>
                      <a class="dropdown-item" href="favorites.html">
                        <i class="icon-heart mr-2"></i> Favorite Cars
                      </a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="logout">
                        <i class="icon-sign-out mr-2"></i> Logout
                      </a>
                    </div>
                  </li>';
                } else {
                  echo '<li><a href="http://localhost/car_rent/login" class="nav-link">Login</a></li>';
                }
                ?>
                </ul> 
              </nav>
            </div>
          </div>
        </div>
      </header>

      <div class="ftco-blocks-cover-1" >
        <div 
          class="ftco-cover-1 overlay  <?=$_SESSION['displayForm']?'':'innerpage'?>"
          style="background-image: url(<?=$_SESSION['displayForm']?'http://localhost/car_rent/public/client/images/hero_1.jpg':'http://localhost/car_rent/public/client/images/hero_2.jpg'?>);"
        >
          <div class="container" >
            <?php
            if ($_SESSION['displayForm']) {
                 ?>
                 <div class="row align-items-center">
              <div class="col-lg-5">
                <div class="feature-car-rent-box-1">
                  <h3>Range Rover S7</h3>
                  <ul class="list-unstyled">
                    <li>
                      <span>Doors</span>
                      <span class="spec">4</span>
                    </li>
                    <li>
                      <span>Seats</span>
                      <span class="spec">6</span>
                    </li>
                    <li>
                      <span>Lugage</span>
                      <span class="spec">2 Suitcase/2 Bags</span>
                    </li>
                    <li>
                      <span>Transmission</span>
                      <span class="spec">Automatic</span>
                    </li>
                    <li>
                      <span>Minium age</span>
                      <span class="spec">Automatic</span>
                    </li>
                  </ul>
                  <div class="d-flex align-items-center bg-light p-3">
                    <span>$150/day</span>
                    <a href="contact.html" class="ml-auto btn btn-primary"
                      >Rent Now</a
                    >
                  </div>
                </div>
              </div>
            </div>
          <?php
            } else {
                echo '<div class="row align-items-center justify-content-center">
                <div class="col-lg-6 text-center">
                  <h1>Our For Rent Cars</h1>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
              </div>';
            }
          ?>
            

            <!-- <div class="row align-items-center">
              <div class="col-lg-5">
                <div class="feature-car-rent-box-1">
                  <h3>Range Rover S7</h3>
                  <ul class="list-unstyled">
                    <li>
                      <span>Doors</span>
                      <span class="spec">4</span>
                    </li>
                    <li>
                      <span>Seats</span>
                      <span class="spec">6</span>
                    </li>
                    <li>
                      <span>Lugage</span>
                      <span class="spec">2 Suitcase/2 Bags</span>
                    </li>
                    <li>
                      <span>Transmission</span>
                      <span class="spec">Automatic</span>
                    </li>
                    <li>
                      <span>Minium age</span>
                      <span class="spec">Automatic</span>
                    </li>
                  </ul>
                  <div class="d-flex align-items-center bg-light p-3">
                    <span>$150/day</span>
                    <a href="contact.html" class="ml-auto btn btn-primary"
                      >Rent Now</a
                    >
                  </div>
                </div>
              </div>
            </div> -->
            <!-- <div class="row align-items-center justify-content-center">
              <div class="col-lg-6 text-center">
                <h1>Our For Rent Cars</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              </div>
            </div> -->
          </div>
        </div>
      </div>

      <div class="site-section pt-0 pb-0 bg-light">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <form action="carlist" class="trip-form"  style="display: <?=$_SESSION['displayForm']?'block':'none'?>;">
                <div class="row align-items-center mb-4">
                  <div class="col-md-6">
                    <h3 class="m-0">Begin your trip here</h3>
                  </div>
                  <div class="col-md-6 text-md-right">
                    <span class="text-primary">32</span> <span>cars available</span></span>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-3">
                    <label for="cf-1">Where you from</label>
                    <input type="text" id="cf-1" placeholder="Your pickup address" class="form-control" name="address1" >
                  </div>
                  <div class="form-group col-md-3">
                    <label for="cf-2">Where you go</label>
                    <input type="text" id="cf-2" placeholder="Your drop-off address" class="form-control" name="address2">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="cf-3">Journey date</label>
                    <input type="text" id="cf-3" placeholder="Your pickup address" class="form-control datepicker px-3" name="pickup_date">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="cf-4">Return date</label>
                    <input type="text" id="cf-4" placeholder="Your pickup address" class="form-control datepicker px-3" name="return_date">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <input type="submit" value="Check available car" class="btn btn-primary">
                  </div>
                </div>
              </form> 
              
            </div>
          </div>
        </div>
        
      </div>

      <div class="site-section bg-light">
      <?php if (isset($clientContent)) {
                echo $clientContent;
            } ?>
        <!-- <div class="container">
          <div class="row">
            <div class="col-lg-3">
              <h3>Our Offer</h3>
              <p class="mb-4">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure
                nesciunt nemo vel earum maxime neque!
              </p>
              <p>
                <a href="#" class="btn btn-primary custom-prev">Previous</a>
                <span class="mx-2">/</span>
                <a href="#" class="btn btn-primary custom-next">Next</a>
              </p>
            </div>
            <div class="col-lg-9">
              <div class="nonloop-block-13 owl-carousel">
                <div class="item-1">
                  <a href="#"
                    ><img src="images/img_1.jpg" alt="Image" class="img-fluid"
                  /></a>
                  <div class="item-1-contents">
                    <div class="text-center">
                      <h3><a href="#">Range Rover S64 Coupe</a></h3>
                      <div class="rating">
                        <span class="icon-star text-warning"></span>
                        <span class="icon-star text-warning"></span>
                        <span class="icon-star text-warning"></span>
                        <span class="icon-star text-warning"></span>
                        <span class="icon-star text-warning"></span>
                      </div>
                      <div class="rent-price"><span>$250/</span>day</div>
                    </div>
                    <ul class="specs">
                      <li>
                        <span>Doors</span>
                        <span class="spec">4</span>
                      </li>
                      <li>
                        <span>Seats</span>
                        <span class="spec">5</span>
                      </li>
                      <li>
                        <span>Transmission</span>
                        <span class="spec">Automatic</span>
                      </li>
                      <li>
                        <span>Minium age</span>
                        <span class="spec">18 years</span>
                      </li>
                    </ul>
                    <div class="d-flex action">
                      <a href="contact.html" class="btn btn-primary"
                        >Rent Now</a
                      >
                    </div>
                  </div>
                </div>

                <div class="item-1">
                  <a href="#"
                    ><img src="images/img_2.jpg" alt="Image" class="img-fluid"
                  /></a>
                  <div class="item-1-contents">
                    <div class="text-center">
                      <h3><a href="#">Range Rover S64 Coupe</a></h3>
                      <div class="rating">
                        <span class="icon-star text-warning"></span>
                        <span class="icon-star text-warning"></span>
                        <span class="icon-star text-warning"></span>
                        <span class="icon-star text-warning"></span>
                        <span class="icon-star text-warning"></span>
                      </div>
                      <div class="rent-price"><span>$250/</span>day</div>
                    </div>
                    <ul class="specs">
                      <li>
                        <span>Doors</span>
                        <span class="spec">4</span>
                      </li>
                      <li>
                        <span>Seats</span>
                        <span class="spec">5</span>
                      </li>
                      <li>
                        <span>Transmission</span>
                        <span class="spec">Automatic</span>
                      </li>
                      <li>
                        <span>Minium age</span>
                        <span class="spec">18 years</span>
                      </li>
                    </ul>
                    <div class="d-flex action">
                      <a href="contact.html" class="btn btn-primary"
                        >Rent Now</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div
        class="site-section section-3"
        style="background-image: url('images/hero_2.jpg')"
      >
        <div class="container">
          <div class="row">
            <div class="col-12 text-center mb-5">
              <h2 class="text-white">Our services</h2>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <div class="service-1">
                <span class="service-1-icon">
                  <span class="flaticon-car-1"></span>
                </span>
                <div class="service-1-contents">
                  <h3>Repair</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Obcaecati, laboriosam.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="service-1">
                <span class="service-1-icon">
                  <span class="flaticon-traffic"></span>
                </span>
                <div class="service-1-contents">
                  <h3>Car Accessories</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Obcaecati, laboriosam.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="service-1">
                <span class="service-1-icon">
                  <span class="flaticon-valet"></span>
                </span>
                <div class="service-1-contents">
                  <h3>Own a Car</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Obcaecati, laboriosam.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container site-section mb-5">
        <div class="row justify-content-center text-center">
          <div class="col-7 text-center mb-5">
            <h2>How it works</h2>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo
              assumenda, dolorum necessitatibus eius earum voluptates sed!
            </p>
          </div>
        </div>
        <div class="how-it-works d-flex">
          <div class="step">
            <span class="number"><span>01</span></span>
            <span class="caption">Time &amp; Place</span>
          </div>
          <div class="step">
            <span class="number"><span>02</span></span>
            <span class="caption">Car</span>
          </div>
          <div class="step">
            <span class="number"><span>03</span></span>
            <span class="caption">Details</span>
          </div>
          <div class="step">
            <span class="number"><span>04</span></span>
            <span class="caption">Checkout</span>
          </div>
          <div class="step">
            <span class="number"><span>05</span></span>
            <span class="caption">Done</span>
          </div>
        </div>
      </div>

      <div class="site-section bg-light">
        <div class="container">
          <div class="row justify-content-center text-center mb-5">
            <div class="col-7 text-center mb-5">
              <h2>Customer Testimony</h2>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo
                assumenda, dolorum necessitatibus eius earum voluptates sed!
              </p>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
              <div class="testimonial-2">
                <blockquote class="mb-4">
                  <p>
                    "Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Voluptatem, deserunt eveniet veniam. Ipsam, nam, voluptatum"
                  </p>
                </blockquote>
                <div class="d-flex v-card align-items-center">
                  <img
                    src="images/person_1.jpg"
                    alt="Image"
                    class="img-fluid mr-3"
                  />
                  <span>Mike Fisher</span>
                </div>
              </div>
            </div>
            <div class="col-lg-4 mb-4 mb-lg-0">
              <div class="testimonial-2">
                <blockquote class="mb-4">
                  <p>
                    "Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Voluptatem, deserunt eveniet veniam. Ipsam, nam, voluptatum"
                  </p>
                </blockquote>
                <div class="d-flex v-card align-items-center">
                  <img
                    src="images/person_2.jpg"
                    alt="Image"
                    class="img-fluid mr-3"
                  />
                  <span>Jean Stanley</span>
                </div>
              </div>
            </div>
            <div class="col-lg-4 mb-4 mb-lg-0">
              <div class="testimonial-2">
                <blockquote class="mb-4">
                  <p>
                    "Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Voluptatem, deserunt eveniet veniam. Ipsam, nam, voluptatum"
                  </p>
                </blockquote>
                <div class="d-flex v-card align-items-center">
                  <img
                    src="images/person_3.jpg"
                    alt="Image"
                    class="img-fluid mr-3"
                  />
                  <span>Katie Rose</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="site-section bg-white">
        <div class="container">
          <div class="row justify-content-center text-center mb-5">
            <div class="col-7 text-center mb-5">
              <h2>Our Blog</h2>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo
                assumenda, dolorum necessitatibus eius earum voluptates sed!
              </p>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="post-entry-1 h-100">
                <a href="single.html">
                  <img src="images/post_1.jpg" alt="Image" class="img-fluid" />
                </a>
                <div class="post-entry-1-contents">
                  <h2>
                    <a href="single.html"
                      >The best car rent in the entire planet</a
                    >
                  </h2>
                  <span class="meta d-inline-block mb-3"
                    >July 17, 2019 <span class="mx-2">by</span>
                    <a href="#">Admin</a></span
                  >
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Dolores eos soluta, dolore harum molestias consectetur.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="post-entry-1 h-100">
                <a href="single.html">
                  <img src="images/img_2.jpg" alt="Image" class="img-fluid" />
                </a>
                <div class="post-entry-1-contents">
                  <h2>
                    <a href="single.html"
                      >The best car rent in the entire planet</a
                    >
                  </h2>
                  <span class="meta d-inline-block mb-3"
                    >July 17, 2019 <span class="mx-2">by</span>
                    <a href="#">Admin</a></span
                  >
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Dolores eos soluta, dolore harum molestias consectetur.
                  </p>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <div class="post-entry-1 h-100">
                <a href="single.html">
                  <img src="images/img_3.jpg" alt="Image" class="img-fluid" />
                </a>
                <div class="post-entry-1-contents">
                  <h2>
                    <a href="single.html"
                      >The best car rent in the entire planet</a
                    >
                  </h2>
                  <span class="meta d-inline-block mb-3"
                    >July 17, 2019 <span class="mx-2">by</span>
                    <a href="#">Admin</a></span
                  >
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Dolores eos soluta, dolore harum molestias consectetur.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div> -->
      </div>

      <footer class="site-footer">
        <div class="container">
          <div class="row">
            <div class="col-lg-3">
              <h2 class="footer-heading mb-4">About Us</h2>
              <p>
                Far far away, behind the word mountains, far from the countries
                Vokalia and Consonantia, there live the blind texts.
              </p>
            </div>
            <div class="col-lg-8 ml-auto">
              <div class="row">
                <div class="col-lg-3">
                  <h2 class="footer-heading mb-4">Quick Links</h2>
                  <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Testimonials</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
                <div class="col-lg-3">
                  <h2 class="footer-heading mb-4">Quick Links</h2>
                  <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Testimonials</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
                <div class="col-lg-3">
                  <h2 class="footer-heading mb-4">Quick Links</h2>
                  <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Testimonials</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
                <div class="col-lg-3">
                  <h2 class="footer-heading mb-4">Quick Links</h2>
                  <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Testimonials</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
              <div class="border-top pt-5">
                <p>
                  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                  Copyright &copy;
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  All rights reserved | This template is made with
                  <i class="icon-heart text-danger" aria-hidden="true"></i> by
                  <a href="https://colorlib.com" target="_blank">Colorlib</a>
                  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <script>
      $(document).ready(function() {
  // For mobile devices, handle click events on the dropdown toggle
  $('.dropdown-toggle').on('click', function(e) {
    if (window.innerWidth < 992) {
      e.preventDefault();
      e.stopPropagation();
      $(this).siblings('.dropdown-menu').toggle();
    }
  }); 
  
  // Close dropdown when clicking outside
  $(document).on('click', function(e) {
    if (!$(e.target).closest('.dropdown').length) {
      $('.dropdown-menu').hide();
    }
  });
  
  // Add active class to dropdown items when clicked
  $('.dropdown-item').on('click', function() {
    $('.dropdown-item').removeClass('active');
    $(this).addClass('active');
  });


  const menuItems = document.querySelectorAll(".site-menu li");

    menuItems.forEach((item) => {
      item.addEventListener("click", function () {
        // Remove 'active' from all menu items
        menuItems.forEach((el) => el.classList.remove("active"));

        // Add 'active' to the clicked menu item
        this.classList.add("active");
      });
    });
});
    </script>

    <script src="http://localhost/car_rent/public/client/js/jquery-3.3.1.min.js"></script>
    <script src="http://localhost/car_rent/public/client/js/popper.min.js"></script>
    <script src="http://localhost/car_rent/public/client/js/bootstrap.min.js"></script>
    <script src="http://localhost/car_rent/public/client/js/owl.carousel.min.js"></script>
    <script src="http://localhost/car_rent/public/client/js/jquery.sticky.js"></script>
    <script src="http://localhost/car_rent/public/client/js/jquery.waypoints.min.js"></script>
    <script src="http://localhost/car_rent/public/client/js/jquery.animateNumber.min.js"></script>
    <script src="http://localhost/car_rent/public/client/js/jquery.fancybox.min.js"></script>
    <script src="http://localhost/car_rent/public/client/js/jquery.easing.1.3.js"></script>
    <script src="http://localhost/car_rent/public/client/js/bootstrap-datepicker.min.js"></script>
    <script src="http://localhost/car_rent/public/client/js/aos.js"></script>

    <script src="http://localhost/car_rent/public/client/js/main.js"></script>
  </body>
</html>

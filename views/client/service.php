
<?php
ob_start();
?>

<div class="site-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mb-4 mb-lg-5">
                        <div class="service-1 dark">
                            <span class="service-1-icon">
                                <span class="flaticon-car"></span>
                            </span>
                            <div class="service-1-contents">
                                <h3>Car Key</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4 mb-lg-5">
                        <div class="service-1 dark">
                            <span class="service-1-icon">
                                <span class="flaticon-valet-1"></span>
                            </span>
                            <div class="service-1-contents">
                                <h3>Car Key</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4 mb-lg-5">
                        <div class="service-1 dark">
                            <span class="service-1-icon">
                                <span class="flaticon-key"></span>
                            </span>
                            <div class="service-1-contents">
                                <h3>Car Key</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4 mb-lg-5">
                        <div class="service-1 dark">
                            <span class="service-1-icon">
                                <span class="flaticon-car-1"></span>
                            </span>
                            <div class="service-1-contents">
                                <h3>Repair</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4 mb-lg-5">
                        <div class="service-1 dark">
                            <span class="service-1-icon">
                                <span class="flaticon-traffic"></span>
                            </span>
                            <div class="service-1-contents">
                                <h3>Car Accessories</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4 mb-lg-5">
                        <div class="service-1 dark">
                            <span class="service-1-icon">
                                <span class="flaticon-valet"></span>
                            </span>
                            <div class="service-1-contents">
                                <h3>Own a Car</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.</p>
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
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo assumenda, dolorum necessitatibus
                        eius earum voluptates sed!</p>
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


   <?php
$clientContent = ob_get_clean();
require_once 'views/_layout/client.php';
   ?>     
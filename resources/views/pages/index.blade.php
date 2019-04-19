<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FIT - Fast in Time</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/agency.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">Fast in Time</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#portfolio">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#team">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
                    </li>
                    @if (Route::has('login'))
                    <li class="nav-item">
                        @auth
                        <a href="{{ url('/home') }}">Home</a>
                        @else
                        <a class="nav-link" href="{{ route('login') }}" data-toggle="modal" data-target="#portfolioModal7">Login</a>
                        @endauth
                        {{-- <a href="{{ route('login') }}" data-toggle="modal" data-target="#portfolioModal7">Login</a> --}}
                    </li>
                    @endif
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="{{ route('register') }}" data-toggle="modal" data-target="#portfolioModal8">Register</a>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- Registration Page -->
            {{-- <div class="flex-center position-ref full-height">
                @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    <a href="{{ url('/home') }}">Home</a>
                    @else
                    <a href="{{ route('login') }}" data-toggle="modal" data-target="#portfolioModal7">Login</a>
                </div>
                <div class="flex-center position-ref full-height">
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                    @endif
                    @endauth
                </div>
                @endif
            </div> --}}
        </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">it's Fast, it's Furious, it's</div>
                <div class="intro-heading text-uppercase">Time to be FIT!</div>
                <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Learn More</a>
            </div>
        </div>
    </header>

    <!-- Services -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">We're here for you</h2>
                    <h3 class="section-subheading text-muted">Satisfying daily cravings since 2019.</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Anything</h4>
                    <p class="text-muted">More than 500 restaurants are using FIT, so we are sure we can satisfy whatever craving you have!</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="far fa-clock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Anytime</h4>
                    <p class="text-muted">FIT operates 24 hours, so as long as the restaurant you want is open and there are nearby drivers, we will make sure that we'll get your food delivered in 30 minutes or less!</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-landmark fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Anywhere</h4>
                    <p class="text-muted">FIT is available in 30 states and is still growing. So anywhere you are, FIT will most likely be there!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section class="bg-light" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">About Us</h2>
                    <h3 class="section-subheading text-muted">Here's our journey towards the fruition of FIT</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-image">
                                <img class="rounded-circle img-fluid" src="img/about/7.png" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>January 2019</h4>
                                    <h4 class="subheading">Our Humble Beginnings</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">We wanted to rethink how food is being delivered to everyone. The availability of the food that we want, whenever we want has always been our motivation towards the making of FIT.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="rounded-circle img-fluid" src="img/about/2.png" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>February 2019</h4>
                                    <h4 class="subheading">An Idea is Born</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Putting the customer's needs first, we decided that FIT will serve as the connection between the customers and restaurants. The customers tell us what they want, and FIT will do everything to deliver it to their doorstep.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-image">
                                <img class="rounded-circle img-fluid" src="img/about/3.png" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>March 2019</h4>
                                    <h4 class="subheading">FIT in San Jose</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">San Jose State University will always be the birth place of fit. An idea that guided us towards the brainstorming, the designing of each part, careful storing of information, deployment, all the way to delivery of food to your doorstep.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="rounded-circle img-fluid" src="img/about/4.png" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>April 2019</h4>
                                    <h4 class="subheading">Phase Two Expansion</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">The success that we have received have motivated us to serve all over the United States. After all, this is what we have always wanted - to make sure that everyone gets whatever food they want, whenever they want.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <h4>Be Part
                                    <br>Of Our
                                    <br>Story!
                                </h4>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Grid -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Customer Reviews</h2>
                    <h3 class="section-subheading text-muted">The satisfaction of our customer is FIT's top priority. Hear them out.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#portfolioModal1">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img class="img-fluid" src="{{ asset('img/portfolio/2.jpg') }}" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h5>"the 30 mins delivery time was on-point"</h5>
                        <p class="text-muted">John from Cupertino</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#portfolioModal2">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img class="img-fluid" src="{{ asset('img/portfolio/5.jpg') }}" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h5>"There was a problem in my order, but the FIT team made it sure that my order was smooth throughout the whole process"</h5>
                        <p class="text-muted">Megan from Atlanta</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#portfolioModal3">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img class="img-fluid" src="{{ asset('img/portfolio/4.jpg') }}" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h5>"The customer service is second to none"</h5>
                        <p class="text-muted">Daniel from San Jose</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#portfolioModal4">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img class="img-fluid" src="{{ asset('img/portfolio/3.jpg') }}" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h5>"I don't think I'm going to cook ever again"</h5>
                        <p class="text-muted">Lindsey from San Francisco</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#portfolioModal5">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img class="img-fluid" src="{{ asset('img/portfolio/10.jpg') }}" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h5>"The pizza that I ordered was so hot it's like it was just taken out of the oven"</h5>
                        <p class="text-muted">Chris from New York</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#portfolioModal6">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img class="img-fluid" src="{{ asset('img/portfolio/6.jpg') }}" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h5>"It's the best thing that has ever happened to food delivery"</h5>
                        <p class="text-muted">Amy from Los Angeles</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team -->
    <section class="bg-light" id="team">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Our Amazing Team</h2>
                    <h3 class="section-subheading text-muted">The wonderful human beings behind FIT</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="{{ asset('img/team/7.jpg') }}" alt="">
                        <h4>Chico Malto</h4>
                        <p class="text-muted">Front-End Engineer</p>
                        <ul class="list-inline social-buttons">
                            <li class="list-inline-item">
                                <a href="https://www.linkedin.com/in/chico-malto-a71036b5/">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="{{ asset('img/team/5.jpg') }}" alt="">
                        <h4>Jean Marcellin</h4>
                        <p class="text-muted">Lead Developer</p>
                        <ul class="list-inline social-buttons">
                            <li class="list-inline-item">
                                <a href="https://www.linkedin.com/in/jeanmarcellin/">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="{{ asset('img/team/6.jpg') }}" alt="">
                        <h4>Justin Mata</h4>
                        <p class="text-muted">Back-End Engineer</p>
                        <ul class="list-inline social-buttons">
                            <li class="list-inline-item">
                                <a href="https://www.linkedin.com/in/justin-mata-abb612161/">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="{{ asset('img/team/9.jpg') }}" alt="">
                        <h4>Sang Nguyen</h4>
                        <p class="text-muted">Database Engineer</p>
                        <ul class="list-inline social-buttons">
                            <li class="list-inline-item">
                                <a href="https://www.linkedin.com/in/sang-nguyen-679146121/">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="{{ asset('img/team/8.jpg') }}" alt="">
                        <h4>Tien Ly</h4>
                        <p class="text-muted">Database Manager</p>
                        <ul class="list-inline social-buttons">
                            <li class="list-inline-item">
                                <a href="https://www.linkedin.com/in/tien-ly-038414158/">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sponsors/Tech -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 class="section-subheading text-muted">FIT is proud to be built using these frameworks</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img class="img-fluid d-block mx-auto" src="{{ asset('img/logos/bs2.png') }}" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img class="img-fluid d-block mx-auto" src="{{ asset('img/logos/gm3.png') }}" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img class="img-fluid d-block mx-auto" src="{{ asset('img/logos/nn1.png') }}" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img class="img-fluid d-block mx-auto" src="{{ asset('img/logos/laravel.png') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Contact Us</h2>
                    <h3 class="section-subheading text-muted">We are committed to providing the best experience to our customers. Let us know what you think.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form id="contactForm" name="sentMessage" novalidate="novalidate">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" id="name" type="text" placeholder="Your Name *" required="required" data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="email" type="email" placeholder="Your Email *" required="required" data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" required="required" data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" id="message" placeholder="Your Message *" required="required" data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; Fast in Time</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li class="list-inline-item">
                            <a href="#">Privacy Policy</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Portfolio Modals -->

    <!-- Modal 1 -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl"></div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <img class="img-fluid d-block mx-auto" src="{{ asset('img/portfolio/2.jpg') }}" alt="">
                                <p>
                                    This Wingstop is located next Panda Express, Noah's Bagels, and Starbucks. There's little to no parking during the evenings since a lot of people line up to eat at Panda Express. So while they're doing that, I and a few other people stroll on in to Wing Stop.
                                    My family and I can never get tired of their wings, so having their family pack from 30 pieces to 75 pieces is a deal. My favorite is their mango habañero and their garlic parmesan. My wings come out hot every time and every bite is full of flavor. They also offer ranch, honey mustard, and ketchup.
                                    Their service is a hit or miss. Some days I'll get the awesome dude that'll pack my stuff nicely and say, "have a good night" or I'll get the lady that says, "what do you want to order" as if I'm burden for even stopping by.
                                    Whatever the service may be that night, I always get crispy flavorful chicken. My orders never come out wrong and I always walk out satisfied.
                                    Oh P.S. their cheesy fries are to die for!
                                </p>
                                <ul class="list-inline">
                                    <li>Date: January 2019</li>
                                    <li>Client: John Appleseed</li>
                                </ul>
                                <button class="btn btn-primary" data-dismiss="modal" type="button">
                                    <i class="fas fa-times"></i>
                                    Close Review
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2 -->
    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl"></div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <img class="img-fluid d-block mx-auto" src="{{ asset('img/portfolio/5.jpg') }}" alt="">
                                <p>
                                    When we're craving Chinese fast food, we come here.  We keep a copy of their to-go menu in our car and also at home for those call-in orders.  No matter where you are, call your order in.  That will save you from a longer wait if you order as a walk-in.
                                    They have a full menu but we usually order from the lunch combo specials menu which has 8 choices, carrying your basic "touristy" Chinese food of chow mein, fried rice, sweet and sour pork, egg rolls, Mongolian beef, fried chicken wings, etc.  These range from $7.25 to $8.50.
                                    The real reason why we come here...the massive amount of food they give you!  I like bang for my buck and I get it here!  I like to weigh my food boxes when I get home and they average over 2 lbs. per box, depending on what you've ordered.  That's a lot of food!  My husband and I can usually make two or three meals out of one order.
                                    This used to be a small counter order establishment with maybe two tables to dine at.  They have since renovated and expanded to seat many more.  We still just grab and go but it's nice to know we can sit in comfort if we wanted to.
                                </p>
                                <ul class="list-inline">
                                    <li>Date: February 2019</li>
                                    <li>Client: Megan Shark</li>
                                </ul>
                                <button class="btn btn-primary" data-dismiss="modal" type="button">
                                    <i class="fas fa-times"></i>
                                    Close Review
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 3 -->
    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl"></div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->

                                <img class="img-fluid d-block mx-auto" src="{{ asset('img/portfolio/4.jpg') }}" alt="">
                                <p>
                                    I'm still full from the burrito I had here two weeks ago.
                                    Wife and I ordered a Cali Burrito w/Carne Asada (smothered in Chipotle Sauce) to go along with an Al Pastor Quesadilla and glass of Horchata. This place does not skimp on anything, especially portions and flavors. Everything was delicious. And don't forget to drench everything with their creamy green sauce (it's in their tiny 'salsa bar' off to the side) that is refreshingly fresh and pretty spicy all at once.
                                    Burrito was bomb and the size of an infant. Chipotle Sauce had a nice smoky kick to it and was perfect for soaking up the fries that spilled out the burrito once you cut into it--yes it's a fork and knife burrito, that's for sure. Biggest surprise tho was the Quesadilla, which was super simple with Cheese & Al Pastor and nothing else. We didn't finish everything--the burrito probs woulda been plenty enough for the both of us--but no regrets with anything we ordered.
                                    A cool spot that I'm sure is a big hit with students in the area.
                                </p>
                                <ul class="list-inline">
                                    <li>Date: January 2019</li>
                                    <li>Client: Daniel March</li>
                                </ul>
                                <button class="btn btn-primary" data-dismiss="modal" type="button">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 4 -->
    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl"></div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <img class="img-fluid d-block mx-auto" src="{{ asset('img/portfolio/3.jpg') }}" alt="">
                                <p>
                                    Amazing Greek Food! The pictures are what lured me into trying this place out and I am so happy to report that they did not disappoint. 10/10 absolutely would come here again and this is coming from a person who isn't a big fan of Greek cuisine.
                                    The falafels here are made of high quality chickpeas! This was surprising as it satisfied even my picky hubby who absolutely loves Greek food and is a falafel fiend. I have never been that into Falafel, but I found myself stealing his falafel pita whenever he turned around. It was just that good!
                                    My gyro plate with beef/lamb was sooo delish! The hand cut French fries were scrumptious and the side salad was to die for! The dressing was so well balanced and the salad was so fresh! The hubby generally dislikes Greek salads but even he was fighting me to get in on that salad action.
                                    Omg, and the pita!! How do I even begin to describe the heavenly bites of crispy bread seasoned perfectly?
                                    Just come here. You won't regret it. (Or maybe you will, because it'll be your new addiction, lol.)
                                </p>
                                <ul class="list-inline">
                                    <li>Date: March 2019</li>
                                    <li>Client: Lindsey Fin</li>
                                </ul>
                                <button class="btn btn-primary" data-dismiss="modal" type="button">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 5 -->
    <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl"></div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <img class="img-fluid d-block mx-auto" src="{{ asset('img/portfolio/10.jpg') }}" alt="">
                                <p>
                                    I've made it a personal mission of mine to try all the pizza places in and around SJ to find the best one. A Slice of New York is certainly near the top at my list (probably second).
                                    What to expect: The place is small, and you'll see people coming and going often. Pick-up business seems to be going strong. There are something like six stools inside if you'd like to eat inside and two tables outside. You order at the counter, where you can see some slices waiting for you.
                                    The pizza: Pick from these slices in the front or order something different. If you get a slice from the front, they'll put it back in the oven to heat it up for you. Yummy! The crust is delicious, the toppings are plenty, and the sauce is tomato-y and bright. We also ordered the garlic knots. They're not really knots so much as dough blobs, but they're good too.
                                    The real star of the show, at least for me, was the cannoli. I admit, I haven't eaten many cannoli in general, but I really enjoyed this one. That cannoli will probably bring me back to Slice of NY pretty quickly.
                                    Service/People: Friendly people, ready to help and customize things to your liking. They've got a wall of shame where they refute some poor ratings on Yelp/Google, and I don't really love that since it seems to go against as the positive vibe that the rest of the place has. But the rest of the restaurant was decorated with NY memorabilia and was fun to check out.
                                </p>
                                <ul class="list-inline">
                                    <li>Date: April 2019</li>
                                    <li>Client: Chris Topher</li>

                                </ul>
                                <button class="btn btn-primary" data-dismiss="modal" type="button">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl"></div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <img class="img-fluid d-block mx-auto" src="{{ asset('img/portfolio/6.jpg') }}" alt="">
                                <p>
                                    This place is a wonderful lunch spot. I go here at least once a week. All my friends and co-workers that have gone to this place with me are in love with their absolutely fresh and delicious salad dishes. They have variety of options to choose from and all of their ingredients look so fresh and healthy.
                                    They also have a very polite and friendly staff that take care of you right when you arrive.
                                    One thing that I really appreciate about this place is the hospitality of the owners. They are the actual reason I have been going back so many times and have introduced them to everyone I know. They are so wonderfully kind and make you feel so welcomed at their place. Now I am finished writing I can go get my favorite salad which is health protein. It's lunch time in San Jose people :)
                                </p>
                                <ul class="list-inline">
                                    <li>Date: January 2019</li>
                                    <li>Client: Amy Fowler</li>
                                </ul>
                                <button class="btn btn-primary" data-dismiss="modal" type="button">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 7 -->
    <div class="portfolio-modal modal fade" id="portfolioModal7" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl"></div>
                    </div>
                </div>
                <div class="container">
                    <div class="row justify-content-center my-5">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">{{ __('Login') }}</div>

                                <div class="card-body">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                                @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6 offset-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="form-check-label" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Login') }}
                                                </button>

                                                @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 8 -->
    <div class="portfolio-modal modal fade" id="portfolioModal8" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl"></div>
                    </div>
                </div>
                <div class="container">
                        <div class="row justify-content-center my-5">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">{{ __('Register') }}</div>

                                    <div class="card-body">
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf

                                            <div class="form-group row">
                                                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First name') }}</label>

                                                <div class="col-md-6">
                                                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                                    @if ($errors->has('first_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('first_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last name') }}</label>

                                                <div class="col-md-6">
                                                    <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                                    @if ($errors->has('last_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('last_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                                    @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                                <div class="col-md-6">
                                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                    @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                                <div class="col-md-6">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="phone_number" class="col-md-4 col-form-label text-md-right">Phone Number</label>

                                                <div class="col-md-6">
                                                    <input id="phone_number" type="phone_number" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" required>

                                                    @if ($errors->has('phone_number'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>

                                                <div class="col-md-6">
                                                    <select id="type" type="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" value="{{ old('type') }}" required>
                                                        <option value="Driver">Driver</option>
                                                        <option value="Restaurant">Restaurant</option>
                                                    </select>

                                                    @if ($errors->has('type'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('type') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Register') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- Plugin JavaScript -->
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>

    <!-- Contact form JavaScript -->
    <script src="{{ asset('js/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('js/contact_me.js') }}"></script>

    <!-- Custom scripts for this template -->
    <script src="{{ asset('js/agency.min.js') }}"></script>

    <script>
        $('#portfolioModal7').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    </script>

</body>

</html>

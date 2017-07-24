<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LLC-TECHNOLOGY</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">


    <!-- Bootstrap style -->
    <link id="callCss" rel="stylesheet" href="/frontend/themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="/frontend/themes/css/base.css" rel="stylesheet" media="screen"/>
    <!-- Bootstrap style responsive -->
    <link href="/frontend/themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
    <link href="/frontend/themes/css/font-awesome.css" rel="stylesheet" type="text/css">
    <!-- Google-code-prettify -->
    <link href="/frontend/themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
    <!-- fav and touch icons -->
    <link rel="shortcut icon" href="/frontend/themes/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/frontend/themes/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/frontend/themes/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/frontend/themes/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/frontend/themes/images/ico/apple-touch-icon-57-precomposed.png">
    <style type="text/css" id="enject"></style>
</head>
<body>
<div id="header">
    <div class="container">
        <div id="logoArea" class="navbar">
            <a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-inner">
                {{--<a class="brand" href="index.html"><img src="frontend/themes/images/logo.png" alt="Bootsshop"/></a>--}}
                <a class="brand" href="/"><img src="/frontend/themes/images/ico-cart.png" alt="LCC-TECHNOLOGY"/> LLC-TECHNOLOTY</a>
                <form class="form-inline navbar-search" action="/">
                    <input class="srchTxt" ng-model="searchText" type="text" placeholder="search..."/>
                    <button type="submit" id="submitButton" class="btn btn-primary" ng-click="searchDB()">Go</button>
                </form>
                <ul id="topMenu" class="nav pull-right">
                    <li class=""><a href="/about.html">About</a></li>
                    <li class=""><a href="/contact.html">Contact</a></li>
                    <li class="">
                        <a href="/admin" role="button"  style="padding-right:0"><span class="btn btn-large btn-success">Login</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Header End====================================================================== -->
<div id="mainBody">
    <div class="container">
        <hr class="soften">
        <h1>Visit us</h1>
        <hr class="soften"/>
        <div class="row">
            <div class="span4">
                <h4>Contact Details</h4>
                <p>	18 Fresno,<br/> CA 93727, USA
                    <br/><br/>
                    info@bootsshop.com<br/>
                    ï»¿Tel 123-456-6780<br/>
                    Fax 123-456-5679<br/>
                    web:bootsshop.com
                </p>
            </div>

            <div class="span4">
                <h4>Opening Hours</h4>
                <h5> Monday - Friday</h5>
                <p>09:00am - 09:00pm<br/><br/></p>
                <h5>Saturday</h5>
                <p>09:00am - 07:00pm<br/><br/></p>
                <h5>Sunday</h5>
                <p>12:30pm - 06:00pm<br/><br/></p>
            </div>
            <div class="span4">
                <h4>Email Us</h4>
                <form class="form-horizontal">
                    <fieldset>
                        <div class="control-group">

                            <input type="text" placeholder="name" class="input-xlarge" required/>

                        </div>
                        <div class="control-group">

                            <input type="email" placeholder="email" class="input-xlarge" required/>

                        </div>
                        <div class="control-group">

                            <input type="text" placeholder="subject" class="input-xlarge" required/>

                        </div>
                        <div class="control-group">
                            <textarea rows="3" id="textarea" class="input-xlarge" required></textarea>

                        </div>

                        <button class="btn btn-large" type="submit">Send Messages</button>

                    </fieldset>
                </form>
            </div>
        </div>
        {{--<div class="row">--}}
            {{--<div class="span12">--}}
                {{--<iframe style="width:100%; height:300px; border: 0px" scrolling="no" src="https://maps.google.co.uk/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=18+California,+Fresno,+CA,+United+States&amp;aq=0&amp;oq=18+California+united+state&amp;sll=39.9589,-120.955336&amp;sspn=0.007114,0.016512&amp;ie=UTF8&amp;hq=&amp;hnear=18,+Fresno,+California+93727,+United+States&amp;t=m&amp;ll=36.732762,-119.695787&amp;spn=0.017197,0.100336&amp;z=14&amp;output=embed"></iframe><br />--}}
                {{--<small><a href="https://maps.google.co.uk/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=18+California,+Fresno,+CA,+United+States&amp;aq=0&amp;oq=18+California+united+state&amp;sll=39.9589,-120.955336&amp;sspn=0.007114,0.016512&amp;ie=UTF8&amp;hq=&amp;hnear=18,+Fresno,+California+93727,+United+States&amp;t=m&amp;ll=36.732762,-119.695787&amp;spn=0.017197,0.100336&amp;z=14" style="color:#0000FF;text-align:left">View Larger Map</a></small>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
<div  id="footerSection">
    <div class="container">
        <div class="row">
            <div class="span3">
                <h5>ACCOUNT</h5>
                <a href="login.html">YOUR ACCOUNT</a>
                <a href="login.html">PERSONAL INFORMATION</a>
                <a href="login.html">ADDRESSES</a>
                <a href="login.html">DISCOUNT</a>
                <a href="login.html">ORDER HISTORY</a>
            </div>
            <div class="span3">
                <h5>INFORMATION</h5>
                <a href="contact.html">CONTACT</a>
                <a href="register.html">REGISTRATION</a>
                <a href="legal_notice.html">LEGAL NOTICE</a>
                <a href="tac.html">TERMS AND CONDITIONS</a>
                <a href="faq.html">FAQ</a>
            </div>
            <div class="span3">
                <h5>OUR OFFERS</h5>
                <a href="#">NEW PRODUCTS</a>
                <a href="#">TOP SELLERS</a>
                <a href="special_offer.html">SPECIAL OFFERS</a>
                <a href="#">MANUFACTURERS</a>
                <a href="#">SUPPLIERS</a>
            </div>
            <div id="socialMedia" class="span3 pull-right">
                <h5>SOCIAL MEDIA </h5>
                <a href="#"><img width="60" height="60" src="/frontend/themes/images/facebook.png" title="facebook" alt="facebook"/></a>
                <a href="#"><img width="60" height="60" src="/frontend/themes/images/twitter.png" title="twitter" alt="twitter"/></a>
                <a href="#"><img width="60" height="60" src="/frontend/themes/images/youtube.png" title="youtube" alt="youtube"/></a>
            </div>
        </div>
        <p class="pull-right">&copy; LLC-TECHNOLOGY</p>
    </div><!-- Container End -->
</div>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
<script src="/frontend/themes/js/jquery.js" type="text/javascript"></script>
<script src="/frontend/themes/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/frontend/themes/js/google-code-prettify/prettify.js"></script>

<script src="/frontend/themes/js/bootshop.js"></script>
<script src="/frontend/themes/js/jquery.lightbox-0.5.js"></script>

</body>
</html>
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
    {{--<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css" />--}}

    <link href="/frontend/themes/css/base.css" rel="stylesheet" media="screen"/>
    <link href="/css/pagination.css" rel="stylesheet" media="screen"/>
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

    <script src="/bower_components/angular/angular.min.js"></script>
    <script src="/frontend/scripts/app.js"></script>
    <script src="/frontend/scripts/search.controller.js"></script>
    <script src="/frontend/scripts/unique.js"></script>
    <script src="/backend/app/packages/dirPagination.js"></script>
    <script src="/backend/app/services/myServices.js"></script>
    <script src="/backend/app/helper/myHelper.js"></script>

    <script src="/bower_components/angular-encode-uri/dist/angular-encode-uri.min.js"></script>

</head>
<body ng-app="app" ng-controller="IdSearchController">
<div id="header">
    <div class="container">
        <!-- Navbar ================================================== -->
        <div id="logoArea" class="navbar">
            <a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-inner">
                {{--<a class="brand" href="index.html"><img src="frontend/themes/images/logo.png" alt="Bootsshop"/></a>--}}
                <a class="brand" href="/"><img src="/frontend/themes/images/ico-cart.png" alt="LCC-TECHNOLOGY"/> LLC-TECHNOLOTY</a>
                <form class="form-inline navbar-search" method="post" >
                    <input class="srchTxt" ng-model="searchText" type="text" placeholder="search..."/>
                    {{--<select class="srchTxt">--}}
                        {{--<option>All</option>--}}
                        {{--<option ng-repeat="b in productCategory">--}}
                            {{--[[b.name]]--}}
                        {{--</option>--}}
                    {{--</select>--}}
                    <button type="button" id="submitButton" class="btn btn-primary" ng-click="searchDB()">Go</button>
                </form>
                <ul id="topMenu" class="nav pull-right">
                    {{--<li class=""><a href="special_offer.html">Specials Offer</a></li>--}}
                    <li class=""><a href="about.html">About</a></li>
                    <li class=""><a href="contact.html">Contact</a></li>
                    <li class="">
                        <a href="/admin" role="button"  style="padding-right:0"><span class="btn btn-large btn-success">Login</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Header End====================================================================== -->
<div id="carouselBlk">
    <div id="myCarousel" class="carousel slide">
        <div class="carousel-inner">
            <div class="item" ng-repeat="img in slider">
                <div class="container">
                    <a href="">
                        <img  style="width:100%" src="/../[[img.name]]" alt="special offers"/></a>
                    {{--<div class="carousel-caption">--}}
                        {{--<h4>Second Thumbnail label</h4>--}}
                        {{--<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>--}}
                    {{--</div>--}}
                </div>
            </div>
            {{--<div class="item">--}}
                {{--<div class="container">--}}
                    {{--<a href="register.html"><img style="width:100%" src="frontend/themes/images/carousel/2.png" alt=""/></a>--}}
                    {{--<div class="carousel-caption">--}}
                        {{--<h4>Second Thumbnail label</h4>--}}
                        {{--<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="item">--}}
                {{--<div class="container">--}}
                    {{--<a href="register.html"><img src="frontend/themes/images/carousel/3.png" alt=""/></a>--}}
                    {{--<div class="carousel-caption">--}}
                        {{--<h4>Second Thumbnail label</h4>--}}
                        {{--<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>--}}
                    {{--</div>--}}

                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="item">--}}
                {{--<div class="container">--}}
                    {{--<a href="register.html"><img src="frontend/themes/images/carousel/4.png" alt=""/></a>--}}
                    {{--<div class="carousel-caption">--}}
                        {{--<h4>Second Thumbnail label</h4>--}}
                        {{--<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>--}}
                    {{--</div>--}}

                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="item">--}}
                {{--<div class="container">--}}
                    {{--<a href="register.html"><img src="frontend/themes/images/carousel/5.png" alt=""/></a>--}}
                    {{--<div class="carousel-caption">--}}
                        {{--<h4>Second Thumbnail label</h4>--}}
                        {{--<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="item">--}}
                {{--<div class="container">--}}
                    {{--<a href="register.html"><img src="frontend/themes/images/carousel/6.png" alt=""/></a>--}}
                    {{--<div class="carousel-caption">--}}
                        {{--<h4>Second Thumbnail label</h4>--}}
                        {{--<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div>
</div>
<div id="mainBody">
    <div class="container">
        <div class="row">
            <!-- Sidebar ================================================== -->
            <div id="sidebar" class="span3">
                {{--<div class="well well-small"><a id="myCart" href="product_summary.html"><img src="frontend/themes/images/ico-cart.png" alt="cart">3 Items in your cart  <span class="badge badge-warning pull-right">$155.00</span></a></div>--}}

                <form>
                    [[categoryId]]
                    <div class="form-group">

                        <select ng-options="size.id as size.name for size in productCategory" ng-model="categoryId" ng-change="searchDB1(categoryId)"></select>

                        {{--<div class="col-sm-6">--}}
                            {{--<select id="input2" class="form-control" ng-model="categoryId">--}}
                                {{--<option value="">All Accounts</option>--}}
                                {{--<option ng-repeat="item in productCategory" value="[[item.id]]" ng-change="searchDB1(item.id)">[[item.name]]</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    </div>


                </form>


                <ul ng-repeat="c in productCategory">
                    <li><a href="/search.html/[[ c.id]][[ 'bar&baz'  | encodeURIComponent ]]"   ng-click="searchDB1(c.id)"><i class="fa fa-play"></i>[[c.name]]</a></li></ul>



                <ul id="sideManu" class="nav nav-tabs nav-stacked">
                    <li class="subMenu open"><a> CATEGORIES </a>
                        [[categoryId]]
                        <ul>
                            <form method="GET">
                            <li><a class="active" href="" ng-click="setAllPro()"><i class="icon-chevron-right"></i> All </a></li>
                            <li ng-repeat='c in productCategory'>
                                <a class="active"  ng-model="categoryId"  ng-click="searchDB1(categoryId)"><i class="icon-chevron-right"></i> [[ c.name ]] </a>
                            </li>
                            </form>
                        </ul>
                    </li>
                </ul>
                <br/>

                {{--<div class="filters">[[filter]]--}}
                    {{--<div>--}}
                        {{--<select name="filter" id="filter" ng-model="filter" ng-options="color.id for color in productCategory" ng-change="changeFilter()"></select>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<a ng-click="resetFilter()" class="filter-reset">Reset Filter</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="list">--}}
                    {{--<p class="car" ng-repeat="car in cars | filter: filter">[[car.make]] [[car.model]] | [[car.category_id]]</p>--}}
                {{--</div>--}}


                    {{--<select ng-model="parentValue"--}}
                            {{--ng-options="parent.key as parent.value for parent in parentOptions">--}}
                    {{--</select>--}}
                    {{--<select ng-model="childValue"--}}
                            {{--ng-options="child.key as child.value for child in childOptions | filter:{category: parentValue}">--}}
                    {{--</select>--}}


                {{--<div class="thumbnail">--}}
                    {{--<img src="frontend/themes/images/products/panasonic.jpg" alt="Bootshop panasonoc New camera"/>--}}
                    {{--<div class="caption">--}}
                        {{--<h5>Panasonic</h5>--}}
                        {{--<h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">$222.00</a></h4>--}}
                    {{--</div>--}}
                {{--</div><br/>--}}
                {{--<div class="thumbnail">--}}
                    {{--<img src="frontend/themes/images/products/kindle.png" title="Bootshop New Kindel" alt="Bootshop Kindel">--}}
                    {{--<div class="caption">--}}
                        {{--<h5>Kindle</h5>--}}
                        {{--<h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">$222.00</a></h4>--}}
                    {{--</div>--}}
                {{--</div><br/>--}}
                <div class="thumbnail">
                    <img src="/frontend/themes/images/payment_methods.png" title="Bootshop Payment Methods" alt="Payments Methods">
                    <div class="caption">
                        <h5>Payment Methods</h5>
                    </div>
                </div>
            </div>
            <!-- Sidebar end=============================================== -->
            <div class="span9">
                <div class="well well-small">
                    <small>PRODUCTS</small>
                    {{--<h4>Featured Products <small class="pull-right">200+ featured products</small></h4>--}}
                    {{--<div class="row-fluid">--}}
                        {{--<div id="featured" class="carousel slide">--}}
                            {{--<div class="carousel-inner">--}}
                                {{--<div class="item active">--}}
                                    {{--<ul class="thumbnails">--}}
                                        {{--<li class="span3" dir-paginate="value in data | itemsPerPage:6 | limitTo:limit" total-items="totalItems">--}}
                                            {{--<div class="thumbnail">--}}
                                                {{--<i class="tag"></i>--}}
                                                {{--<a href="product_details.html"><img src="frontend/themes/images/products/b1.jpg" alt=""></a>--}}
                                                {{--<div class="caption">--}}
                                                    {{--<h5>[[value.product_name]]</h5>--}}
                                                    {{--<h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">$[[value.price]]</span></h4>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}

                            {{--</div>--}}
                            {{--<a class="left carousel-control" href="#featured" data-slide="prev">‹</a>--}}
                            {{--<a class="right carousel-control" href="#featured" data-slide="next">›</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>

                {{--<form class="form-inline">--}}
                    {{--<div class="form-group">--}}
                        {{--<label >Search</label>--}}
                        {{--<input type="text" ng-model="search" class="form-control" placeholder="Search">--}}
                    {{--</div>--}}
                {{--</form>--}}

                <br class="clr"/>
                <form class="form-horizontal span6">
                    <div class="control-group">
                        <label class="control-label alignL">Sort By </label>
                        <select ng-model="sortExpression">
                            <option value="" selected="selected">Product name A - Z</option>
                            <option value="price">Price $0 - Unlimited</option>
                            <option value="category_id">Category name A - Z</option>
                        </select>
                    </div>
                </form>

                <div id="myTab" class="pull-right">
                    <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
                    <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
                </div>
                <br class="clr"/>
                <div class="tab-content">
                    <div class="tab-pane" id="listView">
                        <div class="row" dir-paginate="value in data | itemsPerPage:6" total-items="totalItems">
                        {{--<div class="row" dir-paginate="value in data | itemsPerPage:6 t| filter:showca | orderBy:mySortFunction" total-items="totalItems">--}}
                            <div class="span2">
                                <img src="../../../../../[[value.photo_name]]" height="142" width="142">
                            </div>
                            <div class="span4">
                                <h3>[[value.product_type]] | <span ng-if="value.status == 1">Available</span><span ng-if="value.status == 0">Not Available</span> </h3>
                                <hr class="soft"/>
                                <h5>[[ value.product_name ]] | [[value.category_name]] </h5>
                                <p>
                                   [[value.description]]
                                </p>
                                <a class="btn btn-small pull-right" href="/product_detail.html/[[ value.product_id]][[ 'bar&baz'  | encodeURIComponent ]]">View Details</a>
                                <br class="clr"/>
                            </div>

                            <div class="span3 alignR">
                                <form class="form-horizontal qtyFrm">
                                    <h3> [[value.price | currency]]</h3>
                                    {{--<label class="checkbox">--}}
                                        {{--<input type="checkbox">  Adds product to compair--}}
                                    {{--</label><br/>--}}

                                    {{--<a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>--}}
                                    <a href="/product_detail.html/[[ value.product_id]][[ 'bar&baz'  | encodeURIComponent ]]" class="btn btn-large"><i class="icon-zoom-in"></i></a>

                                </form>
                            </div>
                        </div>
                        <hr class="soft"/>
                    </div>
                    <div class="tab-pane  active" id="blockView">
                        <ul class="thumbnails">
                            <li class="span3" dir-paginate="value in data | itemsPerPage:6 " total-items="totalItems">
                            {{--<li class="span3" dir-paginate="value in data | itemsPerPage:6  | filter:showcat | orderBy:mySortFunction " total-items="totalItems">--}}
                                <div class="thumbnail">
                                    <span ng-if="value.product_type == 'New'"><i class="tag"></i></span>
                                    <b style="color: #120293;"> &nbsp; [[value.category_name]]</b>

                                    <a href="/product_detail.html/[[ value.product_id]][[ 'bar&baz'  | encodeURIComponent ]]">
                                        <img alt="" src="../../../../../[[value.photo_name]]" height="160" width="160"/>
                                    </a>
                                    <div class="caption">
                                        <h5>[[ value.product_name ]]</h5>
                                        <h4 style="text-align:center"><a class="btn" href="/product_detail.html/[[ value.product_id]][[ 'bar&baz'  | encodeURIComponent ]]">
                                                <i class="icon-zoom-in"></i></a>
                                            {{--<a class="btn" href="#">Add to--}}
                                                {{--<i class="icon-shopping-cart"></i></a>--}}
                                            <a class="btn btn-primary" href="/product_detail.html/[[ value.product_id]][[ 'bar&baz'  | encodeURIComponent ]]">[[value.price | currency]]</a></h4>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <hr class="soft"/>
                    </div>
                </div>
                <br class="clr"/>

                <dir-pagination-controls class="pull-right" on-page-change="pageChanged(newPageNumber)"
                                         template-url="/frontend/scripts/dirPagination.html">
                </dir-pagination-controls>

            </div>
        </div>
    </div>
</div>
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


<?php include('includes/header.php'); ?>
<style>
    .modal-header {
        display: -ms-flexbox;
        display: flow;
        -ms-flex-align: start;
        align-items: flex-start;
        -ms-flex-pack: justify;
        justify-content: space-between;
        padding: 1rem 1rem;
        border-bottom: 1px solid #e9ecef;
        border-top-left-radius: 0.3rem;
        border-top-right-radius: 0.3rem;
    }
    p {
        margin-top: 0;
        margin-bottom: 0px;
    }
    .modal-content .modal-body {
        padding-top: 0px;
        margin-top: -21px;
        padding-right: 24px;
        padding-bottom: 16px;
        padding-left: 24px;
        line-height: 1.9;
    }
    .pt {
        font-size: 12px;
        padding: 5px 5px !important;
        font-weight: 500;
    }
</style>
<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>All Social media promotions
             
                </h2>
            </div>            
            <div class="col-lg-7 col-md-7 col-sm-12 text-md-right">
              
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="create-social-media.php"><i class="zmdi zmdi-plus"></i> Create Social media promotion</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">                   
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table td_2 table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Builder Name </th>
                                        <th>Project Name </th>
                                        <th>Budget </th>
                                        <th>Social Media </th>
                                        <th>Impressions</th>
                                        <th>Start to End Date</th>
                                        <th>Description</th>
                                       
                                        <th>Action</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <a href="" data-toggle="modal" data-target="#largeModal"><u>Shobha</u></a>
                                        </td>
                                        <td>Shoba </td>
                                        <td><input type="text" class="form-control" Value="Rs 200000"> </td>
                                        <td>Facebook </td>
                                        <td>200</td>
                                        <td>25/12/2024  - 01/01/2025</td>
                                        <td>"Exclusive limited-time offer"</td>
                                       
                                        <td><a href="accept-request.php"><button type="button" class="btn btn-primary btn-round waves-effect m-t-20" >Accept</button></a> <a href=""><button type="submit" class="btn btn-default btn-round btn-simple"  >Reject</button></a></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            <a href="" data-toggle="modal" data-target="#largeModal"><u>Shobha</u></a>
                                        </td>
                                        <td>Shobha</td>
                                        <td><input type="text" class="form-control" Value="Rs 200000"> </td>
                                        <td>Facebook </td>
                                        <td>200</td>
                                        <td>25/12/2024  - 01/01/2025</td>
                                        <td>"Exclusive limited-time offer"</td>
                                       
                                        <td><a href="accept-request.php"><button type="button" class="btn btn-primary btn-round waves-effect m-t-20" >Accept</button></a> <a href=""><button type="submit" class="btn btn-default btn-round btn-simple"  >Reject</button></a></td>
                                    </tr>
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-7">
                        <h4 class="title" id="largeModalLabel">Charith Aquamarine</h4>
                        <p style="font-size: 12px;"><a href="">Marketed by yogendra</a></p>
                        <p>Rajarajeshwari Nagar, Bangalore</p>
                    </div>
                    <div class="col-md-5">
                        <h4 class="title" id="largeModalLabel">₹ 1.7 Cr | ₹6.43 K/sq.ft</h4>
                        <p style="font-size: 12px;"><a href="">EMI starts at ₹84.49 K</a></p>
                        <p>All Inclusive</p>
                        <br />
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card" style="margin-bottom: -41px;">
                    <div class="header" style="padding: 20px 20px 0px 20px;">
                        <h2><strong>Property Information</strong></h2>
                        <ul class="header-dropdown">
                            <!-- <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                                    <li><a href="javascript:void(0);">Edit</a></li>
                                    <li><a href="javascript:void(0);">Delete</a></li>
                                    <li><a href="javascript:void(0);">Report</a></li>
                                </ul>
                            </li> -->
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered m-b-0">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="pt">PROJECT NAME:</th>
                                        <td class="pt">Royal Appartment</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">BUILDER:</th>
                                        <td class="pt"><span class="badge badge-primary">Shoba</span></td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">PROJECT TYPE:</th>
                                        <td class="pt">udated</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">CONSTRUCTION STATUS:</th>
                                        <td class="pt">Under CONSTRUCTION</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">PROJECT LINK:</th>
                                        <td class="pt">www.shobadevelopers.com</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">PROJECT CONFIGURATION :</th>
                                        <td class="pt">Update</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">PROJECT LOCATION:</th>
                                        <td class="pt">Bangalore</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">PROJECT SIZE:</th>
                                        <td class="pt">12 Acrs</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">PROJECT AREA:</th>
                                        <td class="pt">hebbala</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">PROJECT LAUNCH:</th>
                                        <td class="pt">2026</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">POSSESSION STARTS:</th>
                                        <td class="pt">312/12/2024</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">MIN AREA (SFT):</th>
                                        <td class="pt">1200</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">MAX AREA (SFT):</th>
                                        <td class="pt">4000</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">MIN PRICE:</th>
                                        <td class="pt">90L</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">MAX PRICE:</th>
                                        <td class="pt">3Cr</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">RERA ID:</th>
                                        <td class="pt">RERA34w87477</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">CONTACT EMAIL ID:</th>
                                        <td class="pt">info@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">CONTACT MOBILE:</th>
                                        <td class="pt">3+91-00000000</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">VALIDITY:</th>
                                        <td class="pt">10 year</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-bottom: -41px;">
                <div class="header" style="padding: 20px 20px 0px 20px;">
                    <h2><strong>Project Overview</strong></h2>
                    <ul class="header-dropdown">
                        <!-- <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                                    <li><a href="javascript:void(0);">Edit</a></li>
                                    <li><a href="javascript:void(0);">Delete</a></li>
                                    <li><a href="javascript:void(0);">Report</a></li>
                                </ul>
                            </li> -->
                        <li class="remove">
                            <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <p>
                        BHK Independent House for sale in Vidyaranyapura, Bengaluru with modern-day amenities. The Independent House is in Vidyaranyapura which is a promising investment destination in Bengaluru. This might be your chance to
                        grab the best 5 BHK property for sale in Vidyaranyapura. This 5 BHK Independent House is available at a reasonable price of Rs 1.5 Cr. Residents also need to pay maintenance charges of Rs 0. The built-up area is 2600
                        square_feet. This property has provision for 6 bathroom. It enjoys a strategic location with many reputed and multispeciality hospitals nearby like Carewell Hospital, Puttur kattu MS Palya, Shekar Super Speciality
                        Eye Centre. The brokerage amount to be paid is Rs 150000
                    </p>
                    <p></p>
                </div>
            </div>

            <div class="card" style="margin-bottom: -41px;">
                <div class="header" style="padding: 20px 20px 0px 20px;">
                    <h2><strong>PROJECT IMAGES</strong></h2>
                    <ul class="header-dropdown">
                        <!-- <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                                    <li><a href="javascript:void(0);">Edit</a></li>
                                    <li><a href="javascript:void(0);">Delete</a></li>
                                    <li><a href="javascript:void(0);">Report</a></li>
                                </ul>
                            </li> -->
                        <li class="remove">
                            <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#thumb">PROJECT THUMB</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#banner">PROJECT BANNER</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#general">GENERAL IMAGES</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#actual">ACTUAL IMAGES</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#floor">FLOOR PLAN IMAGE</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane in active" id="thumb">
                            <b>PROJECT THUMB (700X450PX)</b>
                            <div id="demo2" class="carousel slide" data-ride="carousel">
                                <ul class="carousel-indicators">
                                    <li data-target="#demo2" data-slide-to="0" class="active"></li>
                                    <li data-target="#demo2" data-slide-to="1" class=""></li>
                                    <li data-target="#demo2" data-slide-to="2" class=""></li>
                                </ul>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="../assets/images/image-gallery/5.jpg" class="img-fluid" alt="" />
                                        <div class="carousel-caption">
                                            <h3>Chicago</h3>
                                            <p>Thank you, Chicago!</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../assets/images/image-gallery/6.jpg" class="img-fluid" alt="" />
                                        <div class="carousel-caption">
                                            <h3>New York</h3>
                                            <p>We love the Big Apple!</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../assets/images/image-gallery/12.jpg" class="img-fluid" alt="" />
                                        <div class="carousel-caption">
                                            <h3>Los Angeles</h3>
                                            <p>We had such a great time in LA!</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo2" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
                                <a class="carousel-control-next" href="#demo2" data-slide="next"><span class="carousel-control-next-icon"></span></a>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="banner">
                            <b>PROJECT BANNER (1000X450PX)</b>
                            <div id="demo2" class="carousel slide" data-ride="carousel">
                                <ul class="carousel-indicators">
                                    <li data-target="#demo2" data-slide-to="0" class="active"></li>
                                    <li data-target="#demo2" data-slide-to="1" class=""></li>
                                    <li data-target="#demo2" data-slide-to="2" class=""></li>
                                </ul>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="../assets/images/image-gallery/5.jpg" class="img-fluid" alt="" />
                                        <div class="carousel-caption">
                                            <h3>Chicago</h3>
                                            <p>Thank you, Chicago!</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../assets/images/image-gallery/6.jpg" class="img-fluid" alt="" />
                                        <div class="carousel-caption">
                                            <h3>New York</h3>
                                            <p>We love the Big Apple!</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../assets/images/image-gallery/12.jpg" class="img-fluid" alt="" />
                                        <div class="carousel-caption">
                                            <h3>Los Angeles</h3>
                                            <p>We had such a great time in LA!</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo2" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
                                <a class="carousel-control-next" href="#demo2" data-slide="next"><span class="carousel-control-next-icon"></span></a>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="general">
                            <b>GENERAL IMAGES(PRESENTATIONAL)</b>
                            <div id="demo2" class="carousel slide" data-ride="carousel">
                                <ul class="carousel-indicators">
                                    <li data-target="#demo2" data-slide-to="0" class="active"></li>
                                    <li data-target="#demo2" data-slide-to="1" class=""></li>
                                    <li data-target="#demo2" data-slide-to="2" class=""></li>
                                </ul>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="../assets/images/image-gallery/5.jpg" class="img-fluid" alt="" />
                                        <div class="carousel-caption">
                                            <h3>Chicago</h3>
                                            <p>Thank you, Chicago!</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../assets/images/image-gallery/6.jpg" class="img-fluid" alt="" />
                                        <div class="carousel-caption">
                                            <h3>New York</h3>
                                            <p>We love the Big Apple!</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../assets/images/image-gallery/12.jpg" class="img-fluid" alt="" />
                                        <div class="carousel-caption">
                                            <h3>Los Angeles</h3>
                                            <p>We had such a great time in LA!</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo2" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
                                <a class="carousel-control-next" href="#demo2" data-slide="next"><span class="carousel-control-next-icon"></span></a>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="actual">
                            <b>ACTUAL IMAGES(CURRENT)</b>
                            <div id="demo2" class="carousel slide" data-ride="carousel">
                                <ul class="carousel-indicators">
                                    <li data-target="#demo2" data-slide-to="0" class="active"></li>
                                    <li data-target="#demo2" data-slide-to="1" class=""></li>
                                    <li data-target="#demo2" data-slide-to="2" class=""></li>
                                </ul>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="../assets/images/image-gallery/5.jpg" class="img-fluid" alt="" />
                                        <div class="carousel-caption">
                                            <h3>Chicago</h3>
                                            <p>Thank you, Chicago!</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../assets/images/image-gallery/6.jpg" class="img-fluid" alt="" />
                                        <div class="carousel-caption">
                                            <h3>New York</h3>
                                            <p>We love the Big Apple!</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../assets/images/image-gallery/12.jpg" class="img-fluid" alt="" />
                                        <div class="carousel-caption">
                                            <h3>Los Angeles</h3>
                                            <p>We had such a great time in LA!</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo2" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
                                <a class="carousel-control-next" href="#demo2" data-slide="next"><span class="carousel-control-next-icon"></span></a>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="floor">
                            <b>FLOOR PLAN IMAGES</b>
                            <div id="demo2" class="carousel slide" data-ride="carousel">
                                <ul class="carousel-indicators">
                                    <li data-target="#demo2" data-slide-to="0" class="active"></li>
                                    <li data-target="#demo2" data-slide-to="1" class=""></li>
                                    <li data-target="#demo2" data-slide-to="2" class=""></li>
                                </ul>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="../assets/images/image-gallery/5.jpg" class="img-fluid" alt="" />
                                        <div class="carousel-caption">
                                            <h3>Chicago</h3>
                                            <p>Thank you, Chicago!</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../assets/images/image-gallery/6.jpg" class="img-fluid" alt="" />
                                        <div class="carousel-caption">
                                            <h3>New York</h3>
                                            <p>We love the Big Apple!</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../assets/images/image-gallery/12.jpg" class="img-fluid" alt="" />
                                        <div class="carousel-caption">
                                            <h3>Los Angeles</h3>
                                            <p>We had such a great time in LA!</p>
                                        </div>
                                    </div>
                                </div>
                           
                       
                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo2" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
                                <a class="carousel-control-next" href="#demo2" data-slide="next"><span class="carousel-control-next-icon"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-body">
                <div class="card" style="margin-bottom: -41px;">
                    <div class="header" style="padding: 20px 20px 0px 20px;">
                        <h2><strong>CONFIGURATIONS</strong></h2>
                        <ul class="header-dropdown">
                            <!-- <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                                    <li><a href="javascript:void(0);">Edit</a></li>
                                    <li><a href="javascript:void(0);">Delete</a></li>
                                    <li><a href="javascript:void(0);">Report</a></li>
                                </ul>
                            </li> -->
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered m-b-0">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="pt">NO. OF BHK:</th>
                                        <td class="pt">3BHK</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">PROJECT TYPE:</th>
                                        <td class="pt"><span class="badge badge-primary">For Sale</span></td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">PROJECT FACING:</th>
                                        <td class="pt">North</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">SALEABLE AREA (SFT):</th>
                                        <td class="pt">1250</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">CARPET AREA (SFT):</th>
                                        <td class="pt">250000</td>
                                    </tr>
                                    <tr>
                                        <th class="pt" scope="row">PRICE:</th>
                                        <td class="pt">4Cr</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="header" style="padding: 20px 20px 0px 20px;">
                    <h2><strong>General</strong> Amenities</h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            <ul class="list-group">
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Swimming pool</li>
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Air conditioning</li>
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Internet</li>
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Radio</li>
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Balcony</li>
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Roof terrace</li>
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Cable TV</li>
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Electricity</li>
                            </ul>
                        </div>
                        <div class="col-sm-4">
                            <ul class="list-group">
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Terrace</li>
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Cofee pot</li>
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Oven</li>
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Towelwes</li>
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Computer</li>
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Grill</li>
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Parquet</li>
                            </ul>
                        </div>
                        <div class="col-sm-4">
                            <ul class="list-group">
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Dishwasher</li>
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Near Green Zone</li>
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Near Church</li>
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Near Hospital</li>
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Near School</li>
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Near Shop</li>
                                <li class="list-group-item"><i class="zmdi zmdi-check-circle mr-2"></i>Natural Gas</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="header" style="padding: 20px 20px 0px 20px;">
                    <h2><strong>LOCALITY</strong></h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            <div class="local">
                                <p style="font-size: 10px;"><strong>School</strong><br>
                                Sri Sri Ravishankar Vidya Mandir- Best CBSE School in Bangalore North<br>
                                2 mins(1 km)<p>
                                </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="local">
                                <p style="font-size: 10px;"><strong>Hospital</strong><br>
                               Appolo<br>
                                2 mins(1 km)<p>
                                </div>
                        </div>
                        <div class="col-sm-4">
                        <div class="local">
                                <p style="font-size: 10px;"><strong>Bus stop</strong><br>
                               Mejestic<br>
                                2 mins(1 km)<p>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default btn-round waves-effect">SAVE CHANGES</button>
            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
        </div>
        </div>
     
    </div>
</div>
<?php include('includes/footer.php'); ?>

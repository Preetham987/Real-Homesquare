<?php include('includes/header.php'); ?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Create Social Media Promotion
                <small>Welcome to Oreo</small>
                </h2>
            </div> 
                       
          
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Basic</strong> Information <small>Description text here...</small> </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="zmdi zmdi-more-vert"></i></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                        <style>
                                .custom-dropdown {
                                position: relative;
                                display: inline-block;
                                width: 100%;
                            }

                            .dropdown-button {
                                width: 100%;
                                background-color: #fff;
                                border: 1px solid #ccc;
                                padding: 8px;
                                text-align: left;
                                cursor: pointer;
                            }

                            .dropdown-content {
                                display: none;
                                position: absolute;
                                background-color: #fff;
                                border: 1px solid #ccc;
                                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                                width: 100%;
                                z-index: 1;
                                max-height: 150px;
                                overflow-y: auto;
                            }

                            .dropdown-content label {
                                display: block;
                                padding: 8px;
                                cursor: pointer;
                            }

                            .dropdown-content label:hover {
                                background-color: #f1f1f1;
                            }

                            .custom-dropdown:hover .dropdown-content {
                                display: block;
                            }
                        </style>
                        <div class="col-sm-4">
                        <label>Choose Social Media</label>
                        <div class="custom-dropdown">
                            <button class="dropdown-button form-control">-- Please select --</button>
                            <div class="dropdown-content">
                                <label>
                                    <input type="checkbox" name="social-media" value="all">
                                    All
                                </label>
                                <label>
                                    <input type="checkbox" name="social-media" value="facebook">
                                    Facebook
                                </label>
                                <label>
                                    <input type="checkbox" name="social-media" value="instagram">
                                    Instagram
                                </label>
                                <label>
                                    <input type="checkbox" name="social-media" value="youtube">
                                    YouTube
                                </label>
                                <label>
                                    <input type="checkbox" name="social-media" value="linkedin">
                                    LinkedIn
                                </label>
                            </div>
                        </div>
                        </div>
                            <div class="col-sm-4">
                            <label>Start  Date</label>
                                <div class="form-group">
                                    <input type="date" class="form-control" placeholder="Ex: 3BKS Villa">
                                </div>
                            </div>
                            <div class="col-sm-4">
                            <label>End date</label>
                                <div class="form-group">
                                    <input type="date" class="form-control" placeholder="Ex: 4000 Sq.Ft">
                                </div>
                            </div>
                            <div class="col-sm-4">
                            <label>Image(If you have)</label>
                                <div class="form-group">
                                    <input type="file" class="form-control" placeholder="Ex: 4000 Sq.Ft">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea rows="4" class="form-control no-resize" placeholder="Description"></textarea>
                                </div>
                            </div>
                            <!-- <div class="col-sm-4">
                            <label>Price</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Ex: 2Cr">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="4" class="form-control no-resize" placeholder="Property Description"></textarea>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                      
                        <div class="row clearfix">
                         
                           
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary btn-round">Submit</button>
                                <button type="submit" class="btn btn-default btn-round btn-simple">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('includes/footer.php'); ?>

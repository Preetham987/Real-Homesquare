<?php include('includes/header.php'); ?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Create Offers
                </h2>
            </div> 
                       
          
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
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
                        <div class="col-sm-4">
                        <label>Choose Partner Name</label>
                                <select class="form-control show-tick">
                                    <option value="">-- Please select --</option>
                                    <option value="10">All </option>
                                    <option value="20">mahi</option>
                                    <option value="30">sandeep</option>
                                 
                                </select>
                            </div>
                        <div class="col-sm-4">
                        <label>Offer Title</label>
                            <div class="form-group">
                                    <input type="input" class="form-control" placeholder="Ex: 3BKS Villa">
                                </div>
                            </div>
                          
                          
                            <div class="col-sm-4">
                            <label>Offer Validity Start Date</label>
                                <div class="form-group">
                                    <input type="time" class="form-control" placeholder="Ex: 4000 Sq.Ft">
                                </div>
                            </div>
                            <div class="col-sm-4">
                            <label>Offer Validity end Date</label>
                                <div class="form-group">
                                    <input type="time" class="form-control" placeholder="Ex: 4000 Sq.Ft">
                                </div>
                            </div>
                            <div class="col-sm-4">
                            <label>Image(If you have)</label>
                                <div class="form-group">
                                    <input type="file" class="form-control" placeholder="Ex: 4000 Sq.Ft">
                                </div>
                            </div>
                          
                            <div class="col-sm-12">
                            <label>Offer Details</label>
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

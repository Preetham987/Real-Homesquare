<?php include('includes/header.php'); ?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Create Notification
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
                        <div class="col-sm-4">
                        <label>Choose Notification Subject</label>
                                <select class="form-control show-tick">
                                    <option value="">-- Please select --</option>
                                    <option value="10">Offer</option>
                                    <option value="20">Site Visite</option>
                                    <option value="30">Other</option>
                                 
                                </select>
                            </div>
                            <div class="col-sm-4">
                            <label>Followup Date</label>
                                <div class="form-group">
                                    <input type="date" class="form-control" placeholder="Ex: 3BKS Villa">
                                </div>
                            </div>
                            <div class="col-sm-4">
                            <label>Followup Time</label>
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

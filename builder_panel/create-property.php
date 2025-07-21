<?php include('includes/header.php'); ?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Create Property
                </h2>
            </div>            
            <div class="col-lg-7 col-md-7 col-sm-12 text-md-right">


                <!-- <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="create-property.php"><i class="zmdi zmdi-plus"></i> Create Property</a></li>
                </ul> -->
                
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
                        <h5>Add property details</h5>
                        <div class="row clearfix">
                        <div class="col-lg-4 col-md-6">
                            <label>Choose Project</label>
                                <select class="form-control show-tick">
                                    <option value="">-- Please select --</option>
                                    <option value="10">Royal Strret</option>
                                    <option value="20">Villa</option>
                                    <option value="30">Apartment</option>
                                 
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <!-- 1st bar -->
                                    <label>Property Name</label>
                                    <input type="text" class="form-control" placeholder="Office,Villa,Apartment">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <!-- 2nd bar -->
                                    <label>Property Type</label>
                                    <label>Choose Project</label>
                                <select class="form-control show-tick">
                                    <option value="">-- Please select --</option>
                                  
                                    <option value="20">Villa</option>
                                    <option value="30">Apartment</option>
                                 
                                </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <!-- 3rd bar -->
                                    <label>Baths</label>
                                    <input type="text" class="form-control" placeholder="Project Size in Acrs">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <!-- 4th bar -->
                                    <label>Property Status</label>
                                    <select class="form-control show-tick">
                                    <option value="">-- Please select --</option>
                                    <option value="10">For Sale</option>
                                    <option value="20">For Rent</option>
                                </select>
                            </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <!-- 5th bar -->
                                    <label>Property Price</label>
                                    <input type="text" class="form-control" placeholder="Rs 2600">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <!-- 6th bar -->
                                    <label>Area</label>
                                    <input type="text" class="form-control" placeholder="88 Sq Ft">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <!-- 7th bar -->
                                    <label>Address</label>
                                    <input type="text" class="form-control" placeholder="Address of your property">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <!-- 8th bar -->
                                    <label>Enter City</label>
                                    <input type="text" class="form-control" placeholder="Bangalore ">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <!-- 9th bar -->
                                    <label>Landmark</label>
                                    <input type="text" class="form-control" placeholder="Landmark Place Name">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <!-- 10th bar -->
                                    <label>Zip code</label>
                                    <input type="text" class="form-control" placeholder="39702">
                                </div>
                            </div>
                            
                        
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Description</label>
                                        <textarea rows="4" class="form-control no-resize" placeholder="Project  Description"></textarea>
                                    </div>
                                </div>
                            </div>  

                            <div class="col-sm-12">
                            <div class="dropzone-admin">
                                        <label>Media</label>
                                        <form class="dropzone dz-clickable" id="multiFileUpload" action="https://themes.pixelstrap.com/upload.php">
                                            <div class="dz-message needsclick"> 
                                            <h6>Drop files here or click to upload.</h6>
                                            </div>
                                        </form>
                            </div>
                            </div>
                            
                            <div class="form-group col-sm-6">
                                            <label>Video (mp4)</label>
                                            <input type="file" class="form-control" placeholder="mp4 video link">
                            </div>

                            <div class="form-group col-sm-6">
                                            <label>Floor Plan</label>
                                            <input type="file" class="form-control" placeholder="Floor Plan link">
                            </div>
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
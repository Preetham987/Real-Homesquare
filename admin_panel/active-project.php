<?php include('includes/header.php'); ?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Active Project List</h2>
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
                                        <th>Project name</th>
                                        <th>Project Location</th>
                                        <th>Project Size in Acrs</th>
                                        <th>Project Images</th>
                                        <th>Status</th>
                                        <th>Expire Date</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Sunrise Nepal</td>
                                        <td>Bangalore, Hebbal-560076</td>
                                        <td>18 Acr</td>
                                        <td><img src="../assets/images/image-gallery/1.jpg" style="width:100px"></td>
                                        <td><span class="badge badge-success">Active</span></td>
                                        <td>12/12/2024</td>
                                        <td>Projet Description here</td>
                                        <td><a href="edit-project.php"><i class="material-icons" style="color:green">border_color</i></a> <a href=""><i class="material-icons" style="color:red">delete</i></a></td>
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
<?php include('includes/footer.php'); ?>

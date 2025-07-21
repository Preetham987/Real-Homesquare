<?php include('includes/header.php'); ?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Bank Details

                </h2>
            </div>            
            <div class="col-lg-7 col-md-7 col-sm-12 text-md-right">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="add-bank-details.php"><i class="zmdi zmdi-plus"></i> Add Bank Details</a></li>
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
                                    <th>Branch Logo</th>
                                    <th>Bank Name</th>
                                    <th>Rate of Interest</th>
                                    <th>Offers</th>
                                    <th>Uploaded Document</th>
                                    <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr>
                                    <td>1</td>
                                    <td><img src="logosbibank.jpg" style="width:100px"></td>
                                    <td>State Bank of India</td>
                                    <td>10%</td>
                                    <td>2 Offers</td>
                                    <td>
                                    <a href=""><span class="badge badge-last mb-0">Download</span></a>
                                    </td>
                                    <td>
                                        <a href="edit-bank.php" style="display: inline-block;"> <i class="material-icons" style="color:green">border_color</i> </a>
                                            <a href="deleted-bank.php" style="display: inline-block;"><i class="material-icons" style="color:red">delete</i>
                                            </a>
                                        </td>   
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

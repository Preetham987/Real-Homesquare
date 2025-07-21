<?php include('includes/header.php'); ?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Project List
                <small>Welcome to Oreo</small>
                </h2>
            </div>            
            <div class="col-lg-7 col-md-7 col-sm-12 text-md-right">
                <div class="inlineblock text-center m-r-15 m-l-15 hidden-md-down">
                 <!--   <div class="sparkline" data-type="bar" data-width="97%" data-height="25px" data-bar-Width="2" data-bar-Spacing="5" data-bar-Color="#fff">3,2,6,5,9,8,7,9,5,1,3,5,7,4,6</div>
                    <small class="col-white">Visitors</small>-->
                </div>
                <div class="inlineblock text-center m-r-15 m-l-15 hidden-md-down">
                <!--    <div class="sparkline" data-type="bar" data-width="97%" data-height="25px" data-bar-Width="2" data-bar-Spacing="5" data-bar-Color="#fff">1,3,5,7,4,6,3,2,6,5,9,8,7,9,5</div>
                    <small class="col-white">Bounce Rate</small>-->
                </div>
                <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right ml-3" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="create-project.php"><i class=""></i>Create Project</a></li>
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
                                        <th>Project Name</th>
                                        <th>Address</th>
                                        <th>Area</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Bunglow</td>
                                        <td>Chicago</td>
                                        <td>1000m</td>
                                        <td><img src="assets/images/profile_av.jpg" alt="Image"></td>
                                        <td>Beautiful bunglow</td>
                                        <td>
                                        <a href="edit-project.php" style="display: inline-block;">
                                                    <button style="background-color: transparent; border: none; cursor: pointer;">
                                                        <img src="edit.png" alt="" style="width: 20px; height: 20px;">
                                                    </button>
                                                </a>
                                        
                                              <!-- Icon Button 2 -->
                                              <a href="deleted-project-list.php" style="display: inline-block;">
                                              <button style="background-color: transparent; border: none; cursor: pointer;">
                                                <img src="delete.png" alt="" style="width: 20px; height: 20px;">
                                              </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Apartmrnt</td>
                                        <td>New York</td>
                                        <td>1200m</td>
                                        <td><img src="assets/images/profile_av.jpg" alt="Image"></td>
                                        <td>Beautiful apartment</td>
                                        <td>
                                        <a href="edit-project.php" style="display: inline-block;">
                                                    <button style="background-color: transparent; border: none; cursor: pointer;">
                                                        <img src="edit.png" alt="" style="width: 20px; height: 20px;">
                                                    </button>
                                                </a>
                                        
                                              <!-- Icon Button 2 -->
                                              <a href="deleted-project-list.php" style="display: inline-block;">
                                              <button style="background-color: transparent; border: none; cursor: pointer;">
                                                <img src="delete.png" alt="" style="width: 20px; height: 20px;">
                                              </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Palace</td>
                                        <td>Pune</td>
                                        <td>1300m</td>
                                        <td><img src="assets/images/profile_av.jpg" alt="Image"></td>
                                        <td>Beautiful palace</td>
                                        <td>
                                        <a href="edit-project.php" style="display: inline-block;">
                                                    <button style="background-color: transparent; border: none; cursor: pointer;">
                                                        <img src="edit.png" alt="" style="width: 20px; height: 20px;">
                                                    </button>
                                                </a>
                                        
                                              <!-- Icon Button 2 -->
                                              <a href="deleted-project-list.php" style="display: inline-block;">
                                              <button style="background-color: transparent; border: none; cursor: pointer;">
                                                <img src="delete.png" alt="" style="width: 20px; height: 20px;">
                                              </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Villa</td>
                                        <td>New Delhi</td>
                                        <td>1000m</td>
                                        <td><img src="assets/images/profile_av.jpg" alt="Image"></td>
                                        <td>Beautiful villa</td>
                                        <td>
                                        <a href="edit-project.php" style="display: inline-block;">
                                                    <button style="background-color: transparent; border: none; cursor: pointer;">
                                                        <img src="edit.png" alt="" style="width: 20px; height: 20px;">
                                                    </button>
                                                </a>
                                        
                                              <!-- Icon Button 2 -->
                                              <a href="deleted-project-list.php" style="display: inline-block;">
                                              <button style="background-color: transparent; border: none; cursor: pointer;">
                                                <img src="delete.png" alt="" style="width: 20px; height: 20px;">
                                              </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Apartment</td>
                                        <td>Mumbai</td>
                                        <td>1250m</td>
                                        <td><img src="assets/images/profile_av.jpg" alt="Image"></td>
                                        <td>Beautiful apartment</td>
                                        <td>
                                        <a href="edit-project.php" style="display: inline-block;">
                                                    <button style="background-color: transparent; border: none; cursor: pointer;">
                                                        <img src="edit.png" alt="" style="width: 20px; height: 20px;">
                                                    </button>
                                                </a>
                                        
                                              <!-- Icon Button 2 -->
                                              <a href="deleted-project-list.php" style="display: inline-block;">
                                              <button style="background-color: transparent; border: none; cursor: pointer;">
                                                <img src="delete.png" alt="" style="width: 20px; height: 20px;">
                                              </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Villa</td>
                                        <td>Bangalore</td>
                                        <td>1500m</td>
                                        <td><img src="assets/images/profile_av.jpg" alt="Image"></td>
                                        <td>Beautiful villa</td>
                                        <td>
                                        <a href="edit-project.php" style="display: inline-block;">
                                                    <button style="background-color: transparent; border: none; cursor: pointer;">
                                                        <img src="edit.png" alt="" style="width: 20px; height: 20px;">
                                                    </button>
                                                </a>
                                        
                                              <!-- Icon Button 2 -->
                                              <a href="deleted-project-list.php" style="display: inline-block;">
                                              <button style="background-color: transparent; border: none; cursor: pointer;">
                                                <img src="delete.png" alt="" style="width: 20px; height: 20px;">
                                              </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Bunglow</td>
                                        <td>Austin</td>
                                        <td>1100m</td>
                                        <td><img src="assets/images/profile_av.jpg" alt="Image"></td>
                                        <td>Beautiful bunglow</td>
                                        <td>
                                        <a href="edit-project.php" style="display: inline-block;">
                                                    <button style="background-color: transparent; border: none; cursor: pointer;">
                                                        <img src="edit.png" alt="" style="width: 20px; height: 20px;">
                                                    </button>
                                                </a>
                                        
                                              <!-- Icon Button 2 -->
                                              <a href="deleted-project-list.php" style="display: inline-block;">
                                              <button style="background-color: transparent; border: none; cursor: pointer;">
                                                <img src="delete.png" alt="" style="width: 20px; height: 20px;">
                                              </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Apartment</td>
                                        <td>Alaska</td>
                                        <td>1250m</td>
                                        <td><img src="assets/images/profile_av.jpg" alt="Image"></td>
                                        <td>Beautiful apartment</td>
                                        <td>
                                        <a href="edit-project.php" style="display: inline-block;">
                                                    <button style="background-color: transparent; border: none; cursor: pointer;">
                                                        <img src="edit.png" alt="" style="width: 20px; height: 20px;">
                                                    </button>
                                                </a>
                                        
                                              <!-- Icon Button 2 -->
                                              <a href="deleted-project-list.php" style="display: inline-block;">
                                              <button style="background-color: transparent; border: none; cursor: pointer;">
                                                <img src="delete.png" alt="" style="width: 20px; height: 20px;">
                                              </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Palace</td>
                                        <td>Bangalore</td>
                                        <td>1300m</td>
                                        <td><img src="assets/images/profile_av.jpg" alt="Image"></td>
                                        <td>Beautiful palace</td>
                                        <td>
                                        <a href="edit-project.php" style="display: inline-block;">
                                                    <button style="background-color: transparent; border: none; cursor: pointer;">
                                                        <img src="edit.png" alt="" style="width: 20px; height: 20px;">
                                                    </button>
                                                </a>
                                        
                                              <!-- Icon Button 2 -->
                                              <a href="deleted-project-list.php" style="display: inline-block;">
                                              <button style="background-color: transparent; border: none; cursor: pointer;">
                                                <img src="delete.png" alt="" style="width: 20px; height: 20px;">
                                              </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Villa</td>
                                        <td>Bangalore</td>
                                        <td>1050m</td>
                                        <td><img src="assets/images/profile_av.jpg" alt="Image"></td>
                                        <td>Beautiful villa</td>
                                        <td>
                                        <a href="edit-project.php" style="display: inline-block;">
                                                    <button style="background-color: transparent; border: none; cursor: pointer;">
                                                        <img src="edit.png" alt="" style="width: 20px; height: 20px;">
                                                    </button>
                                                </a>
                                        
                                              <!-- Icon Button 2 -->
                                              <a href="deleted-project-list.php" style="display: inline-block;">
                                              <button style="background-color: transparent; border: none; cursor: pointer;">
                                                <img src="delete.png" alt="" style="width: 20px; height: 20px;">
                                              </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>Apartment</td>
                                        <td>Chennai</td>
                                        <td>1700m</td>
                                        <td><img src="assets/images/profile_av.jpg" alt="Image"></td>
                                        <td>Beautiful apartment</td>
                                        <td>
                                        <a href="edit-project.php" style="display: inline-block;">
                                                    <button style="background-color: transparent; border: none; cursor: pointer;">
                                                        <img src="edit.png" alt="" style="width: 20px; height: 20px;">
                                                    </button>
                                                </a>
                                        
                                              <!-- Icon Button 2 -->
                                              <a href="deleted-project-list.php" style="display: inline-block;">
                                              <button style="background-color: transparent; border: none; cursor: pointer;">
                                                <img src="delete.png" alt="" style="width: 20px; height: 20px;">
                                              </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>Villa</td>
                                        <td>London</td>
                                        <td>2000m</td>
                                        <td><img src="assets/images/profile_av.jpg" alt="Image"></td>
                                        <td>Beautiful bunglow</td>
                                        <td>
                                        <a href="edit-project.php" style="display: inline-block;">
                                                    <button style="background-color: transparent; border: none; cursor: pointer;">
                                                        <img src="edit.png" alt="" style="width: 20px; height: 20px;">
                                                    </button>
                                                </a>
                                        
                                              <!-- Icon Button 2 -->
                                              <a href="deleted-project-list.php" style="display: inline-block;">
                                              <button style="background-color: transparent; border: none; cursor: pointer;">
                                                <img src="delete.png" alt="" style="width: 20px; height: 20px;">
                                              </button>
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

<?php
include('includes/header.php');
include('includes/db.php');

// Fetch projects where the validity has expired
$query = "SELECT * FROM builder_panel_projects_table WHERE validity <= NOW()";
$result = mysqli_query($conn, $query);
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Expired Projects</h2>
            </div>            
            <div class="col-lg-7 col-md-7 col-sm-12 text-md-right">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="create-project.php"><i class="zmdi zmdi-plus"></i> Create Project</a></li>
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
                                        <th>Project Location</th>
                                        <th>Project Size in Acres</th>
                                        <th>Project Images</th>
                                        <th>Status</th>
                                        <th>Description</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>
                                            <td>{$count}</td>
                                            <td>{$row['project_name']}</td>
                                            <td>{$row['project_location']}</td>
                                            <td>{$row['project_size']} Acres</td>
                                            <td><img src='{$row['project_images']}' style='width:100px'></td>
                                            <td><span class='badge badge-danger'>Expired</span></td>
                                            <td>{$row['project_overview']}</td>
                                            <td>{$row['created_at']}</td>
                                        </tr>";                                
                                        $count++;
                                    }
                                    ?>
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

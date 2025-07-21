<?php include('includes/header.php'); ?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>All Leads
                </h2>
            </div>            
            <!--<div class="col-lg-7 col-md-7 col-sm-12 text-md-right">-->
            <!--<ul class="breadcrumb float-md-right">-->
            <!--        <li class="breadcrumb-item"><a href="property-add.php"><i class="zmdi zmdi-plus"></i> Create Leads</a></li>-->
            <!--    </ul>-->
            <!--</div>-->
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">            
            <div class="col-lg-12">
                <div class="card">                   
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table td_2 table-striped table-hover js-basic-example dataTable vcenter">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Project</th>
                                        <th>Leads From</th>
                                        <th>leads Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                include('includes/db.php');
                                $i = 1;
                                $query = $conn->query("SELECT name, email, phone, address, project, 'Website' AS source, created_at FROM leads ORDER BY created_at DESC");
                                
                                while ($row = $query->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>{$i}</td>";
                                    echo "<td><span>" . htmlspecialchars($row['name']) . "</span></td>";
                                    echo "<td><span>" . htmlspecialchars($row['email']) . "</span></td>";
                                    echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['project']) . "</td>";
                                    echo "<td><button type='button' class='btn btn-primary btn-round waves-effect m-t-20'>" . htmlspecialchars($row['source']) . "</button></td>";
                                    echo "<td>" . date("d/m/Y", strtotime($row['created_at'])) . "</td>";
                                    echo "</tr>";
                                    $i++;
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

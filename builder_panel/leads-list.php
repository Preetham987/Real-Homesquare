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
                                session_start();
                                
                                if (!isset($_SESSION['username'])) {
                                    echo "<tr><td colspan='8'>Unauthorized access.</td></tr>";
                                    return;
                                }
                                
                                $loggedInUsername = $_SESSION['username'];
                                
                                // Step 1: Fetch builder_name from builders_table for the logged-in username
                                $stmt = $conn->prepare("SELECT builder_name FROM builders_table WHERE username = ?");
                                $stmt->bind_param("s", $loggedInUsername);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                
                                if ($result->num_rows === 0) {
                                    echo "<tr><td colspan='8'>Builder not found.</td></tr>";
                                    return;
                                }
                                
                                $row = $result->fetch_assoc();
                                $builderName = $row['builder_name'];
                                
                                // Step 2: Fetch leads where the project belongs to the builder
                                $query = $conn->prepare("
                                    SELECT 
                                        leads.name, 
                                        leads.email, 
                                        leads.phone, 
                                        leads.address, 
                                        leads.project, 
                                        'Website' AS source, 
                                        leads.created_at 
                                    FROM 
                                        leads 
                                    INNER JOIN 
                                        builder_panel_projects_table 
                                    ON 
                                        leads.project = builder_panel_projects_table.slug 
                                    WHERE 
                                        builder_panel_projects_table.builder_name = ?
                                    ORDER BY 
                                        leads.created_at DESC
                                ");
                                
                                $query->bind_param("s", $builderName);
                                $query->execute();
                                $leadsResult = $query->get_result();

                                $i = 1;
                                while ($lead = $leadsResult->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>{$i}</td>";
                                    echo "<td><span>" . htmlspecialchars($lead['name']) . "</span></td>";
                                    echo "<td><span>" . htmlspecialchars($lead['email']) . "</span></td>";
                                    echo "<td>" . htmlspecialchars($lead['phone']) . "</td>";
                                    echo "<td>" . htmlspecialchars($lead['address']) . "</td>";
                                    echo "<td><a href='https://rigvesoft.com/homesquare/real-estate-panels-2/real/" . urlencode($lead['project']) . "' target='_blank' style='text-decoration: underline;'>" . htmlspecialchars($lead['project']) . "</a></td>";
                                    echo "<td><button type='button' class='btn btn-primary btn-round waves-effect m-t-20'>" . htmlspecialchars($lead['source']) . "</button></td>";
                                    echo "<td>" . date("d/m/Y", strtotime($lead['created_at'])) . "</td>";
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

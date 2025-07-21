<?php
include('includes/header.php');
include('includes/db.php');
session_start(); // Ensure session is started

$builderName = null;
$projects = [];

// Step 1: Get builder_name using session username
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $builderQuery = "SELECT builder_name FROM builders_table WHERE username = ?";
    $stmtBuilder = mysqli_prepare($conn, $builderQuery);
    mysqli_stmt_bind_param($stmtBuilder, "s", $username);
    mysqli_stmt_execute($stmtBuilder);
    mysqli_stmt_bind_result($stmtBuilder, $builderName);
    mysqli_stmt_fetch($stmtBuilder);
    mysqli_stmt_close($stmtBuilder);

    // Step 2: Fetch projects for this builder_name
    if ($builderName) {
        $projectsQuery = "SELECT * FROM projects_table WHERE builder_name = ?";
        $stmtProjects = mysqli_prepare($conn, $projectsQuery);
        mysqli_stmt_bind_param($stmtProjects, "s", $builderName);
        mysqli_stmt_execute($stmtProjects);
        $resultProjects = mysqli_stmt_get_result($stmtProjects);

        while ($row = mysqli_fetch_assoc($resultProjects)) {
            $projects[] = $row;
        }

        mysqli_stmt_close($stmtProjects);
    }
}
?>

<style>
    .modal-header {
        display: -ms-flexbox;
        display: flow;
        -ms-flex-align: start;
        align-items: flex-start;
        -ms-flex-pack: justify;
        justify-content: space-between;
        padding: 1rem 1rem;
        border-bottom: 1px solid #e9ecef;
        border-top-left-radius: 0.3rem;
        border-top-right-radius: 0.3rem;
    }
    p {
        margin-top: 0;
        margin-bottom: 0px;
    }
    .modal-content .modal-body {
        padding-top: 0px;
        margin-top: -21px;
        padding-right: 24px;
        padding-bottom: 16px;
        padding-left: 24px;
        line-height: 1.9;
    }
    .pt {
        font-size: 12px;
        padding: 5px 5px !important;
        font-weight: 500;
    }
</style>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>All Project List</h2>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 text-md-right">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item">
                        <a href="create-project.php"><i class="zmdi zmdi-plus"></i> Create Project</a>
                    </li>
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
                                        <th>PROJECT NAME</th>
                                        <th>BUILDER</th>
                                        <th>PROJECT TYPE</th>
                                        <th>CONSTRUCTION STATUS?</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $found = false;
                                $i = 1;
                                
                                // Fetch from builder_panel_projects_table
                                $query1 = "SELECT * FROM builder_panel_projects_table WHERE is_deleted=0";
                                $result1 = mysqli_query($conn, $query1);
                                
                                if (mysqli_num_rows($result1) > 0) {
                                    while ($row = mysqli_fetch_assoc($result1)) {
                                        if ($builderName && $row['builder_name'] === $builderName) {
                                            $found = true;
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo htmlspecialchars($row['project_name']); ?></td>
                                                <td><?php echo htmlspecialchars($row['builder_name']); ?></td>
                                                <td><?php echo htmlspecialchars($row['project_type']); ?></td>
                                                <td><?php echo htmlspecialchars($row['construction_status']); ?></td>
                                                <td>
                                                    <a href="edit-project.php?id=<?php echo $row['id']; ?>">
                                                        <i class="material-icons" style="color: green;">border_color</i>
                                                    </a> 
                                                    <a href="javascript:void(0);" onclick="softDeleteProject(<?php echo $row['id']; ?>)">
                                                        <i class="material-icons" style="color: red;">delete</i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                }
                                
                                // Fetch from projects_table as well
                                $query2 = "SELECT * FROM projects_table WHERE builder_name = ?";
                                $stmt2 = mysqli_prepare($conn, $query2);
                                mysqli_stmt_bind_param($stmt2, "s", $builderName);
                                mysqli_stmt_execute($stmt2);
                                $result2 = mysqli_stmt_get_result($stmt2);
                                
                                if (mysqli_num_rows($result2) > 0) {
                                    while ($row = mysqli_fetch_assoc($result2)) {
                                        $found = true;
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo htmlspecialchars($row['project_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['builder_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['project_type']); ?></td>
                                            <td><?php echo htmlspecialchars($row['construction_status']); ?></td>
                                            <td>
                                                <!-- You can link to a different edit page or disable delete if not required -->
                                                <a href="edit-project.php?id=<?php echo $row['id']; ?>">
                                                    <i class="material-icons" style="color: green;">border_color</i>
                                                </a> 
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    mysqli_stmt_close($stmt2);
                                }
                                
                                if (!$found) {
                                    echo "<tr><td colspan='6' class='text-center'>No projects found for your builder</td></tr>";
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

<script>
function softDeleteProject(projectId) {
    Swal.fire({
        title: "Are you sure?",
        text: "This project will be deleted!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("delete-project.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id: projectId, action: "soft_delete" })
            })
            .then(response => response.json())
            .then(data => {
                Swal.fire({
                    title: "Success!",
                    text: data.message,
                    icon: "success"
                }).then(() => location.reload());
            })
            .catch(error => console.error("Error:", error));
        }
    });
}
</script>

<?php include('includes/footer.php'); ?>

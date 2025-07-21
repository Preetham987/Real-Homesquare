<?php include('includes/header.php'); ?>
<?php include('includes/db.php'); ?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Deleted Projects</h2>
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
                            <?php
                            // Fetch soft-deleted projects (is_deleted = 1)
                            $query = "SELECT * FROM agent_panel_projects_table WHERE is_deleted = 1";
                            $result = mysqli_query($conn, $query);
                            ?>
                            
                            <table class="table td_2 table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Property Type</th>
                                        <th>Address</th>
                                        <th>Size</th>
                                        <th>Agent/Admin</th>
                                        <th>Sale/Rent</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo htmlspecialchars($row['property_type']); ?></td>
                                                <td><?php echo htmlspecialchars($row['property_address']); ?></td>
                                                <td><?php echo htmlspecialchars($row['size']); ?></td>
                                                <td>Agent</td> 
                                                <td><?php echo htmlspecialchars($row['configuration']); ?></td>
                                                <td><?php echo htmlspecialchars($row['price']); ?></td>
                                                <td>
                                                    <a href="javascript:void(0);" onclick="restoreProject(<?php echo $row['id']; ?>)">
                                                        <i class="material-icons" style="color:green">cached</i>
                                                    </a>
                                                    <a href="javascript:void(0);" onclick="hardDeleteProject(<?php echo $row['id']; ?>)">
                                                        <i class="material-icons" style="color:red">delete</i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='8' class='text-center'>No properties found</td></tr>";
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

<script>
function restoreProject(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "This project will be restored!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, restore it!"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("restore-project.php?id=" + id)
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    Swal.fire("Restored!", data.message, "success").then(() => location.reload());
                } else {
                    Swal.fire("Error!", data.message, "error");
                }
            })
            .catch(() => {
                Swal.fire("Error!", "Failed to connect to the server", "error");
            });
        }
    });
}

function hardDeleteProject(projectId) {
    Swal.fire({
        title: "Are you sure?",
        text: "This will permanently delete the project!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete permanently!"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("delete-project.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id: projectId, action: "hard_delete" }) 
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    Swal.fire({
                        title: "Deleted!",
                        text: data.message,
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        location.reload(); // Reloads the page after clicking "OK"
                    });
                } else {
                    Swal.fire("Error!", data.message, "error");
                }
            })
            .catch(() => {
                Swal.fire("Error!", "Something went wrong.", "error");
            });
        }
    });
}
</script>

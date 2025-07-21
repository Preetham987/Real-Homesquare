<?php include('includes/header.php'); ?>
<?php include 'includes/db.php'; ?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Property List</h2>
            </div>            
            <div class="col-lg-7 col-md-7 col-sm-12 text-md-right">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="property-add.php"><i class="zmdi zmdi-plus"></i> Add Property</a></li>
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
                                    $query = "SELECT * FROM agent_panel_projects_table WHERE is_deleted=0";
                                    $result = mysqli_query($conn, $query);
                                    
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
                                                    <a href="edit-property.php?id=<?php echo $row['id']; ?>">
                                                        <i class="material-icons" style="color: green;">border_color</i>
                                                    </a> 
                                                    <a href="javascript:void(0);" onclick="softDeleteProject(<?php echo $row['id']; ?>)">
                                                        <i class="material-icons" style="color: red;">delete</i> <!-- Soft Delete -->
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

<script>
    function softDeleteProject(projectId) {
    Swal.fire({
        title: "Are you sure?",
        text: "This property will be deleted!",
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

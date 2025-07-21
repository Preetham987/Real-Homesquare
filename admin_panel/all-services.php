<?php 
include('includes/header.php'); 
include('includes/db.php');

// Fetch only active services (not soft-deleted)
$query = "SELECT id, service_name, description, service_image FROM services_table WHERE is_deleted = 0";
$result = mysqli_query($conn, $query);
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>All Services</h2>
            </div>            
            <div class="col-lg-7 col-md-7 col-sm-12 text-md-right">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="create-services.php"><i class="zmdi zmdi-plus"></i> Create Service</a></li>
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
                                        <th>Service Image</th>
                                        <th>Service Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="serviceTableBody">
                                    <?php 
                                    $count = 1;
                                    while ($row = mysqli_fetch_assoc($result)) { 
                                        $service_id = $row['id']; 
                                    ?>
                                        <tr id="service_<?php echo $service_id; ?>">
                                            <td><?php echo $count; ?></td>
                                            <td><img src="<?php echo htmlspecialchars($row['service_image']); ?>" style="width:100px;"></td>
                                            <td><?php echo htmlspecialchars($row['service_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                                            <td>
                                                <a href="edit-services.php?id=<?php echo $service_id; ?>">
                                                    <i class="material-icons" style="color:green">border_color</i>
                                                </a> 
                                                <a href="javascript:void(0);" onclick="softDeleteService(<?php echo $service_id; ?>);">
                                                    <i class="material-icons" style="color:red">delete</i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php 
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

<script>
function softDeleteService(serviceId) {
    Swal.fire({
        title: "Are you sure?",
        text: "This service will be moved to the deleted list!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("delete-service.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id: serviceId, action: "soft_delete" }) 
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    let row = document.getElementById("service_" + serviceId);
                    if (row) row.style.display = "none";
                    Swal.fire("Deleted!", data.message, "success");
                } else {
                    Swal.fire("Error!", data.message, "error");
                }
            })
            .catch(error => {
                Swal.fire("Error!", "Something went wrong.", "error");
            });
        }
    });
}
</script>

<?php include('includes/footer.php'); ?>

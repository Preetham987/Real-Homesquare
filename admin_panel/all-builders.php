<?php 
include('includes/header.php'); 
include('includes/db.php');

// Fetch only active builders (not soft-deleted)
$query = "SELECT id, builder_name, phone_number, email, address FROM builders_table WHERE is_deleted = 0";
$result = mysqli_query($conn, $query);
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>All Builders</h2>
            </div>            
            <div class="col-lg-7 col-md-7 col-sm-12 text-md-right">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="create-builders.php"><i class="zmdi zmdi-plus"></i> Create Builder</a></li>
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
                                        <th>Builder Name</th>
                                        <th>Phone Number</th>
                                        <th>Email ID</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="builderTableBody">
                                    <?php 
                                    $count = 1;
                                    while ($row = mysqli_fetch_assoc($result)) { 
                                        $builder_id = $row['id']; 
                                    ?>
                                        <tr id="builder_<?php echo $builder_id; ?>">
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo htmlspecialchars($row['builder_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                                            <td>
                                                <a href="edit-builders.php?id=<?php echo $builder_id; ?>">
                                                    <i class="material-icons" style="color:green">border_color</i>
                                                </a> 
                                                <a href="javascript:void(0);" onclick="softDeleteBuilder(<?php echo $builder_id; ?>);">
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
function softDeleteBuilder(builderId) {
    Swal.fire({
        title: "Are you sure?",
        text: "This builder will be moved to the deleted list!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("delete-builder.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id: builderId, action: "soft_delete" }) 
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    let row = document.getElementById("builder_" + builderId);
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

<?php 
session_start();
include('includes/header.php'); 
include('includes/db.php');

// Fetch deleted builders from the database (where is_deleted = 1)
$query = "SELECT id, builder_name, phone_number, email, address FROM builders_table WHERE is_deleted = 1";
$result = mysqli_query($conn, $query);
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Deleted Builders</h2>
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
                                        <th>Email Id</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $count = 1;
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) { 
                                            $builder_id = $row['id']; 
                                    ?>
                                        <tr id="deleted_builder_<?php echo $builder_id; ?>">
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo htmlspecialchars($row['builder_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                                            <td>
                                                <a href="javascript:void(0);" onclick="restoreBuilder(<?php echo $builder_id; ?>);">
                                                    <i class="material-icons" style="color:green">cached</i>
                                                </a>
                                                <a href="javascript:void(0);" onclick="hardDeleteBuilder(<?php echo $builder_id; ?>);">
                                                    <i class="material-icons" style="color:red">delete</i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php 
                                            $count++;
                                        } 
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center'>No deleted builders found</td></tr>";
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
function restoreBuilder(builderId) {
    Swal.fire({
        title: "Are you sure?",
        text: "This builder will be restored to the active list!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, restore it!"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("restore-builders.php?id=" + builderId, {
                method: "GET"
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    Swal.fire("Restored!", data.message, "success").then(() => {
                        document.getElementById("deleted_builder_" + builderId).remove();
                    });
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

function hardDeleteBuilder(builderId) {
    Swal.fire({
        title: "Are you sure?",
        text: "This will permanently delete the builder!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete permanently!"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("delete-builder.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id: builderId, action: "hard_delete" }) 
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    let row = document.getElementById("deleted_builder_" + builderId);
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

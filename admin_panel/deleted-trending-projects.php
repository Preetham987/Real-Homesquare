<?php 
session_start();
include('includes/header.php'); 
include('includes/db.php');

// Fetch deleted trending projects from the database (where is_deleted = 1)
$query = "SELECT id, project_name, location, area_size, price, image_path FROM trending_projects_table WHERE is_deleted = 1";
$result = mysqli_query($conn, $query);
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Deleted Trending Projects</h2>
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
                                        <th>Location</th>
                                        <th>Area/Size</th>
                                        <th>Price</th>
                                        <th>Project Images</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $count = 1;
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) { 
                                            $project_id = $row['id']; 
                                    ?>
                                        <tr id="deleted_project_<?php echo $project_id; ?>">
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo htmlspecialchars($row['project_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['location']); ?></td>
                                            <td><?php echo htmlspecialchars($row['area_size']); ?></td>
                                            <td><?php echo htmlspecialchars($row['price']); ?></td>
                                            <td>
                                                <img src="<?php echo htmlspecialchars($row['image_path']); ?>" style="width:100px;">
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" onclick="restoreProject(<?php echo $project_id; ?>);">
                                                    <i class="material-icons" style="color:green">cached</i>
                                                </a>
                                                <a href="javascript:void(0);" onclick="deletePermanently(<?php echo $project_id; ?>);">
                                                    <i class="material-icons" style="color:red">delete</i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php 
                                            $count++;
                                        } 
                                    } else {
                                        echo "<tr><td colspan='7' class='text-center'>No deleted projects found</td></tr>";
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
function restoreProject(projectId) {
    Swal.fire({
        title: "Are you sure?",
        text: "This project will be restored to the active list!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, restore it!"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("restore-trending-projects.php?id=" + projectId, {
                method: "GET"
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    Swal.fire("Restored!", data.message, "success").then(() => {
                        document.getElementById("deleted_project_" + projectId).remove();
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

function deletePermanently(projectId) {
    Swal.fire({
        title: "Are you sure?",
        text: "This project will be permanently deleted!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete permanently!"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("delete-trending-project.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id: projectId, action: "hard_delete" }) 
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    let row = document.getElementById("deleted_project_" + projectId);
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

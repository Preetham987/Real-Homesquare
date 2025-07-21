<?php 
include('includes/header.php'); 
include('includes/db.php');

// Fetch projects that are not deleted and whose validity hasn't expired
$query = "SELECT * FROM builder_panel_projects_table WHERE is_deleted = 0 AND validity >= CURDATE()";
$result = mysqli_query($conn, $query);
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>All Trending Projects</h2>
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
                                        <th>Trending</th>
                                    </tr>
                                </thead>
                                <tbody id="projectsTableBody">
                                    <?php 
                                    $count = 1;
                                    while ($row = mysqli_fetch_assoc($result)) { 
                                        $project_id = $row['id'];
                                    ?>
                                        <tr id="project_<?php echo $project_id; ?>">
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo htmlspecialchars($row['project_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['project_location']); ?></td>
                                            <td><?php echo htmlspecialchars($row['project_size']); ?></td>
                                            <td><?php echo htmlspecialchars($row['price']); ?></td>
                                            <td>
                                                <?php 
                                                $bannerImages = explode(',', $row['banner_image']);
                                                $mainBanner = $bannerImages[0] ?? '';
                                                ?>
                                                <img src="<?php echo htmlspecialchars($mainBanner); ?>" style="width:100px; height:auto;">
                                            </td>
                                            <td>
                                                <button class="btn btn-sm <?php echo ($row['trending'] == 'Trending') ? 'btn-success' : 'btn-secondary'; ?>" 
                                                        onclick="toggleTrending(<?php echo $row['id']; ?>, this)">
                                                    <?php echo htmlspecialchars($row['trending']); ?>
                                                </button>
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
function toggleTrending(projectId, button) {
    let currentStatus = button.innerText.trim();
    let newStatus = (currentStatus === "Trending") ? "Not-trending" : "Trending";
    let newClass = (newStatus === "Trending") ? "btn-success" : "btn-secondary";

    // AJAX Request to update the status in the database
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "edit-trending-project.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            console.log("Response: ", xhr.responseText); // Debugging log

            if (xhr.status === 200 && xhr.responseText.trim() === "success") {
                button.innerText = newStatus;
                button.className = "btn btn-sm " + newClass;
            } else {
                alert("Error updating status: " + xhr.responseText);
            }
        }
    };

    xhr.send("id=" + projectId + "&status=" + encodeURIComponent(newStatus));
}
</script>
<script>
function softDeleteProject(projectId) {
    Swal.fire({
        title: "Are you sure?",
        text: "This project will be moved to the deleted list!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("delete-trending-project.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id: projectId, action: "soft_delete" }) 
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    let row = document.getElementById("project_" + projectId);
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

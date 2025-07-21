<?php 
include('includes/header.php'); 
include('includes/db.php');

// Fetch data from projects_table
$query = "SELECT id, project_name, project_link, banner_image, banner FROM builder_panel_projects_table WHERE is_deleted = 0 AND validity >= CURDATE()";
$result = mysqli_query($conn, $query);
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>All Projects</h2>
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
                                        <th>Project Banner</th>
                                        <th>Project Name</th>
                                        <th>Project Link</th>
                                        <th>Active Banners</th>
                                    </tr>
                                </thead>
                                <tbody id="projectTableBody">
                                    <?php 
                                    $count = 1;
                                    while ($row = mysqli_fetch_assoc($result)) { 
                                        $project_id = $row['id']; 
                                    ?>
                                        <tr id="project_<?php echo $project_id; ?>">
                                            <td><?php echo $count; ?></td>
                                            <td>
                                                <?php 
                                                    $bannerImages = explode(',', $row['banner_image']);
                                                    $mainBanner = $bannerImages[0] ?? '';
                                                ?>
                                                <img src="<?php echo htmlspecialchars($mainBanner); ?>" style="width:100px;">
                                            </td>
                                            <td><?php echo htmlspecialchars($row['project_name']); ?></td>
                                            <td><a href="<?php echo htmlspecialchars($row['project_link']); ?>" target="_blank"><?php echo htmlspecialchars($row['project_link']); ?></a></td>
                                            <td>
                                                <button class="btn btn-sm <?php echo ($row['banner'] == 'Active') ? 'btn-success' : 'btn-secondary'; ?>" 
                                                        onclick="toggleBanner(<?php echo $row['id']; ?>, this)">
                                                    <?php echo htmlspecialchars($row['banner']); ?>
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
function toggleBanner(projectId, button) {
    const currentStatus = button.innerText.trim();
    const newStatus = (currentStatus === 'Active') ? 'Inactive' : 'Active';

    fetch('edit-banner.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: projectId, banner: newStatus })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            button.innerText = newStatus;
            button.classList.toggle('btn-success', newStatus === 'Active');
            button.classList.toggle('btn-secondary', newStatus === 'Inactive');
        } else {
            alert('Failed to update banner status.');
        }
    })
    .catch(() => alert('An error occurred.'));
}
</script>


<?php include('includes/footer.php'); ?>

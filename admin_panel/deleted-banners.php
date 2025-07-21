<?php 
session_start();
include('includes/header.php'); 
include('includes/db.php');

// Fetch deleted banners from the database (where is_deleted = 1)
$query = "SELECT id, main_heading, sub_heading, banner_image FROM banner_table WHERE is_deleted = 1";
$result = mysqli_query($conn, $query);
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Deleted Banners</h2>
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
                                        <th>Banner Image</th>
                                        <th>Main Heading</th>
                                        <th>Sub Heading</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $count = 1;
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) { 
                                            $banner_id = $row['id']; 
                                    ?>
                                        <tr id="deleted_banner_<?php echo $banner_id; ?>">
                                            <td><?php echo $count; ?></td>
                                            <td><img src="<?php echo htmlspecialchars($row['banner_image']); ?>" style="width:100px;"></td>
                                            <td><?php echo htmlspecialchars($row['main_heading']); ?></td>
                                            <td><?php echo htmlspecialchars($row['sub_heading']); ?></td>
                                            <td>
                                                <a href="javascript:void(0);" onclick="restoreBanner(<?php echo $banner_id; ?>);">
                                                    <i class="material-icons" style="color:green">cached</i>
                                                </a>
                                                <a href="javascript:void(0);" onclick="hardDeleteBanner(<?php echo $banner_id; ?>);">
                                                    <i class="material-icons" style="color:red">delete</i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php 
                                            $count++;
                                        } 
                                    } else {
                                        echo "<tr><td colspan='5' class='text-center'>No deleted banners found</td></tr>";
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
function restoreBanner(bannerId) {
    Swal.fire({
        title: "Are you sure?",
        text: "This banner will be restored to the active list!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, restore it!"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("restore-banner.php?id=" + bannerId, {
                method: "GET"
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    Swal.fire("Restored!", data.message, "success").then(() => {
                        document.getElementById("deleted_banner_" + bannerId).remove(); // Remove the row
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

function hardDeleteBanner(bannerId) {
    Swal.fire({
        title: "Are you sure?",
        text: "This will permanently delete the banner!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete permanently!"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("delete-banner.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id: bannerId, action: "hard_delete" }) 
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    let row = document.getElementById("deleted_banner_" + bannerId);
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

<?php
include('includes/header.php');
include('includes/db.php');
?>

<style>
    .modal-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        padding: 1rem 1rem;
        border-bottom: 1px solid #e9ecef;
        border-top-left-radius: 0.3rem;
        border-top-right-radius: 0.3rem;
    }
    p {
        margin: 0;
    }
    .modal-content .modal-body {
        padding: 0 24px 16px;
        margin-top: -21px;
        line-height: 1.9;
    }
    .pt {
        font-size: 12px;
        padding: 5px !important;
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
                            <?php
                            $query = "SELECT * FROM builder_panel_projects_table 
                                      WHERE validity > NOW() 
                                      AND is_deleted = 0";
                            $result = mysqli_query($conn, $query);
                            ?>
                            <table class="table td_2 table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>PROJECT NAME</th>
                                        <th>BUILDER</th>
                                        <th>PROJECT TYPE</th>
                                        <th>CONSTRUCTION STATUS</th>
                                        <th>PROJECT LINK</th>
                                        <th>CREATED AT</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><?= htmlspecialchars($row['project_name']) ?></td>
                                            <td><?= htmlspecialchars($row['builder_name']) ?></td>
                                            <td><?= htmlspecialchars($row['project_type']) ?></td>
                                            <td><?= htmlspecialchars($row['construction_status']) ?></td>
                                            <td>
                                                <a href="<?= htmlspecialchars($row['project_link']) ?>" target="_blank">
                                                    <?= htmlspecialchars($row['project_link']) ?>
                                                </a>
                                            </td>
                                            <td><?= htmlspecialchars($row['created_at']) ?></td>
                                            <td>
                                                <a href="edit-project.php?id=<?= $row['id'] ?>">
                                                    <i class="material-icons" style="color: green;">border_color</i>
                                                </a> 
                                                <a href="javascript:void(0);" onclick="softDeleteProject(<?= $row['id'] ?>)">
                                                    <i class="material-icons" style="color: red;">delete</i> 
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
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
function toggleStatus(button, employeeId) {
    const newStatus = (button.innerText.trim() === "Active") ? "Inactive" : "Active";

    fetch("update-project-status.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `id=${employeeId}&status=${newStatus}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            button.innerText = newStatus;
            button.style.backgroundColor = (newStatus === "Active") ? "green" : "red";
        } else {
            Swal.fire("Error!", data.message || "Failed to update status.", "error");
        }
    })
    .catch(err => {
        console.error(err);
        Swal.fire("Error!", "Something went wrong.", "error");
    });
}

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
                    title: "Deleted!",
                    text: data.message || "Project deleted successfully.",
                    icon: "success"
                }).then(() => location.reload());
            })
            .catch(error => {
                console.error("Error:", error);
                Swal.fire("Error!", "Failed to delete project.", "error");
            });
        }
    });
}
</script>

<style>
.status-btn {
    padding: 5px 10px;
    border: none;
    cursor: pointer;
    color: white;
    border-radius: 5px;
}
</style>

<?php include('includes/footer.php'); ?>

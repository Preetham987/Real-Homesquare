<?php
session_start();

// Show different headers based on login status
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    include('includes/header1.php');
} else {
    include('includes/header.php');
}
?>
<!--header-end-->

<!--content-->
<div class="content">
                    <!--container-->
                    <div class="container">
                        <!--breadcrumbs-list-->
                        <div class="breadcrumbs-list bl_flat">
                            <a href="#">Home</a><a href="#">Dashboard</a><span>Current Listings</span>
                            <div class="breadcrumbs-list_dec"><i class="fa-thin fa-arrow-up"></i></div>
                        </div>
                        <!--breadcrumbs-list end-->					
                        <!--main-content-->
                        <div class="main-content  ms_vir_height">
                            <!--boxed-container-->
                            <div class="boxed-container">
                                <div class="row">
                                    <!-- user-dasboard-menu_wrap -->	
                                    <div class="col-lg-3">
                                    <?php include ('includes/side-bar.php');?>

                                    </div>
                                    <!-- user-dasboard-menu_wrap end-->
                                    <!-- pricing-column -->	
                                    <div class="col-lg-9">
                                        <div class="dashboard-title">
                                            <div class="dashboard-title-item"><span> Current Listings</span></div>
                                            <!--Tariff Plan menu-->
                                            <!--<div class="tfp-det-container">-->
                                            <!--    <div class="db-date"><i class="fa-regular fa-calendar"></i><strong></strong></div>-->
                                            <!--    <div class="tfp-btn"><span>Your Tariff Plan : </span> <strong>Extended</strong></div>-->
                                            <!--    <div class="tfp-det">-->
                                            <!--        <p>You Are on <a href="#">Extended</a> . Use link bellow to view details or upgrade. </p>-->
                                            <!--        <a href="#" class="tfp-det-btn color-b  g">View Details <i class="fa-solid fa-caret-right"></i></a>-->
                                            <!--    </div>-->
                                            <!--</div>  -->
                                            <!--Tariff Plan menu end-->						
                                        </div>
                                        <div class="db-container">
                                            <div class="dasboard-opt-header">
                                                <div class="dashboard-search-listing">
                                                    <input type="text" id="searchInput" onclick="this.select()" placeholder="Search (Based of Title)" value="">
                                                    <button type="submit"><i class="far fa-search"></i></button>
                                                </div>
                                                <!--<div class="db-price-opt-container">-->
                                                    <!-- price-opt-->
                                                <!--    <div class="db-price-opt">-->
                                                <!--        <span class="price-opt-title">Sort by:</span>-->
                                                <!--        <div class="cs-intputwrap" style="margin-bottom: 0">-->
                                                <!--            <i class="fa-light fa-arrow-down-small-big"></i>-->
                                                <!--            <select data-placeholder="Popularity" class="chosen-select no-search-select">-->
                                                <!--                <option>Lastest</option>-->
                                                <!--                <option>Oldest</option>-->
                                                <!--                <option>Name: A-Z</option>-->
                                                <!--                <option>Name: Z-A</option>-->
                                                <!--            </select>-->
                                                <!--        </div>-->
                                                <!--    </div>-->
                                                    <!-- price-opt end-->
                                                <!--</div>-->
                                            </div>
                                            <div class="row" id="listing-container">
                                                <!-- Listings will be appended here -->
                                            </div>
                                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                            <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                let allProjects = [];
                                            
                                                function clearListings() {
                                                    const container = document.getElementById('listing-container');
                                                    container.innerHTML = '';
                                                    console.log('Listings cleared');
                                                }
                                            
                                                function renderListingsFromList(projects) {
                                                    const container = document.getElementById('listing-container');
                                                    console.log('Rendering', projects.length, 'projects');
                                            
                                                    projects.forEach(item => {
                                                        const card = document.createElement('div');
                                                        card.classList.add('col-lg-6');
                                                        card.innerHTML = `
                                                            <div class="bookings-item">
                                                                <div class="bookings-item-header">
                                                                    <img src="../admin_panel/${item.project_images}" alt="">
                                                                    <h4>${item.Main_title}</h4>
                                                                </div>
                                                                <div class="bookings-item-content">
                                                                    <ul>
                                                                        <li>Type: <span>${item.Type || 'N/A'}</span></li>
                                                                        <li>Area: <span>${item.Area}</span></li>
                                                                        <li>Price: <span>${item.Price}</span></li>
                                                                        <li>City: <span>${item.City}</span></li>
                                                                        <li>Category: <span>${item.Category}</span></li>    
                                                                    </ul>
                                                                </div>
                                                                <div class="bookings-item-footer">
                                                                    <ul>
                                                                        <li><a href="edit-property.php?id=${item.id}" class="tolt" data-microtip-position="left" data-tooltip="Edit"><i class="fa-regular fa-edit"></i></a></li>
                                                                        <li><a href="#" class="tolt delete-btn" data-id="${item.id}" data-microtip-position="left" data-tooltip="Delete"><i class="fa-regular fa-trash-can"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        `;
                                                        container.appendChild(card);
                                                    });
                                            
                                                    bindDeleteButtons();
                                                }
                                            
                                                function bindDeleteButtons() {
                                                    document.querySelectorAll('.delete-btn').forEach(btn => {
                                                        btn.addEventListener('click', function (e) {
                                                            e.preventDefault();
                                                            const projectId = this.getAttribute('data-id');
                                            
                                                            Swal.fire({
                                                                title: 'Are you sure?',
                                                                text: "This action cannot be undone!",
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#d33',
                                                                cancelButtonColor: '#3085d6',
                                                                confirmButtonText: 'Yes, delete it!'
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    window.location.href = `delete-property.php?id=${projectId}`;
                                                                }
                                                            });
                                                        });
                                                    });
                                                }
                                            
                                                // Fetch all project data and render immediately
                                                fetch('current-listing-fetch-code.php')
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        console.log('Fetched project data:', data);
                                                        allProjects = data;
                                                        renderListingsFromList(allProjects);
                                            
                                                        // Hide Load More button (if present) since it's not needed
                                                        const paginationWrap = document.querySelector('.pagination-wrap');
                                                        if (paginationWrap) paginationWrap.style.display = 'none';
                                                    })
                                                    .catch(error => console.error('Error fetching data:', error));
                                            
                                                // Show deletion success popup if redirected after delete
                                                const urlParams = new URLSearchParams(window.location.search);
                                                if (urlParams.get('deleted') === '1') {
                                                    Swal.fire({
                                                        title: 'Deleted!',
                                                        text: 'The listing was successfully deleted.',
                                                        icon: 'success',
                                                        confirmButtonText: 'OK'
                                                    }).then(() => {
                                                        window.location.href = window.location.pathname;
                                                    });
                                                }
                                            
                                                // Search logic
                                                const searchInput = document.getElementById('searchInput');
                                                if (searchInput) {
                                                    searchInput.addEventListener('input', function () {
                                                        const query = this.value.trim().toLowerCase();
                                                        console.log('Search query:', query);
                                            
                                                        const filtered = allProjects
                                                            .filter(project => project.Main_title.toLowerCase().includes(query))
                                                            .sort((a, b) => a.Main_title.localeCompare(b.Main_title));
                                            
                                                        console.log('Filtered projects:', filtered);
                                            
                                                        clearListings();
                                                        renderListingsFromList(filtered);
                                            
                                                        // Hide pagination during search
                                                        const paginationWrap = document.querySelector('.pagination-wrap');
                                                        if (paginationWrap) paginationWrap.style.display = query ? 'none' : 'block';
                                                    });
                                                } else {
                                                    console.warn('Search input field with id "searchInput" not found!');
                                                }
                                            });
                                            </script>
                                        </div>
                                        <!--<div class="pagination-wrap">-->
                                        <!--    <div class="load-more_btn"><i class="fa-solid fa-arrows-spin"></i>Load More</div>-->
                                        <!--</div>-->
                                    </div>
                                    <!-- pricing-column end-->											
                                </div>
                                <div class="limit-box"></div>
                            </div>
                            <!--boxed-container end-->
                        </div>
                        <!--main-content end-->
                        <div class="to_top-btn-wrap">
                            <div class="to-top to-top_btn"><span>Back to top</span> <i class="fa-solid fa-arrow-up"></i></div>
                            <div class="svg-corner svg-corner_white"  style="top:0;left:  -40px; transform: rotate(-90deg)"></div>
                            <div class="svg-corner svg-corner_white"  style="top:0;right: -40px; transform: rotate(-180deg)"></div>
                        </div>
                    </div>
                    <!-- container end-->
                </div>

<?php include ('includes/footer.php');?>

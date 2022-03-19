<?php
include "core.php";
head();
?>
	<div class="col-md-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-images"></i> Gallery</div>
                <div class="card-body">
                    <div class="row">
<?php
$run   = mysqli_query($connect, "SELECT * FROM `gallery` WHERE active='Yes' ORDER BY id DESC");
$count = mysqli_num_rows($run);
if ($count <= 0) {
    echo '<div class="alert alert-info">There are no added images.</div>';
} else {
    while ($row = mysqli_fetch_assoc($run)) {
        echo '

            <div class="col-md-4 mb-3" data-bs-toggle="modal" data-bs-target="#p' . $row['id'] . '" class="col-md-4">
             
                <div class="card shadow-sm">
                    <img src="' . $row['image'] . '" alt="' . $row['title'] . '" style="width: 100%; height: 180px;">

                    <div class="card-body">
                        <h6 class="card-title">' . $row['title'] . '</h6>
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#p' . $row['id'] . '" class="btn btn-sm btn-outline-secondary col-12">
                                <i class="fas fa-info-circle"></i> Details
                            </button>
                        </div>
                    </div>
                </div>
            
            </div>

			<div class="modal" id="p' . $row['id'] . '" tabindex="-1" role="dialog">
			  <div class="modal-dialog modal-lg">
 			   <div class="modal-content">
 			     <div class="modal-header">
 			       <h5 class="modal-title">' . $row['title'] . '</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 			     </div>
			     <div class="modal-body">
				      <img src="' . $row['image'] . '" width="100%" height="auto" alt="' . $row['title'] . '" /><br /><br />
				      ' . html_entity_decode($row['description']) . '
				 </div>
			    </div>
			  </div>
			</div>
';
    }
}
?>
                </div>
            </div>
        </div>
	</div>
</div></div>
<?php
footer();
?>
<?php
  if ($_SESSION['login_type'] != 1 ){
    header("location: login.php"); 
    session_destroy();
  }
?>
    <script>
        // function autoRefresh() {
        //     window.location = window.location.href;
        // }
        // setInterval('autoRefresh()', 20000);
    </script>
<div class="container-fluid">
    <?php
    include 'db_connect.php';

    // Fetch data for category_id = 1
    $category1_users = $conn->query("
        SELECT users.*, votes.* 
        FROM votes 
        INNER JOIN users ON votes.user_id = users.id
        WHERE votes.category_id = 1
    ");

    // Fetch data for category_id = 2
    $category2_users = $conn->query("
        SELECT users.*, votes.* 
        FROM votes 
        INNER JOIN users ON votes.user_id = users.id
        WHERE votes.category_id = 2
    ");

	 // Count users for category_id = 1
	 $count_category1 = $conn->query("
	 SELECT COUNT(*) as total_count
	 FROM votes 
	 WHERE category_id = 1
	")->fetch_assoc();

	// Count users for category_id = 2
	$count_category2 = $conn->query("
	 SELECT COUNT(*) as total_count
	 FROM votes 
	 WHERE category_id = 2
	 ")->fetch_assoc();
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card-body">
                    <div id="category1-table">
                        <h4><b>EROSION TOTAL VOTES: <?php echo $count_category1['total_count']; ?></b></h4>
                        <table class="table-responsive-sm table-striped table-bordered col-md-12">
                            <!-- Table header -->
                            <thead>
                                <tr>
                                    <th class="text-center">S/N</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <!-- Table body -->
                            <tbody>
                                <?php
                        $i = 1;
                        while ($row = $category1_users->fetch_assoc()):
                        ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo htmlspecialchars($row['name']) ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-success change-category"
                                            data-user-id="<?php echo $row['id']; ?>" data-new-category="2">Change
                                            Category</button>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-lg-6">
                <div class="card-body">
                    <div id="category1-table">
                        <h3><b>IFE TOTAL VOTES: <?php echo $count_category2['total_count']; ?></b></h3>
                        <table class="table-responsive-sm table-striped table-bordered col-md-12">
                            <!-- Table header -->
                            <thead>
                                <tr>
                                    <th class="text-center">S/N</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <!-- Table body -->
                            <tbody>
                                <div id="category1-table"> <?php
                        $i = 1;
                        while ($row = $category2_users->fetch_assoc()):
                        ?>
                                    <tr>
                                        <td><?php echo $i++ ?></td>
                                        <td><?php echo htmlspecialchars($row['name']) ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-success change-category"
                                                data-user-id="<?php echo $row['id']; ?>" data-new-category="1">Change
                                                Category</button>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function() {
        $('.change-category').click(function() {
            var userId = $(this).data('user-id');
            var newCategory = $(this).data(1);

            // Send AJAX request
            $.ajax({
                url: 'update_vote.php', // Your PHP script to handle the update
                method: 'POST',
                data: {
                    user_id: userId,
                    new_category: newCategory
                },
                success: function(response) {
                    // Handle the response (e.g., show a success message)
                    if (response === 'success') {
                        alert('Category updated successfully!');
                        // You might also refresh the table or do other actions here
                    } else {
                        alert('An error occurred. Category could not be updated.');
                    }
                },
                error: function() {
                    alert('An error occurred. Category could not be updated.');
                }
            });
        });
    });

    function updateTables() {
        $.ajax({
            url: 'update_votes.php', // Your PHP script to fetch updated data
            method: 'GET',
            success: function(data) {
                // Update the content of each table
                $('#category1-table').html(data.category1);
                $('#category2-table').html(data.category2);
            },
            error: function() {
                console.log('An error occurred while updating tables.');
            }
        });
    }
    // Call the updateTables function every 5 seconds (adjust interval as needed)
    setInterval(updateTables, 5000); // 5000 milliseconds = 5 seconds
    </script>
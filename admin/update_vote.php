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

$category1_table_html = '<h4><b>EROSION TOTAL VOTES: ' . $count_category1['total_count'] . '</b></h4>';
$category1_table_html .= '<table class="table-responsive-sm table-striped table-bordered col-md-12">';
// ... Add the table rows for category1_users here
$category1_table_html .= '</table>';

$category2_table_html = '<h3><b>IFE TOTAL VOTES: ' . $count_category2['total_count'] . '</b></h3>';
$category2_table_html .= '<table class="table-responsive-sm table-striped table-bordered col-md-12">';
// ... Add the table rows for category2_users here
$category2_table_html .= '</table>';

$data = [
    'category1' => $category1_table_html,
    'category2' => $category2_table_html
];

header('Content-Type: application/json');
echo json_encode($data);
?>
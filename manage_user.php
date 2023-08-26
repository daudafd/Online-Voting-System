<?php 
include('db_connect.php');
if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM users where id =".$_GET['id']);
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
?>
<div class="container-fluid">

    <form action="" id="manage-user">
        <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control"
                value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control"
                value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control"
                value="<?php echo isset($meta['password']) ? $meta['id']: '' ?>" required>
        </div>
		<div class="form-group">
            <label for="type">Local Government</label>
            <select name="lga" id="lga" class="custom-select">
                <option value="Akoko North East" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected': '' ?>>Akoko North East
                </option>
                <option value="Akoko North West" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected': '' ?>>Akoko North West
                </option>
                <option value="Akoko South East" <?php echo isset($meta['type']) && $meta['type'] == 3 ? 'selected': '' ?>>Akoko South East
                </option>
				<option value="Akoko South West" <?php echo isset($meta['type']) && $meta['type'] == 4 ? 'selected': '' ?>>Akoko South West
                </option>
                <option value="Akure North" <?php echo isset($meta['type']) && $meta['type'] == 5 ? 'selected': '' ?>>Akure North
                </option>
				<option value="Akure South" <?php echo isset($meta['type']) && $meta['type'] == 6 ? 'selected': '' ?>>Akure South
                </option>
                <option value="Ese Odo" <?php echo isset($meta['type']) && $meta['type'] == 7 ? 'selected': '' ?>>Ese Odo
                </option>
				<option value="Idanre" <?php echo isset($meta['type']) && $meta['type'] == 8 ? 'selected': '' ?>>Idanre
                </option>
                <option value="Ifedore" <?php echo isset($meta['type']) && $meta['type'] == 9 ? 'selected': '' ?>>Ifedore
                </option>
				<option value="Ilaje" <?php echo isset($meta['type']) && $meta['type'] == 10 ? 'selected': '' ?>>Ilaje
                </option>
                <option value="Ile Oluji/Okeigbo" <?php echo isset($meta['type']) && $meta['type'] == 11 ? 'selected': '' ?>>Ile Oluji/Okeigbo
                </option>
				<option value="Irele" <?php echo isset($meta['type']) && $meta['type'] == 12 ? 'selected': '' ?>>Irele
                </option>
                <option value="Odigbo" <?php echo isset($meta['type']) && $meta['type'] == 13 ? 'selected': '' ?>>Odigbo
                </option>
				<option value="Okitipupa" <?php echo isset($meta['type']) && $meta['type'] == 14 ? 'selected': '' ?>>Okitipupa
                </option>
                <option value="Ondo East" <?php echo isset($meta['type']) && $meta['type'] == 15 ? 'selected': '' ?>>Ondo East
                </option>
				<option value="Ondo West" <?php echo isset($meta['type']) && $meta['type'] == 16 ? 'selected': '' ?>>Ondo West
                </option>
				<option value="Ose" <?php echo isset($meta['type']) && $meta['type'] == 17 ? 'selected': '' ?>>Ose
                </option>
                <option value="Owo" <?php echo isset($meta['type']) && $meta['type'] == 18 ? 'selected': '' ?>>Owo
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="type">User Type</label>
            <select name="type" id="type" class="custom-select">
                <!-- <option value="1" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected': '' ?>>Admin
                </option> -->
                <option value="2" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected': '' ?>>User
                </option>
            </select>
        </div>
    </form>
</div>
<script>
$('#manage-user').submit(function(e) {
    e.preventDefault();
    start_load();
    
    var formData = $(this).serialize();
    
    $.ajax({
        url: 'ajax.php?action=save_user',
        method: 'POST',
        data: formData,
        success: function(resp) {
            if (resp == 1) {
                alert_toast("Data successfully saved", 'success');
                setTimeout(function() {
                    location.reload();
                }, 1500);
            }
        }
    });
});

// Adding Delete User functionality
// function delete_user($id){
// 		start_load()
// 		$.ajax({
// 			url:'ajax.php?action=delete_user',
// 			method:'POST',
// 			data:{id:$id},
// 			success:function(resp){
// 				if(resp == 1){
// 					alert_toast("Data successfully deleted",'success')
// 					setTimeout(function(){
// 						location.reload()
// 					},1500)

// 				}
// 			}
// 		})
// 	}
</script>
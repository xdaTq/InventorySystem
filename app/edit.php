<?php
require_once './database/config.php';
require './func/functions.php';

session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}
$id = $_GET['id'];

if(isset($_POST['update'])) {

	$item = $_POST['item'];
	$count = $_POST['count'];
	$desc = $_POST['desc'];
    $s_n = $_POST['s_n'];

	$query = mysqli_query($con, "UPDATE `items` SET `item`='$item', `count`='$count', `desc`='$desc', `s_n`='$s_n' WHERE `id` = '$id'");

	header("Location: dashboard.php");
}

$fetch_data = mysqli_query($con, "SELECT * FROM `items` WHERE `id` = '$id'");

while($item_data = mysqli_fetch_array($fetch_data)) {

	$item = $item_data['item'];
	$count = $item_data['count'];
	$desc = $item_data['desc'];
    $s_n = $item_data['s_n'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>InventorySystem - Edit Item</title>
    <style>
        body {
            background-color: #fff;
        }
    </style>
</head>
<body>
    <div class="container w-25 pt-5">
        <div class="card">
            <div class="row">
                <div class="col-sm">
                    <h3 class="text-center pt-3">Edit Item</h3>
                </div>
            </div>
            <div class="card-body">
                <form name="update_user" action="edit.php?id=<?= $_GET['id']; ?>&action=edit" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="item" value="<?php echo $item ?>" required>
                        <br>
                        <input type="number" class="form-control" name="count" value="<?php echo $count ?>" required>
                        <br>
                        <input type="text" class="form-control" name="s_n" value="<?php echo $s_n ?>" required>
                        <br>
                        <textarea style="resize: none;" class="form-control" name="desc" cols="3" rows="3" required><?php echo $desc ?></textarea>
    
                        <button type="submit" name="update" class="btn btn-primary mt-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-plus-fill" viewBox="0 0 16 16">
                                <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 1.59 2.498C8 14 8 13 8 12.5a4.5 4.5 0 0 1 5.026-4.47L15.964.686Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                                <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5Z"/>
                            </svg>
                            Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
require_once "./database/config.php";
require 'functions.php';
// Initialize the session
session_start();

if (isset($_POST['items-submit'])) {
    createItem($_POST);
}

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

// inv
$get_item = getItem();

if(isset($_GET['action']) && $_GET['id']){
    $id = $_GET['id'];
    if($_GET['action'] === 'delete'){
        delete($id);
    }
} else {
    ?>
        <script>window.href.location ='dashboard.php';</script>
    <?php
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InventorySystem</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/style.css">
</head>
<style>
    body { 
    font: 14px sans-serif; 
    text-align: center;
    background-color: #343A40;
}

a {
    list-style: none;
    text-decoration: none !important;
}
nav ul {
    margin: 0;
    padding: 0;
    height: 100%;
    width: 200px;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #262626;
}
nav ul li {
    list-style: none;
    text-decoration: none;
}
nav ul li a {
    display: block;
    text-decoration: none;
    font-size: 15px;
    color: #fff;
    padding-top: 40px;
}
.logo {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    margin: 25px auto;
}
.logo img {
    width: 100%;
}

.signout {
    padding-top: 200px;
}

/* Overlay for the opoup */
#overlay {
    display: none;
    position: fixed;
    top: 0;
    bottom: 0;
    background: #999;
    width: 100%;
    height: 100%;
    opacity: 0.9;
    z-index: 1;
    background-color: rgba(0, 0, 0, 0.55);
}

#popup {
    display: none;
    position: absolute;
    top: 45%;
    left: 50%;
    background: #fff;
    width: 500px;
    height: 500px;
    margin-left: -250px; /*Half the value of width to center div*/
    margin-top: -250px; /*Half the value of height to center div*/
    z-index: 1;
    border-radius: 5px;
}

#popupclose {
    float: right;
    padding: 10px;
    cursor: pointer;
}

@media screen and (max-height: 1080px){
    .signout {
        padding-top: 500px;
    }
}
@media screen and (max-height: 900px) {
    .signout {
        padding-top: 280px;
    }
}
@media screen and (max-width: 1920px) {
    .inv {
        margin-left: 15%;
    }
}
@media screen and (max-width: 1500px) {
    .inv {
        margin-left: 20%;
    }
}
</style>
<body>

    <!-- Sidebar -->
    <nav>
		<ul>
			<li class="logo"><img alt="" src="./img/default.png"></li>
            <h4 class="my-5 text-white">Hi, <?php echo htmlspecialchars($_SESSION["username"]); ?></h4>
			<li>
				<a href="profile.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    </svg>
                    Profile
                </a>
			</li>
			<li>
				<a href="dashboard.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-server" viewBox="0 0 16 16">
                        <path d="M1.333 2.667C1.333 1.194 4.318 0 8 0s6.667 1.194 6.667 2.667V4c0 1.473-2.985 2.667-6.667 2.667S1.333 5.473 1.333 4V2.667z"/>
                        <path d="M1.333 6.334v3C1.333 10.805 4.318 12 8 12s6.667-1.194 6.667-2.667V6.334a6.51 6.51 0 0 1-1.458.79C11.81 7.684 9.967 8 8 8c-1.966 0-3.809-.317-5.208-.876a6.508 6.508 0 0 1-1.458-.79z"/>
                        <path d="M14.667 11.668a6.51 6.51 0 0 1-1.458.789c-1.4.56-3.242.876-5.21.876-1.966 0-3.809-.316-5.208-.876a6.51 6.51 0 0 1-1.458-.79v1.666C1.333 14.806 4.318 16 8 16s6.667-1.194 6.667-2.667v-1.665z"/>
                    </svg>
                    Database
                </a>
			</li>

            <li class="signout">
                <a href="logout.php" class="btn btn-primary">Sign Out</a>
            </li>
		</ul>
	</nav>

    <!-- Inventory List! -->
    <br>
    <div class="container-fluid w-75 inv">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3>
                            Inventory List
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                            </svg>
                        </h3>
                        
                        <a class="btn btn-primary float-right" id="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                            </svg>
                            Add Items
                        </a>
                    </div>
                        <div class="card-body">
                            <table class="table table-striped table-dark table-hover">
                                <thead>
                                    <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Items</th>
                                    <th>Action</th>
                                    <th>Count</th>
                                    <th>Serial Number</th>
                                    <th>Description</th>
                                    <th>Added On</th>
                                    </tr>
                                </thead>

                                <!-- table body -->
                                <tbody>
                                <?php
                                    foreach($get_item as $item) {
                                ?>
                                    <tr id="test">
                                        <th><?= $item['id']; ?></th>
                                        <td><?= $item['item']; ?></td>
                                        <td>
                                            <a href="edit.php?id=<?= $item['id']; ?>&action=edit" class="btn btn-warning">
                                                <svg width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <a href="dashboard.php?id=<?= $item['id']; ?>&action=delete" class="btn btn-danger">
                                                <svg width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                                </svg>
                                                Delete
                                            </a>
                                        </td>
                                        <td><?= $item['count']; ?></td>
                                        <th><?= $item['s-n']; ?></th>
                                        <td><?= $item['desc']; ?></td>

                                        <td><h6><?= $item['added_at']; ?></h6></td>

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
    <div/>

    <!-- Create item page -->
    <div id="overlay"></div>
    <div id="popup">
        <div class="popupcontrols">
            <div class="popupcontent">
                <span id="popupclose">
                    <a  class="btn btn-danger float-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                        </svg>
                        Close
                    </a>
                </span>
                <!--  adding items -->
                <div>
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm">
                                <h3 class="text-center">Create a Request</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="dashboard.php" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" name="items" placeholder="Enter Item" required>
                                <br>
                                <input type="number" class="form-control" name="count" placeholder="Enter Count" required>
                                <br>
                                <input type="text" class="form-control" name="s_n" placeholder="Enter Serial Number" required>
                                <br>
                                <textarea style="resize: none;" class="form-control" name="desc" placeholder="Enter Item Description" cols="60" rows="3" required>&#10</textarea>
                                <br>
                                <br>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                </div>
                                <button type="submit" name="items-submit" class="btn btn-primary mt-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-plus-fill" viewBox="0 0 16 16">
                                        <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 1.59 2.498C8 14 8 13 8 12.5a4.5 4.5 0 0 1 5.026-4.47L15.964.686Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                                        <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5Z"/>
                                    </svg>
                                        Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // Create Item popup
        var closePopup = document.getElementById("popupclose");
        var overlay = document.getElementById("overlay");
        var popup = document.getElementById("popup");
        var button = document.getElementById("button");
        // Close Popup Event
        closePopup.onclick = function() {
            overlay.style.display = 'none';
            popup.style.display = 'none';
        };
        // Show Overlay and Popup
        button.onclick = function() {
            overlay.style.display = 'block';
            popup.style.display = 'block';
        }
    </script>

</body>
</html>
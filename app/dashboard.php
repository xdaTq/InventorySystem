<?php
require_once "./database/config.php";
require "./func/functions.php";
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

if (isset($_POST['items-submit'])) {
    createItem($_POST);
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
</head>
<style>
body { 
    background-color: #faf9f5;
}
h5 {
    text-align: center;
}
nav {
    background-color: #e9e9e9;
}
nav ul {
    margin: 0;
    padding: 0;
    height: 100%;
    width: 220px;
    position: fixed;
    top: 0;
    left: 0;
    color: black;
    background-color: #e9e9e9;
}
nav ul li a {
    display: block;
    color: black;
    padding-top: 20px;
}
.logo {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    overflow: hidden;
    margin: 25px auto;
}
.logo img {
    width: 100%;
}
/*
.signout {
    padding-top: 100px;
}
*/
.signoutbtn {
    width: 100%;
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
    height: 600px;
    margin-left: -250px; /*Half the value of width to center div*/
    margin-top: -250px; /*Half the value of height to center div*/
    z-index: 1;
    border-radius: 5px;
}

#popupclose {
    float: right;
    padding: 20px;
    cursor: pointer;
}
#subtn {
    float: right;
}
/*
@media screen and (max-height: 1080px){
    .signout {
        padding-top: 500px;
    }
}

@media screen and (max-height: 900px) {
    .signout {
        padding-top: 400px;
    }
}
*/

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

    <nav>
        <div class="container-fluid d-flex justify-content-center">
            <div class="row w-50">
                <div class="col">
                    <button class="w-100 btn-success">
                        <a href="./func/exportData.php" class="text-white">Export</a>
                    </button>
                </div>
                <div class="col">
                    <button class="w-100 btn-warning">
                        <a href="exportData.php" class="text-white">Config</a>
                    </button>
                </div>
                <div class="col">
                    <button class="w-100 btn-secondary">
                        <a href="exportData.php" class="text-white">More</a>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Sidebar -->
    <nav class="nav flex-column">
        <ul class="nav flex-column">
            <li class="logo"><img alt="" src="./img/default.png"></li>
            <h5 class="text-black">Hi, <?php echo htmlspecialchars($_SESSION["username"]); ?></h5>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="profile.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    </svg>
                    Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-hdd-stack" viewBox="0 0 16 16">
                        <path d="M14 10a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1h12zM2 9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2H2z"/>
                        <path d="M5 11.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-2 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM14 3a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12zM2 2a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z"/>
                        <path d="M5 4.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-2 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                    </svg>
                    Database
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="docs.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-code" viewBox="0 0 16 16">
                        <path d="M6.646 5.646a.5.5 0 1 1 .708.708L5.707 8l1.647 1.646a.5.5 0 0 1-.708.708l-2-2a.5.5 0 0 1 0-.708l2-2zm2.708 0a.5.5 0 1 0-.708.708L10.293 8 8.646 9.646a.5.5 0 0 0 .708.708l2-2a.5.5 0 0 0 0-.708l-2-2z"/>
                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                    </svg>
                    Docs
                </a>
            </li>

            <li class="signout nav-item">
                <button class="btn-danger signoutbtn">
                    <a href="admin/adminPanel.php" class="nav-link text-white">
                        Admin Login
                    </a>
                </button>
            </li>
            <li class="signout nav-item">
                <button class="btn-primary signoutbtn">
                    <a href="logout.php" class="nav-link text-white">
                        Sign Out
                    </a>
                </button>
            </li>
        </ul>
    </nav>

    <!-- Inventory List! -->
    <br>
    <div class="container-fluid w-75 fw-light inv">
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
                        
                        <button class="btn-light">
                            <a class="float-right" id="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                </svg>
                                Add Items
                            </a>
                        </button>
                    </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                    <th></th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Items</th>
                                    <th>Count</th>
                                    <th>Serial Number</th>
                                    <th>Description</th>
                                    <th>Added Date</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>

                                <!-- table body -->
                                <tbody>
                                <?php
                                    foreach($get_item as $item) {
                                ?>
                                    <tr>
                                        <th>
                                            <input type="checkbox">
                                        </th>
                                        <th><?= $item['id']; ?></th>
                                        <td><?= $item['item']; ?></td>
                                        <td><?= $item['count']; ?></td>
                                        <th><?= $item['s_n']; ?></th>
                                        <td><p class="text-break"><?= $item['desc']; ?></p></td>

                                        <td><h6><?= $item['added_at']; ?></h6></td>
                                        <td>
                                            <button class="btn-warning">
                                                <a href="edit.php?id=<?= $item['id']; ?>&action=edit">
                                                    <svg width="16" height="16" fill="currentColor" class="bi bi-pencil edit" viewBox="0 0 16 16">
                                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                    </svg>
                                                    Edit
                                                </a>
                                            </button>
                                            <button class="btn-danger">
                                                <a href="dashboard.php?id=<?= $item['id']; ?>&action=delete">
                                                    <svg width="16" height="16" fill="currentColor" class="bi bi-trash3-fill delete" viewBox="0 0 16 16">
                                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                                    </svg>
                                                    Delete
                                                </a>
                                            </button>
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
                                <textarea style="resize: none;" class="form-control" name="desc" placeholder="Enter Item Description" cols="60" rows="3"></textarea>
                                <br>
                                <br>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                </div>
                                <button id="subtn" type="submit" name="items-submit" class="btn btn-primary mt-5">
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
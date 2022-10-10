<?php
require_once "/Users/erwinkujawski/Desktop/Inv/database/config.php";
require '/Users/erwinkujawski/Desktop/Inv/func/functions.php';
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory System - Admin Control Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            padding-top: 200px;
        }
        
        .signoutbtn {
            width: 100%;
        }
        */
        /*
        @media screen and (min-height: 1080px){
            .signout {
                padding-top: 600px;
            }
        }

        @media screen and (max-height: 900px) {
            .signout {
                padding-top: 350px;
            }
        }
        */
    </style>
</head>
    <body>
        <!-- Sidebar -->
        <nav class="nav flex-column">
            <ul class="nav flex-column">
                <li class="logo"><img alt="" src="/Applications/MAMP/htdocs/Inv/img/default.png"></li>
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
                    <a class="nav-link" href="./4d5d7h8h-2019-2023-reset.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                            <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                            <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                        </svg>
                        Change Password
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./3d4d5h6h-2019-2023.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        Create Account
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
                    <button class="btn-primary signoutbtn">
                        <a href="/Inv/logout.php" class="nav-link text-white">
                            Sign Out
                        </a>
                    </button>
                </li>
            </ul>
        </nav>
    </body>
</html>
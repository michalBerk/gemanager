<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diamond Inventory Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #F5F5F5;
            font-family: tahoma;
        }

        #sideMenu {
            position: fixed;
            bottom: 0; /* Start from the bottom of the header menu */
            left: 0;
            height: 92%; /* Calculate the height excluding the header menu */
            width: 20%;
            background-color: #E4E4E4;
            box-shadow: 2px 0 4px rgba(0, 0, 0, 0.2); /* Add shadow effect on the right */
            display: flex;
            flex-direction: column; /* Stack items vertically */
            align-items: center; /* Center items horizontally */
        }

        #buttons {
            margin-top: 16%;
        }

        button {
            width: 100%;
            height: 3em;
            margin-bottom: 20px;
            border-radius: 30em;
            font-size: 15px;
            font-family: inherit;
            border: none;
            position: relative;
            overflow: hidden;
            z-index: 1;
            box-shadow: 6px 6px 12px #c5c5c5, -6px -6px 12px #E4E4E4;
        }

        button::before {
            content: '';
            width: 0;
            height: 3em;
            border-radius: 30em;
            position: absolute;
            top: 0;
            left: 0;
            background-image: linear-gradient(to right, #C5FF78 0%, #C5FF78 100%);
            transition: .5s ease;
            display: block;
            z-index: -1;
        }

        button:hover::before {
            width: 100%;
        }

        #headerMenu {
            width: 100%; /* Occupy the full width of the page */
            height: 2%;
            background-color: #F5F5F5;
            display: flex;
            align-items: center;
            justify-content: space-between; /* Align items to the left and right edges */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Add shadow effect at the bottom */
        }

        img {
            height: 50px;
            object-fit: contain;
        }

        #headerMenu span {
            font-weight: bold;
            margin-right: 50px;
        }

        #action_buttons {
            display: flex;
            margin-bottom: 20px;
            padding: 10px;
            justify-content: center;
            margin-top: 5%;
        }

        main button1 {
          padding: 30px 60px    ;
          font-size: 16px;
          text-transform: uppercase;
          letter-spacing: 2.5px;
          margin-right: 10px;
          font-weight: 500;
          color: #000000;
          background-color: #fff;
          border-radius: 45px;
          box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
          transition: all 0.3s ease 0s;
          cursor: pointer;
          text-align: center;
        }

        main button1:hover {
          background-color: #C5FF78;
          box-shadow: 0px 15px 20px rgba(197, 255, 120, 0.4);
          color: #000000;
          transform: translateY(-7px);
        }

        main button1:active {
          transform: translateY(-1px);
        }

        table {
            margin: auto;
            border-collapse: collapse;
            width: 95%;
            margin-top: 5%;
            text-align: center;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #E4E4E4;
        }

        th {
            background-color: #C5FF78;
            te
        }
        .container-fluid{
            display:flex;
            align-items: center;
        }
        .row{
            display: flex;
            width: 100%;
        }
        .nav{
            margin-top: 5%;
           
        }
        .col-lg-2 {
        height: 100vh;
        }

        @media screen and (max-width: 992px) {
        .col-lg-2 {
            height: 20%;
        }
        }
    

    </style>
</head>
<body>
    <header id ="headerMenu" class= "container-fluid">
        <img src="logo.png" alt="logo">
        <span>Alon Netzer</span>
    </header>
    <div class="container-fluid" >
        <div class="row" >
            <div class="col-lg-2" style="background-color: #E4E4E4;">
                <nav class="nav flex-column">
                    <button href="#">Home Page</button>
                    <button href="#">Inventory</button>
                    <button href="#">Sales</button>
                </nav>
            </div>
            <div class="col-lg-10">
                <main>
                    <div id="action_buttons">
                        <button1 href="#">Add Diamond</button1>
                        <button1 href="#">Edit Diamond</button1>
                        <button1 href="#">Sell Diamond</button1>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Diamond ID</th>
                                <th>Shape</th>
                                <th>Measurements</th>
                                <th>Weight</th>
                                <th>Color</th>
                                <th>Clarity</th>
                                <th>Cut</th>
                                <th>Polish</th>
                                <th>Symmetry</th>
                                <th>Date</th>
                                <th>Price/Carat</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include 'get_data.php'; ?>
                        </tbody>
                    </table>
                </main>
            </div>
        </div>
    </div>
</body>
</html>
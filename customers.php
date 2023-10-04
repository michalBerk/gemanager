<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header id ="headerMenu" class= "container-fluid">
        <img src="logo.png" alt="logo">
        <span>Alon Netzer</span>
    </header>
    <div class="container-fluid" >
        <div class="row" >
            <div class="col-lg-2">
                <nav class="nav flex-column">
                    <button class="navButton" onclick="window.location.href='index.php';">Home Page</button>
                    <button class="navButton" onclick="window.location.href='inventory.php';">Inventory</button>
                    <button class="navButton" onclick="window.location.href='sales.php';">Sales</button>
                    <button class="navButton" onclick="window.location.href='customers.php';">Customers</button>
                </nav>
            </div>
            <div class="col-lg-10">
                <main>
                    <h1>Customers</h1>
                    <button id="addButtonCustomer" class="cta"> <span> &#43; </span>Add Customer 
                    </button>
                    <div  style="display: inline-block;">
                        <input id="myInput" placeholder="Search by Name" type="search" class="input" oninput="searchFunction()">
                      </div>
                    <div class="popupContainer" id="customerContainer">
                        <div class="popupContent" style="text-align: center;">
                        <h2 style="margin-bottom: 3%;">Add A New Customer</h2>
                            <form class= "container" style="display:flex;justify-content: space-evenly;align-items:center;">
                                <div class="leftSide">
                                    <div class="coolinput">
                                        <label for="input" class="text">Customer Id:</label>
                                        <input type="text" id="customerId" class="input">
                                    </div>
                                    <div class="coolinput">
                                        <label for="input" class="text">Full Name:</label>
                                        <input type="text" id="fullName" class="input">
                                    </div>
                                    <div class="coolinput">
                                        <label for="input" class="text">Phone Number:</label>
                                        <input type="text" id="phoneNumber" class="input">
                                    </div>
                                </div>
                                <div class="rightSide">
                                    <div class="coolinput">
                                        <label for="Email" class="text">Email:</label>
                                        <input type="email" id="email" class="input">
                                    </div>
                                    <div class="coolinput">
                                        <label for="input" class="text">Company Name:</label>
                                        <input type="text" id="companyName" class="input">
                                    </div>
                                    <div class="coolinput">
                                        <label for="input" class="text">Country:</label>
                                        <input type="text" id="country" class="input">
                                    </div>
                                </div>
                            </form>
                            <div class ="buttonSections">
                                <button class="pButton" id="submitCust">Submit</button>
                                <button class="pButton" id="cancelCust">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <table id="customerTable">
                        <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>Full Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Company Name</th>
                                <th>Country</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include 'get_customers.php'; ?>
                        </tbody>
                    </table>
                </main>
            </div>   
</body>
<script type="text/javascript" src="/JavaScripts/customer_script.js"></script>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
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
                    <h1> Sales </h1>
                    <button id="sellPopupButton"  class="cta"> <span> &#43; </span>New Sale 
                    </button>
                    <div class="popupContainer" id="SellContainer">
                        <div class="popupContent" style="text-align: center;">
                            <div>
                                <label style="font-size:x-large;" for="certificateNumber">Enter a certificat number:</label>
                                <input type="text" required="" autocomplete="off" placeholder="certificat number" id="certificateNumberSell">
                            <button id ='getButtonSell' class="cta">
                                <span>Get</span>
                                <svg viewBox="0 0 13 10" height="10px" width="15px">
                                  <path d="M1,5 L11,5"></path>
                                  <polyline points="8 1 12 5 8 9"></polyline>
                                </svg>
                            </button>
                            </div>
                            <div style="padding-top: 5%;">
                                <label style="font-size:x-large;" for="customerId">Select a Customer:</label>
                                <select name="customerId" id="customerId">
                                    <option value="none">None</option>
                                    <?php include('customers_dropdown.php'); ?>
                                </select>
                            </div>
                            <div class ="priceSection" >
                                <div>
                                    <label for="input" class="number">Price:</label>
                                    <input type="number" id="price" class="input" disabled>
                                </div>
                                <div>
                                    <label for="input" class="number">VAT:</label>
                                    <input type="number" id="VAT" class="input" placeholder="17%" disabled>
                                </div>
                                <div>
                                    <label for="input" class="number">Final price:</label>
                                    <input type="number" id="FinalPrice" class="input" disabled>
                                </div>

                            </div>
                            <div class ="buttonSections" style="padding: 5%">
                                <button id ="submitSell" class="pButton" style= "display: none;">Submit Sell</button>
                                <button id ="cancelSell" class="pButton">Cancel</button>
                            </div>
                        </div>
                    </div>

                    <table id="salesTable">
                        <thead>
                            <tr>
                                <th>Sale ID</th>
                                <th>Customer</th>
                                <th>Diamond ID</th>
                                <th>Total price</th>
                                <th>Sale Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include 'get_sales.php'; ?>
                        </tbody>
                    </table>
                </main>
             </div>   
</body>
<script type="text/javascript" src="/JavaScripts/sale_script.js"></script>
</html>
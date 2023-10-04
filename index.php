<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diamond Inventory Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!--link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap"-->
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
    </style>
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
                    <h1>Home Page</h1>
                    <div id="action_buttons">
                        <button1 id="AddPopupButton">Add Diamond</button1>
                        <!--This is the Pop up window for adding diamond-->
                        <div class="popupContainer" id="AddContainer">
                            <div class="popupContent"> 
                                <div style="text-align: center;">
                                    <h2>Enter a certificate number</h2>
                                    <div style="margin: auto; display: flex; justify-content: center; align-items: center;">
                                        <div class="inputGroup" style="display: flex; align-items: center;">
                                            <input type="text" required="" autocomplete="off" placeholder="certificate number" id="certificateNumber">
                                            <!--A button that sends the ID of the diamond to the API-->
                                            <button id ='getButton' class="cta">Get</button>
                                        </div>
                                    </div>
                                </div>
                                <table id="diamondTable" style="display: none;">
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Fetched data will be inserted here -->
                                    </tbody>
                                </table>
                                <div class ="buttonSections">
                                    <button class="pButton" id="submitButton" style= "display: none;">Submit</button>
                                    <button class="pButton" id="cancelAdd">Cancel</button>
                                </div>
                            </div>
                        </div>
                        <button1 id="editpopupButton">Edit Diamond</button1>
                        <!--This is the Pop up window for Edit Diamond-->
                        <div class="popupContainer" id="EditContainer">
                            <div class="popupContent">
                                <div style="text-align: center;">
                                    <label style="font-size:x-large;" for="certificateNumber">Enter a certificat number:</label>
                                    <input type="text" required="" autocomplete="off" placeholder="certificate number" id="certificateNumberEdit">
                                    <button id ="getButtonEdit" class="cta">
                                        <span>Get</span>
                                        <svg viewBox="0 0 13 10" height="10px" width="15px">
                                          <path d="M1,5 L11,5"></path>
                                          <polyline points="8 1 12 5 8 9"></polyline>
                                        </svg>
                                    </button>
                                </div>
                                <div id ="DiamondForm"  >
                                    <h2 style="text-align: center;">Diamond details</h2> 
                                <form class= "container" style="display:flex;justify-content: space-evenly;align-items:center;">
                                    <div class="leftSide">
                                        <div class="coolinput">
                                            <label for="input" class="text">Certification Number:</label>
                                            <input type="text" id="cid" class="input">
                                        </div>
                                        <div class="coolinput">
                                            <label for="input" class="text">Shape:</label>
                                            <input type="text" id="shape" class="input">
                                        </div>
                                        <div class="coolinput">
                                            <label for="input" class="text">Measurements:</label>
                                            <input type="text" id="Measurements" class="input">
                                        </div>
                                        <div class="coolinput">
                                            <label for="input" class="text">Weight:</label>
                                            <input type="text" id="Weight" class="input">
                                        </div>
                                        <div class="coolinput">
                                            <label for="input" class="text">Color:</label>
                                            <input type="text" id="Color" class="input">
                                        </div>

                                    </div> 
                                    <div class="centner">
                                        <div class="coolinput">
                                            <label for="input" class="text">Clarity:</label>
                                            <input type="text" id="Clarity" class="input">
                                        </div>
                                        <div class="coolinput">
                                            <label for="input" class="text">Cut:</label>
                                            <input type="text" id="Cut" class="input">
                                        </div>
                                        <div class="coolinput">
                                            <label for="input" class="text">Polish:</label>
                                            <input type="text" id="Polish" class="input">
                                        </div>
                                        <div class="coolinput">
                                            <label for="input" class="text">Symmetry:</label>
                                            <input type="text" id="Symmetry" class="input">
                                        </div>
                                        <div class="coolinput">
                                            <label for="input" class="text">Price/Carat:</label>
                                            <input type="number" step="0.1" min=0 id="Price" class="input">
                                        </div>

                                    </div>
                                    <div class="rightSide">
                                        <div class="coolinput">
                                            <label for="input" class="date"> Date:</label>
                                            <input type="date" id="Date" class="input">
                                        </div>
                                        <div class="coolinput">
                                            <label for="input" class="text">Total price:</label>
                                            <input type="number" step="0.1" id="TotalPrice"  min=0 class="input" disabled>
                                        </div>
                                        <div class="coolinput">
                                            <label for="status">Status</label>
                                            <select name="status" id="status">
                                                <option value="Available">Available</option>
                                                <option value="Consignment">Consignment</option>
                                                <option value="Sold">Sold</option>
                                              </select>
                                        </div>
                                        <div class="coolinput">
                                            <label for="Consignment Customer">Consignment Customer:</label>
                                            <select name="Consignment Customer" id="consignment_customer" >
                                                <option value="none">None</option>
                                                <?php include('customers_dropdown.php'); ?>
                                            </select>
                                        </div>
                                        <div class="coolinput">
                                            <label for="Buyer Customer">Buyer Customer:</label>
                                            <select name="Buyer Customer" id="buyer_customer" >
                                                <option value="none">None</option>
                                                <?php include('customers_dropdown.php'); ?>
                                            </select>
                                        </div>
                                    </div>
                            </form>

                                </div>
                                <div class ="buttonSections" style="padding: 4%" >
                                    <button id ="submitEdit" class="pButton" style= "display: none;">Submit</button>
                                    <button id ="CancelEdit" class="pButton">Cancel</button>
                                </div>
                                
                        </div>
                    </div>
                        <button1 id="sellPopupButton" > Sell Diamond</button1>
                        <div class="popupContainer" id="SellContainer">
                            <div class="popupContent" style="text-align: center;">
                                <div>
                                    <label style="font-size:x-large;" for="certificateNumber">Enter a certificat number:</label>
                                    <input type="text" required="" autocomplete="off" placeholder="certificate number" id="certificateNumberSell">
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
                    </div>

                    <table id="diamondTable">
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
                            <?php include 'get_diamonds.php'; ?>
                        </tbody>
                    </table>
                </main>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="/JavaScripts/myscripts.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</html>
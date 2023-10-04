<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                    <h1>Inventory</h1> 
                    <button id="AddPopupButton" class="cta"> <span> &#43; </span>Add Diamond 
                    </button>
                    <div  style="display: inline-block;">
                        <legend style="font-size:16px; padding-left: 9%;">Filter by status</legend>
                        <select id="statusDropdown" oninput="filterTable()"  style="border-radius: 50px;margin: auto; padding: 12px 18px; border-style: solid; background-color:inherit">
                            <option>Any</option>
                            <option>Available</option>
                            <option>Sold</option>
                            <option>Consignment</option>
                        </select>
                    </div>
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
                    <div class="popupContainer" id="EditContainer">
                            <div class="popupContent">
                                <div style="text-align: center;">
                                    <label style="font-size:x-large;" for="certificateNumber">Enter a certificat number:</label>
                                    <input type="text" required="" autocomplete="off" placeholder="certificat number" id="certificateNumberEdit">
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
                                    <button id="submitEdit" class="pButton" style= "display: none;">Submit</button>
                                    <button id="CancelEdit" class="pButton">Cancel</button>
                                </div>
                                
                        </div>
                    </div>
                    <table id="diamondInvetoryTable">
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include 'get_diamonds_inventory.php'; ?>
                        </tbody>
                    </table>
                    <!-- Confirmation Modal -->
                    <div id="deleteConfirmationModal" class="modal">
                        <div class="modal-content" style='text-align: center; background-color: #f0f7d7;'>
                            <h3>Are you sure you want to delete this diamond?</h3>
                            <div style="display: inline-block;">
                                <button id="confirmDeleteButton" class="cta">Yes</button>
                                <button id="cancelDeleteButton" class="cta">No</button>
                            </div>
                        </div>
                    </div>
                </main>
             </div>   
</body>
<script type="text/javascript" src="/JavaScripts/inventory_script.js"></script>
</html>
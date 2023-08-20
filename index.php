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
                    <button href="#">Home Page</button>
                    <button href="#">Inventory</button>
                    <button href="#">Sales</button>
                    <button href="#">Customers</button>
                    <button href="#">Settings</button>
                </nav>
            </div>
            <div class="col-lg-10">
                <main>
                    <!--h1>Home Dashboard</h1-->
                    <div id="action_buttons">
                        <button1 id="AddPopupButton">Add Diamond</button1>
                        <!--This is the Pop up window for adding diamond-->
                        <div class="popupContainer" id="AddContainer">
                            <div class="popupContent"> 
                                <div style="text-align: center;">
                                    <h2>Enter a certificat number</h2>
                                    <div style="margin: auto; display: flex; justify-content: center; align-items: center;">
                                        <div class="inputGroup" style="display: flex; align-items: center;">
                                            <input type="text" required="" autocomplete="off" placeholder="certificat number" id="certificateNumber">
                                            <!--A button that sends the ID of the diamond to the API-->
                                            <button id ='getButton' class="cta">
                                                <span>Get</span>
                                                <svg viewBox="0 0 13 10" height="10px" width="15px">
                                                  <path d="M1,5 L11,5"></path>
                                                  <polyline points="8 1 12 5 8 9"></polyline>
                                                </svg>
                                            </button>
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
                                <div style="text-align: center; padding: 10%;display: flex; justify-content:space-between;">
                                    <div id="submitButton"></div>
                                    <button style="width: 30%;"class="pButton" id="closeButton">Cancel</button>
                                    <div id="successMessage" style="display: none; text-align: center; color: green;">
                                        Insertion has been done successfully.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button1 id="editpopupButton">Edit Diamond</button1>
                        <!--This is the Pop up window for Edit Diamond-->
                        <div class="popupContainer" id="EditContainer">
                            <div class="popupContent">
                                <h2 style="text-align: center;">Diamond details</h2> 
                                <form class= "container" style="display:flex;gap:calc(20px + 1.5vw);margin-left: 3%; margin-right: 3%;">
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
                                        <div class="coolinput">
                                            <label for="input" class="text">Clarity:</label>
                                            <input type="text" id="Clarity" class="input">
                                        </div>
                                        <div class="coolinput">
                                            <label for="input" class="text">Cut:</label>
                                            <input type="text" id="Cut" class="input">
                                        </div>
                                </div>
                                    <div class="rightSide">
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
                                        <div class="coolinput">
                                            <label for="input" class="text">Total price:</label>
                                            <input type="number" step="0.1" id="TotalPrice"  min=0 class="input">
                                        </div>
                                        <div class="coolinput">
                                            <label for="input" class="date"> Date:</label>
                                            <input type="date" id="Date" class="input">
                                        </div>
                                        <div class="coolinput">
                                            <label for="status">Status</label>
                                            <select name="status" id="status">
                                                <option value="Available">Available</option>
                                                <option value="Consignment">Consignment</option>
                                                <option value="shipped">shipped</option>
                                                <option value="Sold">Sold</option>
                                              </select>
                                            <!--label for="input" class="text">status:</label>
                                            <input type="text" id="status" class="input"-->
                                        </div>
                                </div>
                                <div style="border-style: solid; margin-left: auto;width: 40%; flex-direction: column;">
                                    <img id="diamondPhoto" alt="Diamond Photo" style="max-width: 100%;">
                                </div>
                                <div style="border-style: solid; margin-left: auto;width: 40%; ">
                                    <video id="diamondVideo" style="max-width: 100%;"> 
                                </div>
                            </form>
                        </div>
                    </div>
                        <button1 href="#">Sell Diamond</button1>
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
                                <th>Price/ Carat</th>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const popupAddButton = document.getElementById('AddPopupButton');
    const popupEditButton = document.getElementById('editpopupButton');
    const popupEditContainer = document.getElementById('EditContainer');
    const popupAddContainer = document.getElementById('AddContainer');
    const submitButton = document.getElementById('submitButton');
    const closeButton = document.getElementById('closeButton');

    popupAddButton.addEventListener('click', () => {
        popupAddContainer.style.display = 'block';
    });
    popupEditButton.addEventListener('click', () => {
        popupEditContainer.style.display = 'block';
        const diamondId = '1206489210';
        
        // Make an AJAX call to retrieve diamond data
        fetch(`get_diamond_edit_pp.php?diamond_id=${diamondId}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                document.getElementById("cid").value = data.diamond_id;
                document.getElementById("shape").value = data.shape_cutting_style;
                document.getElementById("Measurements").value = data.measurements;
                document.getElementById("Weight").value = data.weight;
                document.getElementById("Color").value = data.color;
                document.getElementById("Clarity").value = data.clarity;
                document.getElementById("Cut").value = data.cut;
                document.getElementById("Polish").value = data.polish;
                document.getElementById("Symmetry").value = data.symmetry;
                document.getElementById("Price").value = data.price_per_carat;
                document.getElementById("TotalPrice").value = data.total_price;
                document.getElementById("Date").value = data.inserted_date;
                document.getElementById("status").value = data.status;
                document.getElementById("diamondPhoto").src = data.polished_image || data.image;
                document.getElementById("diamondVideo").src = data.polished_video;
            })
            .catch(error => console.error("Error fetching data:", error));
    });
    closeButton.addEventListener('click', () => {
        popupAddContainer.style.display = 'none';
        hideSubmitButton(); // Call the function to hide the "Submit" button
        getButton.disabled = false;
    });

    // Function to create and insert the "Submit" button
    function showSubmitButton() {
        const newButton = document.createElement('button');
        newButton.textContent = 'Submit';
        newButton.classList.add('pButton'); // Add the custom class
        submitButton.append(newButton);
    // Apply flex layout to the submitButton container
        submitButton.style.width = '30%';
    };
        /*
// Function to hide the "Submit" button
    function hideSubmitButton() {
        const existingButton = submitButton.querySelector('.pButton');
        if (existingButton) {
            existingButton.remove();
        }
    }
    */
    $(document).ready(function() {
    
        const $getButton = $('#getButton');
        const $diamondTable = $('#diamondTable');
        const $certificateNumber = $('#certificateNumber');
        

        // Add event listener to the "Get" button
        $getButton.click(function() {
            const certNumber = $certificateNumber.val();
            const currentDate = new Date().toLocaleDateString();
            
            $.ajax({
                type: 'POST',
                url: 'get_data.php',
                data: { report_number: certNumber },
                dataType: 'json',
                success: function(data) {
                    if (!data.error) {
                        // Clear previous data and populate the table
                        $diamondTable.find('tbody').empty();
                        const newRow = `
                            <tr>
                                <td>${certNumber}</td>
                                <td>${data.shape_and_cutting_style || data.shape}</td>
                                <td>${data.measurements}</td>
                                <td>${data.carat_weight || data.weight}</td>
                                <td>${data.color_grade || data.color}</td>
                                <td>${data.clarity_grade || ''}</td>
                                <td>${data.cut_grade || data.cutting_style}</td>
                                <td>${data.polish || ''}</td>
                                <td>${data.symmetry || ''}</td>
                                <td>${currentDate}</td>
                            </tr>`;
                        $diamondTable.find('tbody').append(newRow);
                        $diamondTable.show();
                    } else {
                        alert(data.error); // Display an error message if fetching fails
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while fetching data.');
                    console.error(error);
                }
            });
            showSubmitButton()
            getButton.disabled = true; // Disable the main button

        });
        submitButton.addEventListener('click', () => {
            const certNumber = $certificateNumber.val();
            const $successMessage = $('#successMessage')
    
            // Make an AJAX call to trigger the api_handler.php file
            $.ajax({
                type: 'POST',
                url: 'api_handler.php',
                data: { report_number: certNumber },
                success: function(response) {
                    // Handle the response from api_handler.php if needed
                    console.log(response);
                    if (response === 'success') {
                        $successMessage.show();
                    } else {
                        $successMessage.hide();
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while submitting data.');
                    console.error(error);
                }
            });
        });
    });
    
    
</script>
</html>

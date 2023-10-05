// Get the delete button elements with a class (adjust this selector accordingly)
const deleteButtons = document.querySelectorAll('.delete-button');

// Get the confirmation modal and its buttons
const deleteConfirmationModal = document.getElementById('deleteConfirmationModal');
const confirmDeleteButton = document.getElementById('confirmDeleteButton');
const cancelDeleteButton = document.getElementById('cancelDeleteButton');
const popupEditContainer = document.getElementById('EditContainer');
const submitEdit = document.getElementById('submitEdit');
const cancelEdit = document.getElementById('CancelEdit');
const popupAddButton = document.getElementById('AddPopupButton');
const popupAddContainer = document.getElementById('AddContainer');

// Variable to store the ID of the diamond to be deleted
let diamondIdToDelete;

// Define the openEditPopup function
function openEditPopup(diamondId) {
    popupEditContainer.style.display = "block";
    // Set the diamond ID in the edit popup input field
    document.getElementById('certificateNumberEdit').value = diamondId;

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
            
            // Calculate total price based on weight and price per carat
            const weightValue = parseFloat(data.weight); // Extract the numeric value
            const pricePerCaratValue = parseFloat(data.price_per_carat);
            const totalPrice = isNaN(weightValue) || isNaN(pricePerCaratValue) ? 0 : (weightValue * pricePerCaratValue);
            document.getElementById("TotalPrice").value = totalPrice.toFixed(2);
            
            document.getElementById("Date").value = data.inserted_date;
            document.getElementById("status").value = data.status;
            document.getElementById("consignment_customer").value = data.cos_cust;
            document.getElementById("buyer_customer").value = data.sold_cust;
        })
        .catch(error => console.error("Error fetching data:", error));
    
    
    // Add an event listener for the "Price Per Carat" input field
    const pricePerCaratInput = document.getElementById("Price");
    pricePerCaratInput.addEventListener("input", updateTotalPrice);

    function updateTotalPrice() {
        const weightValue = parseFloat(document.getElementById("Weight").value);
        const pricePerCaratValue = parseFloat(pricePerCaratInput.value);
        const totalPrice = isNaN(weightValue) || isNaN(pricePerCaratValue) ? 0 : (weightValue * pricePerCaratValue);
        document.getElementById("TotalPrice").value = totalPrice.toFixed(2);
    }
    
    // Display the edit popup
    submitEdit.style.display = "block";
    
    // Add an event listener for the "Cancel" button in the edit popup
    cancelEdit.addEventListener('click', () => {
        // Hide the edit popup and reset input fields
        popupEditContainer.style.display = "none";
        submitEdit.style.display = "none";
        resetEditPopupFields(); // Call a function to reset the input fields
    });
}

// Add an event listener for the "Edit" buttons
const editButtons = document.querySelectorAll('.edit-button');

editButtons.forEach(button => {
    button.addEventListener('click', () => {
        const diamondId = button.getAttribute('data-diamond-id');
        openEditPopup(diamondId);
    });
});

// Function to open the confirmation modal
function openConfirmationModal(diamondId) {
    diamondIdToDelete = diamondId;
    deleteConfirmationModal.style.display = 'block';
}

// Function to close the confirmation modal
function closeConfirmationModal() {
    deleteConfirmationModal.style.display = 'none';
}

// Add click event listeners to all delete buttons
deleteButtons.forEach(button => {
    button.addEventListener('click', () => {
        const diamondId = button.getAttribute('data-diamond-id');
        openConfirmationModal(diamondId);
    });
});

// Add click event listeners to the modal buttons
confirmDeleteButton.addEventListener('click', () => {
    // Make an AJAX call to trigger the PHP file to delete the diamond
    fetch(`delete_diamond.php?diamond_id=${diamondIdToDelete}`)
        .then(response => response.json())
        .then(data => {
            // Handle the response from the PHP file (e.g., display a success message)
            console.log(data);
            // You can add further handling or notifications here

            // Close the confirmation modal
            closeConfirmationModal();

            // Reload the inventory page or perform any other desired actions
            location.reload();
        })
        .catch(error => console.error("Error deleting diamond:", error));
});

cancelDeleteButton.addEventListener('click', () => {
    // Close the confirmation modal if the user clicks "No"
    closeConfirmationModal();
});

// Add an event listener for the "Price Per Carat" input field
const pricePerCaratInput = document.getElementById("Price");
pricePerCaratInput.addEventListener("input", updateTotalPrice);

function updateTotalPrice() {
    const weightValue = parseFloat(document.getElementById("Weight").value);
    const pricePerCaratValue = parseFloat(pricePerCaratInput.value);
    const totalPrice = isNaN(weightValue) || isNaN(pricePerCaratValue) ? 0 : (weightValue * pricePerCaratValue);
    document.getElementById("TotalPrice").value = totalPrice.toFixed(2);
}


submitEdit.addEventListener("click", function () {
    // Get the values you want to update
    const diamondId = document.getElementById("cid").value;
    const shape = document.getElementById("shape").value;
    const measurements = document.getElementById("Measurements").value;
    const weight = document.getElementById("Weight").value;
    const color = document.getElementById("Color").value;
    const clarity = document.getElementById("Clarity").value;
    const cut = document.getElementById("Cut").value;
    const polish = document.getElementById("Polish").value;
    const symmetry = document.getElementById("Symmetry").value;
    const pricePerCarat = document.getElementById("Price").value;
    const totalPrice = document.getElementById("TotalPrice").value;
    const date = document.getElementById("Date").value;
    const status = document.getElementById("status").value;
    const consignmentCustomer = document.getElementById("consignment_customer").value;
    const buyerCustomer = document.getElementById("buyer_customer").value;

    // Prepare the data to send to the PHP file
    const formData = new FormData();
    formData.append("diamondId", diamondId);
    formData.append("shape", shape);
    formData.append("measurements", measurements);
    formData.append("weight", weight);
    formData.append("color", color);
    formData.append("clarity", clarity);
    formData.append("cut", cut);
    formData.append("polish", polish);
    formData.append("symmetry", symmetry);
    formData.append("pricePerCarat", pricePerCarat);
    formData.append("totalPrice", totalPrice);
    formData.append("date", date);
    formData.append("status", status);
    formData.append("consignmentCustomer", consignmentCustomer);
    formData.append("buyerCustomer", buyerCustomer);

    // Make an AJAX request to update the diamond data
    fetch("update_diamond.php", {
        method: "POST",
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            // Handle the response from the PHP file
            console.log(data);
            // You can add further handling or notifications here
        })
        .catch(error => console.error("Error updating data:", error));
    
    popupEditContainer.style.display = "none";
    location.reload();
    
});

cancelEdit.addEventListener('click', () => {
    // Hide the edit popup and reset input fields
    popupEditContainer.style.display = "none";
    submitEdit.style.display = "none";
    resetEditPopupFields(); // Call a function to reset the input fields
});

// Function that enables to filter by status from the dropdown
function filterTable() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("statusDropdown").value;
  filter = input.toUpperCase();
  console.log(filter)
  table = document.getElementById("diamondInvetoryTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[12];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1 || filter==='ANY' ){
        tr[i].style.display = "";
      }
      else {
        tr[i].style.display = "none";
      }
    }       
  }
}

// Opens add new diamond popup
popupAddButton.addEventListener('click', () => {
    popupAddContainer.style.display = 'block';
    
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
                            <td>${data.shape_and_cutting_style}</td>
                            <td>${data.measurements}</td>
                            <td>${data.carat_weight}</td>
                            <td>${data.color_grade}</td>
                            <td>${data.clarity_grade}</td>
                            <td>${data.cut_grade}</td>
                            <td>${data.polish}</td>
                            <td>${data.symmetry}</td>
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
        submitButton.style.display = "block";
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
        
        popupAddContainer.style.display = "none";
        sleep(1500);
        location.reload()
    });
    
    cancelAdd.addEventListener('click', () => {
        popupAddContainer.style.display = 'none';
        document.getElementById("certificateNumber").value = '';
        hideSubmitButton(); // Call the function to hide the "Submit" button
        getButton.disabled = false;
        document.getElementById("diamondTable").style.display = 'none';
    });
    
});

function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

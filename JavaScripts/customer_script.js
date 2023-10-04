
const addButtonCustomer = document.getElementById('addButtonCustomer');
const customerContainer = document.getElementById('customerContainer');
const submitcust = document.getElementById('submitCust');
const cancelcust = document.getElementById('cancelCust');

// fuction which triggers customer insertation into the database after the user press submit
submitCust.addEventListener('click', function () {
    // Get user input values
    const customerId = document.getElementById('customerId').value;
    const fullName = document.getElementById('fullName').value;
    const phoneNumber = document.getElementById('phoneNumber').value;
    const email = document.getElementById('email').value;
    const companyName = document.getElementById('companyName').value;
    const country = document.getElementById('country').value;

    // Create a new XMLHttpRequest object
    const xhr = new XMLHttpRequest();

    // Define the PHP script URL
    const phpScriptURL = 'insert_new_customer.php';

    // Create a FormData object to send data to the server
    const formData = new FormData();
    formData.append('customer_id', customerId);
    formData.append('full_name', fullName);
    formData.append('phone_number', phoneNumber);
    formData.append('email', email);
    formData.append('company_name', companyName);
    formData.append('country', country);

    // Configure the request
    xhr.open('POST', phpScriptURL, true);

    // Set up a callback function to handle the response
    xhr.onload = function () {
        if (xhr.status === 200) {
            // The request was successful, and you can handle the response here
            alert(xhr.responseText); // Show the response in an alert (you can customize this)
            
            // Close the popup
            customerContainer.style.display = 'none';
            location.reload();
            
            // Clear input fields if needed
            document.getElementById('customerId').value = '';
            document.getElementById('fullName').value = '';
            document.getElementById('phoneNumber').value = '';
            document.getElementById('email').value = '';
            document.getElementById('companyName').value = '';
            document.getElementById('country').value = '';
        } else {
            // Handle the request error
            alert('Error: ' + xhr.status);
        }
    };

    // Send the request with the form data
    xhr.send(formData);
});

// Opens customer add popup
addButtonCustomer.addEventListener('click', () => {
    customerContainer.style.display = 'block';
});

// Closes customer add popup and clears values
cancelcust.addEventListener('click', () => {
    customerContainer.style.display = 'none';
    // Clear input fields if needed
    document.getElementById('customerId').value = '';
    document.getElementById('fullName').value = '';
    document.getElementById('phoneNumber').value = '';
    document.getElementById('email').value = '';
    document.getElementById('companyName').value = '';
    document.getElementById('country').value = '';
});

// function that enables the search text box for quick customer lookup
function searchFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("customerTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1]; // Index 1 for the "Full Name" column
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }       
    }
}

// Triggers customer table sorting by Full name column
document.addEventListener("DOMContentLoaded", function () {
    // Sort the table by "Full Name" column by default
    sortTable(2);
});

// Sorting function for customers table
function sortTable(columnIndex) {
    const table = document.getElementById("customerTable");
    const tbody = table.getElementsByTagName("tbody")[0];
    const rows = Array.from(tbody.getElementsByTagName("tr"));

    rows.sort((a, b) => {
        const aValue = a.getElementsByTagName("td")[columnIndex - 1].textContent;
        const bValue = b.getElementsByTagName("td")[columnIndex - 1].textContent;
        return aValue.localeCompare(bValue, undefined, { sensitivity: "base" });
    });

    // Remove existing rows from the table
    while (tbody.firstChild) {
        tbody.removeChild(tbody.firstChild);
    }

    // Append sorted rows to the table
    rows.forEach((row) => {
        tbody.appendChild(row);
    });
}





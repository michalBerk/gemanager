const popupSellButton = document.getElementById('sellPopupButton');
const popupSellContainer = document.getElementById('SellContainer');
const submitSell = document.getElementById('submitSell');
const cancelSell = document.getElementById('cancelSell');

// opens sell popup
popupSellButton.addEventListener('click', () => {
    popupSellContainer.style.display = 'block';
    
    // Assuming you have a getButton event listener like this
    const getButtonSell = document.getElementById('getButtonSell');
    const certificateNumberInput = document.getElementById("certificateNumberSell");
    const customerIdSelect = document.getElementById("customerId");
    const priceInput = document.getElementById("price");
    const VATInput = document.getElementById("VAT");
    const finalPriceInput = document.getElementById("FinalPrice");
    
    // Function to toggle the visibility of the submit button
    function toggleSubmitButtonVisibility() {
        const certificateNumber = certificateNumberInput.value;
        const selectedCustomerId = customerIdSelect.value;
    
        if (certificateNumber !== "none" && selectedCustomerId !== "none") {
            submitSell.style.display = "block";
        } else {
            submitSell.style.display = "none";
        }
    }
    
    customerIdSelect.addEventListener("change", toggleSubmitButtonVisibility);
    
    getButtonSell.addEventListener("click", function () {
        const certificateNumber = certificateNumberInput.value;
        // Make an AJAX call to retrieve diamond data
        fetch(`get_diamond_edit_pp.php?diamond_id=${certificateNumber}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                // Update the price field with the total_price from the data
                priceInput.value = data.total_price;
    
                // Calculate VAT and final price
                const totalPrice = parseFloat(data.total_price);
                if (!isNaN(totalPrice)) {
                    const vatRate = 1.17; // 17%
                    const finalPrice = totalPrice * vatRate;

                    finalPriceInput.value = finalPrice.toFixed(2);
                }
            })
            .catch(error => console.error("Error fetching data:", error));
        toggleSubmitButtonVisibility(); // Update button visibility
    });
    
    
    submitSell.addEventListener("click", function () {
        // Get the values you want to insert into the sales database
        const certificateNumber = certificateNumberInput.value;
        const customerId = customerIdSelect.value;
        const finalPrice = parseFloat(finalPriceInput.value);
    
        // Create an object to hold the data
        const saleData = {
            certificateNumber,
            customerId,
            finalPrice
        };
    
        // Make an AJAX request to insert the data into the sales database
        fetch("insert_new_sale.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(saleData)
        })
            .then(response => response.json())
            .then(data => {
                // Handle the response from the PHP file (e.g., display a success message)
                console.log(data);
                // You can add further handling or notifications here
            })
            .catch(error => console.error("Error inserting data:", error));
        
        popupSellContainer.style.display = "none";
        location.reload();
    });
    
});

// close sell popup and reset values
cancelSell.addEventListener('click', () => {
    const certificateNumberInput = document.getElementById("certificateNumberSell");
    const customerIdSelect = document.getElementById("customerId");
    const priceInput = document.getElementById("price");
    const finalPriceInput = document.getElementById("FinalPrice");
    
    popupSellContainer.style.display = 'none';
    submitSell.style.display = 'none';
    certificateNumberInput.value = '';
    priceInput.value = '';
    finalPriceInput.value = '';
    customerIdSelect.value = 'none'; // Reset the customer dropdown

});
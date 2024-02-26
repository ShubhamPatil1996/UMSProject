function getStates(country_code) {
    // Initialize XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure GET request to fetch state data from the PHP script
    xhr.open("GET", "get_states.php?country_code=" + country_code, true);

    // Define callback function for handling state data once received
    xhr.onreadystatechange = function() {
        // Check if the request is complete and successful
        if (xhr.readyState === 4 && xhr.status === 200) {

            // Parse the JSON response to obtain state data
            var states = JSON.parse(xhr.responseText);

            // Access the state dropdown element
            var stateDropdown = document.getElementById("state");

            // Clear and set the default option for the state dropdown
            stateDropdown.innerHTML = "<option value=''>Select State</option>";
            
            // Enable the state dropdown for user interaction
            stateDropdown.disabled = false;

            // Loop through the state data to populate the state dropdown
            states.forEach(state => {
                var option = document.createElement("option");
                option.value = state.state_id;
                option.text = state.state_name;
                stateDropdown.appendChild(option);
            });
        }
    };

    // Send the GET request to fetch state data
    xhr.send();
}
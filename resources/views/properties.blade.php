<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Real Estate Properties</h1>

    

    <!-- Add Property Form -->  
    <button id="toggle-form-btn" onclick="toggleForm()">New</button>
    <form id="property-form" style="display:none;">
    <h3>Add New Property</h3>
        <label>Type:</label>
        <select id="type" required>
            <option value="House">House</option>
            <option value="Apartment">Apartment</option>
        </select>

        <label>Address:</label>
        <input type="text" id="address" required><br><br>

        <label>Size (sqft or m²):</label>
        <input type="number" id="size" required><br><br>

        <label>Bedrooms:</label>
        <input type="number" id="bedrooms" required><br><br>

        <label>Latitude:</label>
        <input type="number" step="any" id="latitude" required><br><br>

        <label>Longitude:</label>
        <input type="number" step="any" id="longitude" required><br><br>

        <label>Price:</label>
        <input type="number" id="price" required><br><br>

        <button type="submit">Add Property</button>
    </form>

   

    <!-- Search Properties Form -->
    <button id="toggle-search-btn" onclick="toggleSearch()">search</button>
    
    <form id="search-form" onsubmit="searchProperties(event)" style="display:none;">
    <h3>Search Properties</h3>
        <label>Type:</label>
        <select id="search-type">
            <option value="">Any</option>
            <option value="House">House</option>
            <option value="Apartment">Apartment</option>
        </select><br><br>

        <label>Size:</label>
        <input type="number" id="search-size"><br><br>

        <label>Bedrooms:</label>
        <input type="number" id="search-bedrooms"><br><br>

        <label>Price:</label>
        <input type="number" id="search-price"><br><br>
        <h4>OR Search by Area</h4>
        <label>Latitude:</label>
        <input type="number" step="any" id="search-lat"><br><br>
        <label>Longitude:</label>
        <input type="number" step="any" id="search-lon"><br><br>
        <label>Radius (km):</label>
        <input type="number" step="any" id="search-radius"><br><br>

        <button type="submit">Search</button>
    </form>
    <br>


    <!-- Property List -->
    <table id="property-table">
        <thead>
            <tr>
                <th>Type</th>
                <th>Address</th>
                <th>Size (sqft)</th>
                <th>Bedrooms</th>
                <th>Price ($)</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <script>
        // Add new property
        document.getElementById("property-form").addEventListener("submit", function(e) {
            e.preventDefault();

            const property = {
                type: document.getElementById("type").value,
                address: document.getElementById("address").value,
                size: parseInt(document.getElementById("size").value),
                bedrooms: parseInt(document.getElementById("bedrooms").value),
                latitude: parseFloat(document.getElementById("latitude").value),
                longitude: parseFloat(document.getElementById("longitude").value),
                price: parseFloat(document.getElementById("price").value)
            };

            axios.post('http://127.0.0.1:8000/api/properties', property, {
                headers: { 'Content-Type': 'application/json' }
            })
            .then(function(response) {
                alert("Property added successfully!");
                getProperties();  
                document.getElementById("property-form").reset();
                document.getElementById("search-form").reset();
                document.getElementById("property-form").style.display = "none";
            })
            .catch(function(error) {
                alert("Error adding property.");
            });
        });


        // Get properties from the server
        function getProperties() {
            axios.get('http://127.0.0.1:8000/api/properties')
                .then(function(response) {
                    const properties = response.data;
                    const propertyTableBody = document.getElementById("property-table").getElementsByTagName('tbody')[0];
                    propertyTableBody.innerHTML = '';

                    if (properties.length === 0) {
                        const row = propertyTableBody.insertRow();
                        const cell = row.insertCell();
                        cell.colSpan = 5;
                        cell.textContent = "No properties available.";
                    } else {
                        properties.forEach(function(property) {
                            const row = propertyTableBody.insertRow();
                            row.insertCell().textContent = property.type;
                            row.insertCell().textContent = property.address;
                            row.insertCell().textContent = property.size + " sqft";
                            row.insertCell().textContent = property.bedrooms;
                            row.insertCell().textContent = "$" + property.price;
                        });
                    }
                })
                .catch(function(error) {
                    console.error("Error fetching properties:", error);
                });
        }


        // Search from the properties
        function searchProperties(event) {
            event.preventDefault(); // Prevent form submission

            const type = document.getElementById("search-type").value;
            const size = document.getElementById("search-size").value;
            const bedrooms = document.getElementById("search-bedrooms").value;
            const price = document.getElementById("search-price").value;
            const lat = document.getElementById("search-lat").value;
            const lon = document.getElementById("search-lon").value;
            const radius = document.getElementById("search-radius").value;
 
            const searchParams = {
                type: type || undefined,
                size: size || undefined,
                bedrooms: bedrooms || undefined,
                price: price || undefined,
                latitude: lat || undefined,
                longitude: lon || undefined,
                radius: radius || undefined
            };

            
            axios.get('http://127.0.0.1:8000/api/properties/search', { params: searchParams })
            .then(function(response) {
                const properties = response.data;

                console.log("Search prop:", properties);
                updatePropertyTable(properties); 
            })
            .catch(function(error) {
                console.error("Error searching properties:", error);
            });
        }



        // visibility of Add Property Form
        function toggleForm() {
            const formContainer = document.getElementById("property-form");
            
            if (formContainer.style.display === "none") {
                formContainer.style.display = "block";
            } else {
                formContainer.style.display = "none";
            }
        }

        // visibility of Add Search Form
        function toggleSearch() {
            const SearchContainer = document.getElementById("search-form");
            
            if (SearchContainer.style.display === "none") {
                SearchContainer.style.display = "block";                
            } else {
                SearchContainer.style.display = "none";         
            }
        }


        // Initialize page
        getProperties();
    </script>
</body>
</html>

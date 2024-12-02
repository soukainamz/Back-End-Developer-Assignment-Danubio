# Real Estate Inventory Management API

Welcome to the **Real Estate Inventory Management API** project! This application is built using **PHP** and **Laravel** and serves as a REST API to manage the inventory of real estate properties. It allows users to create, search, and manage property listings for an imaginary real estate agency.

---

## Table of Contents
1. [Features](#features)
2. [Requirements](#requirements)
3. [Setup Instructions](#setup-instructions)
4. [Usage](#usage)
5. [Potential Backlog Improvements](#potential-backlog-improvements)
6. [License](#license)

---

## Features

### Functional
- **Create Real Estate Properties**  
  - Add properties with details such as type (House/Apartment), address, size, number of bedrooms, geolocation, and price.
  
- **Search Properties**  
  - Search for properties based on:
    - Type
    - Address
    - Size
    - Number of Bedrooms
    - Price
    - Geographical Search: Retrieve all properties within a specified radius from a geographical point (latitude/longitude).

### Technical
- Built with **Laravel**, leveraging its robust features for REST API development.
- Utilizes a relational database (e.g., MySQL or PostgreSQL) for managing property data.
- Follows best practices for API design and database interactions.

---

## Requirements

- **PHP** >= 8.1
- **Composer**
- **Laravel Framework** >= 10.x
- Relational Database (e.g., MySQL or PostgreSQL)
- **Git**
- **axios** 

---

## Setup Instructions

1. **Clone the Repository**
   ```bash
   git clone https://github.com/your-username/real-estate-api.git
   cd real-estate-api
2. **Install Dependencies**
    composer install
3. **Update .env**
4. **Run Database Migrations**
    php artisan migrate
5. **Start the Development Server**
    php artisan serve
5. **The application should now be accessible at** 
     http://127.0.0.1:8000/properties 

## Endpoints

- **Endpoint**: `GET /properties`
 Retrieves a list of all properties in the inventory.

- **Endpoint**: `POST /properties`
 Adds a new property to the inventory.

- **Endpoint**: `GET /properties/search`
 Searches for properties based on specific criteria.

---

## Features

### Potential Backlog Improvements

1. **Google Maps Integration**
   - Add a feature to display property locations on a Google Map based on their latitude and longitude.  
   - This enhancement would provide a visual representation of the properties' geographical locations, making it easier for users to understand their proximity to specific areas.

2. **Authentication and Authorization**
   - Implement user roles (e.g., Admin, Agent) for secure access.

3. **Property Media Support**
   - Allow uploading images or videos for each property listing.

4. **Reservation System**
   - Add the ability for users to reserve properties


### Notes

1. **Default Laravel Files**
   - The project includes the default Laravel boilerplate files to give you flexibility in personalizing the application.  
   - Feel free to modify or extend the existing structure as per your requirements.

2. **Axios for Property Creation**
   - I used **Axios** for creating new properties directly through API calls in the application.  
   - However, you can customize this functionality by directing users to a dedicated form page for property creation, providing a more user-friendly interface if needed.

3. **Radius and Geolocation Precision**
   - The **radius** for geographical searches is specified in kilometers (km).  
   - The **latitude** and **longitude** values are stored as decimal values with a precision of `(7,10)` to ensure accurate positioning.  
   - For example:
     - A radius of `5 km` corresponds to a `0.0005` difference in latitude or longitude.  
     - This precision ensures that the geospatial calculations are accurate and reliable for small-scale searches.

# Shopping Portal Project

## Introduction

This project is a PHP-based shopping portal consisting of two panels: the User Panel and the Admin Panel. Depending on the user's credentials entered during login, the user will be redirected to the appropriate panel with specific functionalities tailored for either users or administrators.

## Table of Contents

1. [Features](#features)
   - [User Panel](#user-panel)
   - [Admin Panel](#admin-panel)
2. [Installation](#installation)
3. [Configuration](#configuration)
4. [Usage](#usage)
5. [Contributing](#contributing)

## Features

### User Panel

- **Add items to the cart**: Users can browse and add items to their personal cart.
- **Remove items from the cart**: Users can remove items from their cart as needed.
- **Individual Single Carts**: Each user has a unique cart assigned to them, ensuring a personalized shopping experience.
- **Persistent Cart**: Items added to the cart are saved, even if the user logs out and returns later.
- **Modify Item Quantities**: Users can increase or decrease the quantity of items in their cart.
- **Place Orders**: Users can place an order for the items in their cart.
- **Change Password**: Users have the option to change their password after logging in.

### Admin Panel

- **Add Items**: Admins can add new items to the shopping portal, with or without images.
- **View Orders**: Admins can view all the orders placed by users.
- **Delete Orders**: Admins have the authority to delete any order.
- **Remove Users**: Admins can remove users from the portal.
- **Remove Items**: Admins can remove items from the shopping portal.

## Installation

1. **Clone the Repository**:
   ```sh
   git clone https://github.com/yourusername/shopping-portal.git
   ```
2. **Navigate to the Project Directory**:
   ```sh
   cd shopping-portal
   ```
3. **Set Up the Database**:
   - Create a MySQL database for the project.
   - Import the provided SQL file to set up the necessary tables:
     ```sh
     mysql -u username -p database_name < database/store.sql
     ```
4. **Configure the Project**:
   - Rename `config.example.php` to `config.php`.
   - Update the database credentials and other configurations in `config.php`.

5. **Start the Server**:
   - Ensure your web server (Apache, Nginx, etc.) is configured to serve the project.
   - Access the project in your browser.

## Configuration

The `config.php` file contains the configuration settings for the project. Make sure to update it with your database credentials and any other necessary settings.

```php
<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'your_username');
define('DB_PASSWORD', 'your_password');
define('DB_NAME', 'your_database');

// Define other configuration settings as needed
?>
```

## Usage

### User Panel

1. **Login**: Enter user credentials on the login page to access the User Panel.
2. **Shopping**: Browse items and add desired items to the cart.
3. **Manage Cart**: Increase, decrease, or remove items from the cart as needed.
4. **Place Order**: Once satisfied with the cart, place an order.
5. **Account Settings**: Change your password through the account settings.

### Admin Panel

1. **Login**: Enter admin credentials on the login page to access the Admin Panel.
2. **Manage Items**: Add, update, or remove items from the shopping portal.
3. **Order Management**: View and delete orders placed by users.
4. **User Management**: Remove users from the portal as necessary.

## Contributing

I welcome contributions from the community. If you'd like to contribute, please fork the repository and submit a pull request with your changes. Ensure your code follows the project's coding standards and includes appropriate tests.

---

Feel free to contact me if you have any questions or need further assistance to this mail <tanm280604@gmail.com>.

Happy Shopping!

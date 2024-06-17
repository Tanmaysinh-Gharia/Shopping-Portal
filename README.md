# Shopping Portal Project

## Introduction

This project is a PHP-based shopping portal designed with two distinct panels: the User Panel and the Admin Panel. Additionally, it accommodates five types of users with specific functionalities tailored to each role: Admin, Vendor, Customer, Shipping Manager, and Delivery Agent. The portal ensures a smooth and secure shopping experience, with advanced functionalities such as captcha protection, item status tracking, and role-based access control.

## Table of Contents

1. [Features](#features)
   - [User Panel](#user-panel)
   - [Admin Panel](#admin-panel)
   - [Vendor Panel](#vendor-panel)
   - [Shipping Manager Panel](#shipping-manager-panel)
   - [Delivery Agent Panel](#delivery-agent-panel)
2. [Installation](#installation)
3. [Configuration](#configuration)
4. [Usage](#usage)
   - [User Panel](#user-panel-usage)
   - [Admin Panel](#admin-panel-usage)
   - [Vendor Panel](#vendor-panel-usage)
   - [Shipping Manager Panel](#shipping-manager-panel-usage)
   - [Delivery Agent Panel](#delivery-agent-panel-usage)
5. [Contributing](#contributing)

## Features

### User Panel

- **Add items to the cart**: Users can browse and add items to their personal cart.
- **Remove items from the cart**: Users can remove items from their cart as needed.
- **Individual Single Carts**: Each user has a unique cart assigned to them.
- **Persistent Cart**: Items added to the cart are saved, even if the user logs out and returns later.
- **Modify Item Quantities**: Users can increase or decrease the quantity of items in their cart.
- **Place Orders**: Users can place an order for the items in their cart.
- **View Order History**: Users can view their past orders with detailed status updates for each item.
- **Change Password**: Users can change their password after logging in.

### Admin Panel

- **Approve Accounts**: Admins can approve or reject applications for Vendor, Shipping Manager, and Delivery Agent accounts.
- **Add Items**: Admins can add new items to the shopping portal, with or without images.
- **View and Delete Orders**: Admins can view all orders placed by users and delete them if necessary.
- **Remove Users**: Admins can remove users from the portal.
- **Remove Items**: Admins can remove items from the shopping portal.
- **Trace Orders**: Admins can trace orders by order ID and see detailed information about each item's status.

### Vendor Panel

- **Add Products**: Vendors can add products with details like name, price, image, category, and stock information.
- **Manage Orders**: Vendors can accept or reject orders and update item statuses.
- **Dispatch Items**: Vendors can dispatch items to the shipping office and update item statuses accordingly.
- **View and Update Inventory**: Vendors can view their inventory, update stock, and modify item properties.
- **Change Password**: Vendors can change their password after logging in.

### Shipping Manager Panel

- **Manage Shipping Entries**: Shipping Managers can update the condition of items and mark them as damaged if necessary.
- **Assign Delivery Agents**: Shipping Managers can assign items to delivery agents based on clustered address orders.
- **Track Items**: Shipping Managers can track items' arrival and dispatch status.
- **Change Password**: Shipping Managers can change their password after logging in.

### Delivery Agent Panel

- **View Assigned Orders**: Delivery Agents can view their assigned orders for the day.
- **Update Order Status**: Delivery Agents can update the status of orders to delivered, undelivered, or damaged.
- **Change Password**: Delivery Agents can change their password after logging in.

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

### User Panel Usage

1. **Login**: Enter user credentials on the login page to access the User Panel.
2. **Shopping**: Browse items and add desired items to the cart.
3. **Manage Cart**: Increase, decrease, or remove items from the cart as needed.
4. **Place Order**: Once satisfied with the cart, place an order.
5. **Account Settings**: Change your password through the account settings.

### Admin Panel Usage

1. **Login**: Enter admin credentials on the login page to access the Admin Panel.
2. **Manage Users and Orders**: Approve or reject applications, manage users, and trace orders.
3. **Manage Items**: Add, update, or remove items from the shopping portal.

### Vendor Panel Usage

1. **Login**: Enter vendor credentials on the login page to access the Vendor Panel.
2. **Manage Products**: Add, update, and delete products from the portal.
3. **Manage Orders**: Accept or reject orders and update their status.
4. **Dispatch Items**: Dispatch accepted items to the shipping office.

### Shipping Manager Panel Usage

1. **Login**: Enter shipping manager credentials on the login page to access the Shipping Manager Panel.
2. **Manage Shipments**: Update the condition of items and mark them as damaged if necessary.
3. **Assign Delivery Agents**: Assign items to delivery agents and track the shipping process.

### Delivery Agent Panel Usage

1. **Login**: Enter delivery agent credentials on the login page to access the Delivery Agent Panel.
2. **View and Deliver Orders**: View assigned orders and update their status upon delivery.

## Contributing

I welcome contributions from the community. If you'd like to contribute, please fork the repository and submit a pull request with your changes. Ensure your code follows the project's coding standards and includes appropriate tests.

---

For further assistance, please contact <tanm280604@gmail.com>.

Happy Shopping!
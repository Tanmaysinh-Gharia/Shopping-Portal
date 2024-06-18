# Shopping Portal Project

## Introduction

This PHP-based shopping portal offers a streamlined, secure shopping experience through two main panels: the User Panel and the Admin Panel. The system is designed to accommodate five types of users: Admin, Vendor, Customer, Shipping Manager, and Delivery Agent, each with distinct functionalities. The portal features advanced functionalities such as captcha protection, item status tracking, and role-based access control, ensuring a smooth and efficient experience for all users.

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

- **Add items to the cart**: Browse and add items to the cart.
- **Remove items from the cart**: Remove items as needed.
- **Persistent Individual Carts**: Items are saved in the cart even after logging out.
- **Modify Item Quantities**: Adjust quantities of items in the cart.
- **Place Orders**: Finalize purchases from the cart.
- **View Order History**: Detailed status updates for past orders.
- **Change Password**: Update password securely.

### Admin Panel

- **Approve Accounts**: Approve or reject Vendor, Shipping Manager, and Delivery Agent applications.
- **Add Items**: Add new items to the portal.
- **Manage Orders**: View and delete orders.
- **Remove Users**: Delete user accounts.
- **Remove Items**: Delete items from the portal.
- **Trace Orders**: Track orders by order ID.

### Vendor Panel

- **Add Products**: List new products with comprehensive details.
- **Manage Orders**: Accept or reject orders and update statuses.
- **Dispatch Items**: Send items to the shipping office.
- **View and Update Inventory**: Manage stock and item details.
- **Change Password**: Update password securely.

### Shipping Manager Panel

- **Manage Shipping Entries**: Update item conditions and mark as damaged if necessary.
- **Assign Delivery Agents**: Allocate items to delivery agents.
- **Track Items**: Monitor item status during shipping.
- **Change Password**: Update password securely.

### Delivery Agent Panel

- **View Assigned Orders**: Check daily assigned orders.
- **Update Order Status**: Mark orders as delivered, undelivered, or damaged.
- **Change Password**: Update password securely.

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
   - Create a MySQL database.
   - Import the provided SQL file:
     ```sh
     mysql -u username -p database_name < database/store.sql
     ```
4. **Configure the Project**:
   - Rename `config.example.php` to `config.php`.
   - Update database credentials and other configurations in `config.php`.

5. **Start the Server**:
   - Configure your web server (Apache, Nginx, etc.) to serve the project.
   - Access the project in your browser.

## Configuration

Update the `connection.php` file with your database credentials and other necessary settings.

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

1. **Login**: Use your credentials to access the User Panel.
2. **Shopping**: Browse and add items to your cart.
3. **Manage Cart**: Adjust quantities or remove items.
4. **Place Order**: Confirm and place your order.
5. **Account Settings**: Change your password if needed.

### Admin Panel Usage

1. **Login**: Use admin credentials to access the Admin Panel.
2. **Manage Users and Orders**: Approve/reject applications, manage users, and trace orders.
3. **Manage Items**: Add, update, or remove items from the portal.

### Vendor Panel Usage

1. **Login**: Use vendor credentials to access the Vendor Panel.
2. **Manage Products**: Add, update, or delete products.
3. **Manage Orders**: Accept/reject orders and update their status.
4. **Dispatch Items**: Send items to the shipping office.

### Shipping Manager Panel Usage

1. **Login**: Use shipping manager credentials to access the Shipping Manager Panel.
2. **Manage Shipments**: Update item conditions and manage shipments.
3. **Assign Delivery Agents**: Allocate items to delivery agents.

### Delivery Agent Panel Usage

1. **Login**: Use delivery agent credentials to access the Delivery Agent Panel.
2. **View and Deliver Orders**: Check assigned orders and update their status.

## Contributing

Contributions are welcome. Fork the repository and submit a pull request with your changes. Ensure your code follows the project's standards and includes appropriate tests.

---

For further assistance, please contact <tanm280604@gmail.com>.

Happy Shopping!
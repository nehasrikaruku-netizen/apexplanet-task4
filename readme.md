# 💸 SpendWise - Smart Expense Tracker (Task 4)

SpendWise is a secure and user-friendly Expense Tracker Web Application developed using PHP and MySQL.
This project helps users manage daily expenses efficiently with advanced features like authentication, validation, prepared statements, expense limits, search functionality, pagination, and user role management.

---

# 🚀 Features

## 🔐 Authentication System

* User Registration
* User Login & Logout
* Session Management
* Protected Pages

---

## 💰 Expense Management

* Add Expense
* View Expenses
* Edit Expense
* Delete Expense

---

## 🔍 Smart Search Feature

Users can search expenses directly from the dashboard using:

* Expense Title
* Category
* Payment Method

---

## 📄 Pagination

Expenses are displayed using pagination for better user experience.

---

## ✅ Form Validation

Validation added for:

* Empty Fields
* Invalid Amounts
* Negative Values
* Required Inputs

---

## 🛡️ Security Enhancements

Implemented:

* Prepared Statements
* Session Protection
* SQL Injection Prevention

---

## 🎯 Expense Limit Feature

Users can:

* Set custom expense limit
* Receive alert when expense exceeds limit

---

## 👤 User Roles

Role-based structure added:

* User
* Admin (basic implementation)

---

# 🛠️ Technologies Used

* PHP
* MySQL
* HTML5
* CSS3
* XAMPP
* phpMyAdmin

---

# 📂 Project Structure

expense_tracker/task4/

├── 01_db.php
├── 02_register.php
├── 03_login.php
├── 04_add_expense.php
├── 05_view_expense.php
├── 06_edit_expense.php
├── 07_delete_expense.php
├── 08_logout.php
├── 09_dashboard.php

---

# 🗄️ Database Tables

## users table

| Column Name   | Description        |
| ------------- | ------------------ |
| id            | User ID            |
| username      | Username           |
| password      | Password           |
| role          | User Role          |
| expense_limit | User Expense Limit |

---

## expenses table

| Column Name    | Description         |
| -------------- | ------------------- |
| id             | Expense ID          |
| title          | Expense Title       |
| amount         | Expense Amount      |
| category       | Expense Category    |
| payment_method | Payment Method      |
| expense_date   | Expense Date        |
| description    | Expense Description |

---

# ⚙️ Installation Steps

1. Install XAMPP

2. Start Apache & MySQL

3. Copy project folder into:
   C:/xampp/htdocs/

4. Open phpMyAdmin

5. Create database:
   expense_tracker

6. Import database tables

7. Run project in browser:

http://localhost/expense_tracker/task4/

---

# 📸 Screenshots Included

* Register Page
* Login Page
* Dashboard
* Add Expense
* View Expenses
* Edit Expense
* Search Feature
* Expense Limit Feature
* Validation Alerts
* Database Tables

---

# 🎯 Task 4 Enhancements

✔️ Form Validation
✔️ Prepared Statements
✔️ Session Security
✔️ Search Functionality
✔️ Pagination
✔️ Expense Limit System
✔️ User Role Management
✔️ Secure CRUD Operations

---

# 📌 Future Improvements

* Password Hashing
* Expense Charts & Analytics
* Monthly Reports
* Export PDF/Excel
* Dark Mode

---

# 👩‍💻 Developed By

Neha Sri Karuku
B.Tech CSE - AI
Vignan’s Institute of Information & Technology

---

# ⭐ Conclusion

SpendWise is a secure and modern expense tracking application designed to simplify daily expense management while implementing important backend security concepts and real-world web development practices.

Table of Contents
# Overview
# Prerequisites
# Step-by-Step Installation
# Configuration
# Starting the Application
# Using the Application
# Troubleshooting

1. Overview <a name="overview"></a>
The Job Portal application allows users to browse job listings, view job details, and export listings as CSV files. This guide will help set up the application on any machine so it runs identically to the original environment.

2. Prerequisites <a name="prerequisites"></a>
To run the Job Portal application, ensure the following are installed on the computer:

PHP (Version 7.4 or higher)
MySQL (Version 5.7 or higher)
Apache Web Server (e.g., via XAMPP, WAMP, or LAMP)
Composer (for dependency management)
Git (optional, for cloning the repository)

3. Step-by-Step Installation <a name="installation"></a>
Step 1: Install Prerequisite Software
Windows: Download XAMPP to install Apache, PHP, and MySQL in one package.
macOS/Linux: Install Apache, PHP, and MySQL through the terminal (see commands below).
For Linux (Debian-based):
sudo apt update
sudo apt install apache2 php libapache2-mod-php php-mysql mysql-server

For macOS (using Homebrew):
brew install php mysql composer

Step 2: Clone or Download the Project
Option 1: Cloning (if you have Git installed)
git clone https://github.com/yourusername/job-portal-app.git
cd job-portal-app

Option 2: Download as ZIP

Download the project ZIP file from the source (e.g., GitHub).
Extract the ZIP file to a directory, then navigate to that folder.

Step 3: Set Up the Database
Open phpMyAdmin: Navigate to http://localhost/phpmyadmin in your browser.
Create a New Database:
Name it job_portal or any name you prefer (make sure to update the configuration if you choose a different name).
Import Database Schema:
In phpMyAdmin, select the newly created database.
Go to the Import tab.
Choose the database.sql file from the project folder and click Go to import tables and data.

4. Configuration <a name="configuration"></a>
Step 1: Database Configuration
Open the database.php file in the project root directory.
Update the database connection settings to match your environment:
php

$db_host = 'localhost';
$db_user = 'root';           // Username, 'root' for local setups
$db_pass = '';                // Password, often empty for local
$db_name = 'job_portal';      // The name of your database

Step 2: Move Project to Web Server Directory
Windows (XAMPP): Copy the project folder to C:/xampp/htdocs/job-portal-app.
Linux: Move to /var/www/html/job-portal-app.
macOS: Copy to /Library/WebServer/Documents/job-portal-app.
Step 3: Install Composer Dependencies
If the project includes a composer.json file for dependencies, install them:

composer install

5. Starting the Application <a name="starting-the-application"></a>
1. Start Apache and MySQL Services:

Windows (XAMPP): Open the XAMPP Control Panel and click Start next to Apache and MySQL.
Linux/macOS: Start the services via terminal:

2. Access the Application:

Open a web browser and navigate to http://localhost/job-portal-app.
You should see the Job Portal Login Page.

6. Using the Application <a name="using-the-application"></a>
Step 1: Log In
Use the default credentials provided in the database import, or create a new user via phpMyAdmin.
Step 2: Navigating the Dashboard
Job Advert List: View available job positions.
Export to CSV: Click this button to download job listings as a CSV file.
Click Statistics: View a chart showing user interactions with job listings.
Step 3: Viewing Job Details
Each job listing includes details like:
Job Title, Reference, Location, Sector, Salary, and Description.
Step 4: Exporting Job Adverts
To download job adverts as a CSV:
Click on Export to CSV at the bottom of the job advert list page.

7. Troubleshooting <a name="troubleshooting"></a>
Here are some common issues and solutions.

Database Connection Issues
Error: Database not connecting.
Solution: Make sure MySQL is running and double-check credentials in database.php.
Page Not Found (404) Error
Error: Page not loading or displaying a 404 error.
Solution: Confirm the project is in the correct web server directory and Apache is running.
SOAP Extension Errors (if using SOAP services)
Error: "SOAP extension not found" or similar.
Solution: Check if the SOAP extension is enabled:
XAMPP: Open php.ini and ensure extension=soap is uncommented.
Sessions Not Working
Error: Issues with user login or session handling.
Solution: Check php.ini for the session.save_path setting. Make sure it is correctly set.


Use the test@gmail.com  and password: 123456789 to login.
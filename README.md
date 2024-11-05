Table of Contents
*Prerequisites
*Installation Guide
*Configuration
*Running the Application
*Using the Job Portal Application
*Troubleshooting


1. Prerequisites
To set up this application, ensure the following prerequisites are installed:

PHP (Version 7.4 or higher)
MySQL (Version 5.7 or higher)
Apache Web Server (part of XAMPP, WAMP, or LAMP)
Composer (for dependency management)
Git (optional, if cloning from a repository)
Windows Users:
Download and install XAMPP, which includes PHP, MySQL, and Apache. Follow the on-screen instructions to complete the installation.

Linux Users:
1.Install Apache, PHP, and MySQL:
sudo apt update
sudo apt install apache2 php libapache2-mod-php php-mysql mysql-server

2.Install Composer
sudo apt install composer

macOS Users:
1.Install Homebrew if you don’t have it:
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install.sh)"

2.Install PHP, MySQL, and Composer:
brew install php mysql composer

2.Installation Guide
Step 1: Clone or Download the Project
If you have Git installed, clone the project repository:

git clone https://github.com/yourusername/job-portal-app.git
cd job-portal-app

If you don’t have Git, download the ZIP file of the project, unzip it, and navigate to the folder.

Step 2: Set Up the Database
Open phpMyAdmin (usually accessible via http://localhost/phpmyadmin).
Create a new database (e.g., job_portal).
Import the SQL file (database.sql) located in the project root directory:
In phpMyAdmin, select the new database.
Go to the Import tab.
Choose the database.sql file and click Go to import the tables and data.
Step 3: Update the Database Configuration
Open the database.php file in the project root.

Update the following configuration variables to match your MySQL setup:

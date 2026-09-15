**# Attendance-Management-System-Laravel**# Attendance Management System (AMS) ⏱️

A comprehensive, automated attendance tracking web application built with the **Laravel** PHP framework. This system is designed to efficiently manage user records, streamline daily attendance logging, and replace manual tracking with secure, automated data processing.

## ✨ Key Features

* **Secure Authentication:** Robust user login and registration system utilizing Laravel's built-in authentication security.
* **Automated Time Tracking:** Streamlined daily check-in and check-out functionality for accurate attendance records.
* **Dashboard Analytics:** A centralized dashboard for administrators to view attendance trends, present/absent ratios, and user histories.
* **Database Management:** Efficiently structured relational database to manage users, roles, and timestamped attendance logs.
* **MVC Architecture:** Strictly follows the Model-View-Controller design pattern for highly maintainable and scalable code.

## 🛠️ Technology Stack

* **Backend Framework:** Laravel (PHP)
* **Frontend:** HTML5, CSS3, JavaScript (Blade Templating)
* **Database:** MySQL
* **Package Management:** Composer & NPM

## 📸 Screenshots

<img width="1366" height="644" alt="WhatsApp Image 2026-09-09 at 10 37 03 AM (1)" src="https://github.com/user-attachments/assets/bec3add8-c94d-473f-864a-7ee657f3e35c" />
<img width="1366" height="641" alt="WhatsApp Image 2026-09-09 at 10 37 03 AM (2)" src="https://github.com/user-attachments/assets/6ad05e96-a6a6-49d4-907e-301c22915e41" />
<img width="1366" height="640" alt="WhatsApp Image 2026-09-09 at 10 37 04 AM" src="https://github.com/user-attachments/assets/93c8b3da-1130-426a-ab40-07f6ac4af8e9" />

## 🚀 How to Run Locally

### Prerequisites
* PHP (v8.1 or higher)
* Composer
* MySQL Server (e.g., XAMPP, WAMP, or standalone)
* Node.js & NPM

### Installation Steps
1. **Clone the repository:**
   ```bash
   git clone https://github.com/naik2571/Attendance-Management-System.git
   cd Attendance-Management-System

2. **Install PHP Dependencies:**
   ```bash
   composer install
3. **Install Frontend Dependencies:**
   ```bash
   npm install
   npm run build

4.**Environment Setup:**
  * Copy the .env.example file and rename it to .env.
  * Open the .env file and update your database credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

5. **Generate Application Key:**
   ```bash
   php artisan key:generate

6. **Run Database Migrations:**
   ```bash
   php artisan migrate


7. **Start the Development Server:**
   ```bash
   php artisan serve

The application will now be running at http://localhost:8000

🤝 Contributing
This project is part of my development portfolio. Feel free to fork the repository and submit pull requests if you have suggestions for new features!

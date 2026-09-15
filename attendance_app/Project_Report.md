# Project Report: Student Attendance Management System

## 1. Introduction
The **Student Attendance Management System** is a web-based application built using the Laravel framework. The primary objective of this system is to automate and streamline the process of tracking student attendance, replacing manual paper-based methods with a centralized digital solution.

## 2. Objectives
* Provide a secure authentication system distinguishing between Administrators and Students.
* Allow students to easily clock in, clock out, and request leave on a daily basis.
* Empower administrators to manage student accounts (CRUD operations) and monitor global attendance records.
* Generate real-time statistical summaries of daily attendance data.

## 3. Technologies Used
* **Backend Framework:** Laravel 11.x (PHP)
* **Database:** MySQL
* **Frontend:** HTML5, Blade Templating, Tailwind CSS
* **Authentication:** Laravel Breeze
* **Development Environment:** XAMPP, Node.js, Composer

## 4. Key Features

### 4.1. Administrator Features
* **Dashboard Statistics:** View real-time daily metrics including Total Students, Total Present, Total Absent, and Total on Leave.
* **Student Management:** Full CRUD (Create, Read, Update, Delete) capabilities to manage student accounts. Public registration is disabled to ensure system security.
* **Attendance Oversight:** A comprehensive, paginated table of all student attendance records.
* **Manual Overrides:** The ability to manually mark a student as 'Absent' if they fail to attend.
* **Date Filtering:** Administrators can filter the attendance view to analyze records from specific past dates.

### 4.2. Student Features
* **Secure Login:** Access to a personal, secure dashboard.
* **Daily Clocking:** Simple interfaces to 'Clock In' and 'Clock Out'. The system prevents duplicate clock-ins on the same day.
* **Leave Requests:** Students can apply for leave directly from their dashboard.
* **Personal History:** A dedicated table allowing students to view their historical attendance records and statuses.

## 5. System Architecture (MVC)
This project strictly adheres to the **Model-View-Controller (MVC)** architectural pattern:
* **Models:** `User.php` and `Attendance.php` manage the database logic and define the One-to-Many relationships.
* **Controllers:** `AttendanceController.php` and `AdminStudentController.php` handle the business logic, request validation, and database queries.
* **Views:** Blade templates (e.g., `dashboard.blade.php`, `admin.attendances.blade.php`) handle the presentation logic, styled securely with Tailwind CSS.

## 6. Conclusion
The Laravel Student Attendance Management System successfully fulfills the requirements for modern attendance tracking. It demonstrates a strong understanding of Laravel's core features including Eloquent ORM, authentication mechanisms, database seeding, routing, and controller logic. The resulting application is secure, responsive, and easy to maintain.

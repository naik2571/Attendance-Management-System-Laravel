# Laravel Attendance System: Project Documentation

This document explains every file that was created or modified during the development of your Laravel Module Completion Project, why it exists, what it does, and how to use it.

## 1. Database Migrations & Seeders (The Blueprint)
Migrations are version control for your database. Seeders allow you to automatically generate fake data for presentations.

*   **File:** `database/migrations/0001_01_01_000000_create_users_table.php`
    *   **What it does:** Creates the `users` table where student and admin accounts are stored.
    *   **Why it was changed:** Added a `$table->string('role')->default('student');` line so the system distinguishes between normal students and administrators.
*   **File:** `database/migrations/..._create_attendances_table.php`
    *   **What it does:** Creates the `attendances` table.
    *   **Why it was created:** Stores the core data: `user_id`, `date`, `clock_in_time`, `clock_out_time`, and `status` (present, absent, leave).
*   **File:** `database/seeders/DatabaseSeeder.php`
    *   **What it does:** Automatically generates 1 master admin, 25 fake students, and 7 days of attendance history for demonstration purposes.

## 2. Eloquent Models (The Data Layer)
Models are how Laravel interacts with the database tables.

*   **File:** `app/Models/User.php`
    *   **Why it was changed:** Added `role` to `$fillable` and defined an `attendances()` function to create a "One-to-Many" relationship (One User has Many Attendances).
*   **File:** `app/Models/Attendance.php`
    *   **Why it was created:** Defines the `$fillable` fields allowed to be saved (like `clock_in_time`, `status`) and defines a `user()` relationship pointing back to the student.

## 3. Controllers (The Brains)
Controllers contain the "Business Logic".

*   **File:** `app/Http/Controllers/AttendanceController.php`
    *   **What it does:** Handles logic for students clocking in/out and applying for leave.
    *   **Functions inside:**
        *   `clockIn()`, `clockOut()`: Validates and records timestamps.
        *   `markLeave()`: Lets students apply for leave if they haven't clocked in yet.
        *   `adminIndex()`: Displays the admin attendance view, including logic for **Statistics Generation**, **Date Filtering**, and **Pagination**.
*   **File:** `app/Http/Controllers/AdminStudentController.php`
    *   **What it does:** Provides a full **CRUD** (Create, Read, Update, Delete) system for Administrators to manage student accounts.
    *   **Functions inside:**
        *   Standard resource methods: `index`, `create`, `store`, `edit`, `update`, `destroy`.
        *   `markAbsent()`: Allows the admin to mark a student absent for the day.

## 4. Routes (The Map)
Routes tell Laravel which Controller function to run for specific URLs.

*   **File:** `routes/web.php`
    *   **Why it was changed:** Added routes for the Dashboard, Clock In/Out/Leave forms, and a `Route::resource` for Admin Student Management. All wrapped in `auth` middleware.
*   **File:** `routes/auth.php`
    *   **Why it was changed:** Public registration (`/register`) was completely deleted for security. Only Admins can create student accounts now.

## 5. Views (The User Interface)
Views use the Blade templating engine and Tailwind CSS.

*   **File:** `resources/views/dashboard.blade.php`
    *   **What it does:** The main page students see. Contains functional Clock In, Clock Out, and Request Leave buttons, plus a history table.
*   **File:** `resources/views/admin/attendances.blade.php`
    *   **What it does:** The Admin Panel. Contains dynamic Statistics cards, a Date Filter form, and a paginated table of all daily attendances.
*   **File:** `resources/views/admin/students/index.blade.php`, `create.blade.php`, `edit.blade.php`
    *   **What they do:** The interfaces for the Admin to view all students, add new ones, and update/delete existing ones.

---

## How to Present & Test the Application

1.  **Reset & Seed Data:** Open your terminal in the project folder and run `php artisan migrate:fresh --seed`. This builds the database and fills it with fake students and attendances.
2.  **Start the Server:** Run `php artisan serve`. Go to `http://localhost:8000` in your web browser.
3.  **Test Admin Role:** 
    *   Log in with Email: `admin@admin.com` | Password: `password123`
    *   Look at the Top Navigation bar. You will see **Attendances (Admin)** and **Students (Admin)**.
    *   Test adding a student, filtering by date, and viewing the statistics.
4.  **Test Student Role:**
    *   Log out and log back in using the credentials of a student you created.
    *   Test clicking "Clock In", "Clock Out", or "Request Leave".

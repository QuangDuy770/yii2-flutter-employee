# Employee Management System - Yii2 REST API & Flutter App

An employee and department management system built with Yii2 REST API and Flutter mobile application.

The backend is deployed on Render and uses Aiven MySQL Cloud Database.

---

## Live Demo

Web Application:

```txt
https://yii2-flutter-employee.onrender.com
```

---

## REST API

Base URL:

```txt
https://yii2-flutter-employee.onrender.com
```

---

## Test Accounts

### Admin Account

```txt
username: admin
password: 123
```

### User Account

```txt
username: user
password: 123
```

---

## Technologies Used

### Backend

- PHP 8.2
- Yii2 Framework
- REST API
- MySQL
- Docker

### Mobile Application

- Flutter
- Dart
- HTTP Package

### Cloud & Deployment

- Render
- Aiven MySQL Cloud
- GitHub

---

## Main Features

### Authentication

- Login
- Logout
- Role-based access control for Admin and User

### Employee Management

- View employee list
- Create employee
- Update employee
- Delete employee
- Search employees
- Manage employee status
- Select department for employee
- Select hire date

### Department Management

- View department list
- Create department
- Update department
- Delete department
- Manage department status
- View employee count by department

---

## Validation

### Employee Validation

- Required field validation
- Email format validation
- Phone number validation
- Unique employee code validation
- Unique email validation
- Salary validation
- Hire date validation
- Status validation

### Department Validation

- Required department name validation
- Unique department name validation
- Department status validation

---

## System Architecture

```txt
Flutter Mobile App
        ↓
Yii2 REST API
        ↓
Aiven MySQL Cloud Database
```

---

## Project Structure

```txt
assets/
config/
controllers/
models/
views/
web/
```

---

## API Endpoints

### Authentication

```http
POST /api/auth/login
```

### Employee API

```http
GET /api/employee
POST /api/employee
PUT /api/employee/{id}
DELETE /api/employee/{id}
```

### Department API

```http
GET /api/department

```

---

## Database Tables

### user

- id
- username
- password_hash
- auth_key
- email
- role
- status
- created_at
- updated_at

### employee

- id
- employee_code
- full_name
- department_id
- position
- email
- phone
- hire_date
- salary
- status
- created_at
- updated_at

### department

- id
- name
- description
- status
- created_at
- updated_at

---

## Deployment

The backend is deployed on Render using Docker.

The database is hosted on Aiven MySQL Cloud.

When new code is pushed to GitHub, Render can automatically rebuild and deploy the application.

---

## Environment Variables

The project uses environment variables for database connection:

```env
DB_HOST=
DB_PORT=
DB_NAME=
DB_USER=
DB_PASS=
```

Database credentials should not be committed directly to GitHub.

---

## Run Project Locally

### Clone Repository

```bash
git clone https://github.com/QuangDuy770/yii2-flutter-employee.git
```

### Install Dependencies

```bash
composer install
```

### Run Application

```bash
php yii serve
```

---

## Flutter Mobile Application

Flutter repository:

```txt
https://github.com/QuangDuy770/employee-app
```

---

## APK Release

Flutter APK release is available in the GitHub Releases section of the Flutter repository.

---

## Notes

This project uses Render free tier and Aiven free tier services, so the first request may take a few seconds if the cloud services are sleeping.

For demo purposes, make sure the Aiven MySQL service is powered on before testing the web app or Flutter app.

---

## Author

Phạm Quang Duy

GitHub:

```txt
https://github.com/QuangDuy770
```

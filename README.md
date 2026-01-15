# Ramani Family Management System

A Laravel-based **Family Directory & Management System** with REST APIs and admin panel.  
This project allows users to register, manage profiles, family members, banners, and view family listings securely using token-based authentication.

---

## 🚀 Features

- 🔐 Mobile-based Authentication (Login / Register / Logout)
- 👤 User Profile Management  
  - Personal Details  
  - Business Details  
  - Marital Details
- 👨‍👩‍👧 Family Member Management (Add / List)
- 🏠 Location Management  
  - State  
  - District  
  - Sub-District
- 🖼 Banner Management (Admin)
- 📱 API-ready (Android / iOS support)
- 🔑 Token Authentication using **Laravel Sanctum**
- 🚫 Admin users excluded from public family list

---

## 🛠 Tech Stack

- **Backend:** Laravel (PHP ≥ 8.1)
- **Database:** MySQL
- **Authentication:** Laravel Sanctum
- **Frontend (Admin):** Blade + Tailwind CSS
- **API Client:** Postman / Mobile Apps

---

## ⚙️ Installation Steps

### Clone Repository
```bash
git clone https://github.com/your-username/ramani-family.git
cd ramani-family
```

### Install Dependencies
```bash
composer install
```

### Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` database details.

### Run Migrations
```bash
php artisan migrate
```

### Storage Link
```bash
php artisan storage:link
```

### Start Server
```bash
php artisan serve
```

---

## 🔑 API Authentication

All protected APIs require a **Bearer Token**:

```
Authorization: Bearer YOUR_TOKEN
```

---

## 📡 API Endpoints

### Auth
- POST `/api/register`
- POST `/api/login`
- POST `/api/logout`

### Profile
- GET `/api/profile`
- POST `/api/profile/personal`
- POST `/api/profile/business`
- POST `/api/profile/marital`

### Family
- GET `/api/family/list`
- POST `/api/family-member/add`

### Location
- GET `/api/states`
- GET `/api/districts/{state_id}`
- GET `/api/sub-districts/{district_id}`

---

## 🖼 Banner API

Banner list is returned with login response.

---

## 🧑 Default Profile Image

If `profile_img` is empty, default image is used:
```
/images/default-profile.png
```

---

## 📄 License

This project is proprietary and developed for **Ramani Parivar**.

---

## ✨ Developed By

**Kartik Dholariya**  
Laravel | API | Full Stack Developer

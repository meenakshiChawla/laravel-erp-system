# Laravel ERP System – Inventory & Sales Management

A basic ERP system built using **Laravel** with Inventory and Sales Order functionality, including role-based access, PDF export, and API endpoints secured via Sanctum.

---

## 🚀 Objective

Build a simple ERP system focusing on:

- Inventory Management
- Sales Orders
- Role-based Authentication
- RESTful API Integration

---

## ✅ Core Features

### 1. Authentication & Roles
- Laravel Breeze-based login system
- Two roles: **Admin** and **Salesperson**
- Admin: Full access to all modules
- Salesperson: Can only manage/view sales orders

### 2. Inventory Management
- CRUD operations for Products (`name`, `SKU`, `price`, `quantity`)
- Auto reduce stock on order confirmation
- Low stock alerts on dashboard

### 3. Sales Orders
- Create orders with multiple products
- Auto-calculate total amount
- Reduce inventory quantities
- Export sales orders to **PDF** (via dompdf)

### 4. Dashboard Summary
- Total Sales Amount
- Total Orders Count
- Low Stock Warnings

---

## 🔗 API Endpoints

Secured using **Laravel Sanctum** (or Passport)

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET    | `/api/products` | List all products |
| POST   | `/api/sales-orders` | Create new sales order |
| GET    | `/api/sales-orders/{id}` | Get sales order with products & totals |

---

## ⚙️ Tech Stack

- **Laravel** (latest)
- **MySQL**
- **Bootstrap 5** *(or TailwindCSS optional)*
- **Laravel Breeze** (auth)
- **dompdf** for PDF generation
- **Sanctum** or **Passport** for API auth
- **FormRequest** for form validation
- **MVC** clean architecture

---

## 🛠️ Installation Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/laravel-erp-system.git
cd laravel-erp-system
```

### 2. Install Dependencies
```bash
composer install
npm install && npm run dev
```

### 3. Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and update your DB credentials:
```dotenv
DB_DATABASE=my_project
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Run Migrations & Seeders
```bash
php artisan migrate --seed
```

This will also create two default users:
| Role | Email | Password |
|------|-------|----------|
| Admin | admin@example.com | admin123 |
| Salesperson | sales@example.com | sales123 |

### 5. Serve the Application
```bash
php artisan serve
```

Access the app at: `http://localhost:8000`

---

## 📂 Project Structure

```
app/
├── Models/
├── Http/
│   ├── Controllers/
│   ├── Requests/
routes/
├── web.php
├── api.php
resources/
├── views/
database/
├── seeders/
├── migrations/
```

---

## 🧪 API Testing

Use Postman or Insomnia with Bearer Token (from Sanctum login) to access API routes.

- POST `/login` to authenticate
- Use received token for `/api/*` requests

---

## 📄 License

Licensed under the [MIT License](LICENSE).

---

## ✍️ Author

Created by **[Meenakshi Chawla]**

Feel free to contribute or fork for your own use!

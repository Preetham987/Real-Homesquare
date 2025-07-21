# 🏠 Real Homesquare

A real estate web platform featuring a **public website** (`/real`) and dedicated dashboards for **Admins**, **Builders**, and **Agents**. Built with PHP for backend processing and vanilla JavaScript + HTML/CSS for the frontend, this system enables easy property management, listing approvals, and lead tracking for real estate professionals.

---

## 📁 Project Structure


---

## 💡 Features Overview

### 🌐 Website (`/real`)
- Fully responsive real estate browsing interface
- Property filters (location, type, price, etc.)
- View builder and agent profiles
- Contact/inquiry forms
- Project details with images, amenities, and location

### 🛠️ Admin Panel (`/admin-panel`)
- Manage all registered builders and agents
- Review, approve, or reject property/project listings
- Handle content moderation and document verification
- Access statistics and inquiry logs

### 🧱 Builder Panel (`/builder-panel`)
- Add and update real estate projects
- Upload brochures, images, floor plans
- Monitor inquiries and view project statistics

### 🧑‍💼 Agent Panel (`/agent-panel`)
- Manage property sales or rental listings
- Track interested buyers and inquiries
- Maintain lead lists and sales logs

---

## 🔧 Tech Stack

- **Frontend:** HTML, CSS, JavaScript (no frameworks)
- **Backend:** PHP (Procedural or MVC based)
- **Database:** MySQL
- **Authentication:** Session-based login for each user type
- **File Uploads:** Standard PHP upload handling (image/doc validation)
- **Hosting:** cPanel (LAMP stack)

---

## 🚀 Getting Started (Local Setup)

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/Real-Homesquare.git
   cd Real-Homesquare
2. Setup the project in XAMPP/LAMP server

Place all folders (admin-panel, builder-panel, agent-panel, real) inside your server root (htdocs/ for XAMPP)

Create a MySQL database and import the provided .sql file (if available)

3. Configure database connection
In each panel's config.php or database connection file:

php
Copy
Edit
$host = 'localhost';
$dbname = 'your_db_name';
$username = 'root';
$password = '';
4. Access Locally

Admin Panel: http://localhost/admin-panel/

Builder Panel: http://localhost/builder-panel/

Agent Panel: http://localhost/agent-panel/

Website: http://localhost/real/


🧑‍💻 Author
Preetham K R

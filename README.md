# 🏠 Welcome to EasyColoc!

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)

Say goodbye to roommate money drama! **EasyColoc** is a smart, friendly, and comprehensive web application built to make shared living a breeze. From automatically splitting bills to building a solid roommate reputation, this project handles the heavy lifting so roommates can focus on actually enjoying their home.

## 📋 Table of Contents
- [✨ What makes EasyColoc awesome?](#-what-makes-easycoloc-awesome)
- [🧠 Under the Hood](#-under-the-hood-for-the-geeks)
- [💻 Tech Stack](#-tech-stack)
- [🚀 Quick Start Guide](#-quick-start-guide)
- [📸 How to Use It](#-how-to-use-it)
- [🤝 Let's Connect!](#-lets-connect)

---

## ✨ What makes EasyColoc awesome?

* 💸 **No More Math**: Add an expense, and the system automatically calculates exactly who owes what among active roommates.
* 📊 **Crystal Clear Dashboard**: Instantly see your financial standing with distinct "What I Owe" and "What I am Owed" sections.
* 🎮 **Gamified Reputation**: Good roommate? Get a `+1` reputation boost for leaving with zero debts! Left without paying? That's a `-1` penalty.
* 🛡️ **Fair & Secure Debt Transfer**: If someone leaves with unpaid bills, their debt is safely transferred to the Colocation Owner so the books always stay perfectly balanced.
* 👑 **Roles & Permissions**: Clean Role-Based Access Control (RBAC) separating Global Admins, Owners, and Regular Members.
* ✉️ **Magic Invites**: Invite new roommates securely straight from the dashboard via email tokens.

---

## 🧠 Under the Hood (For the Geeks!)

This isn't just a basic CRUD app. It's built with solid MVC architecture and object-oriented principles:
* **Bulletproof Transactions**: Money matters. Complex financial actions (like leaving a colocation and reassigning debt) are wrapped in `DB::transaction` blocks to guarantee absolute data integrity.
* **Smart Relational Data**: Utilizes Eloquent ORM for complex queries, keeping track of history (like filtering active members with `whereNull('left_at')`) instead of dangerously hard-deleting records.
* **Beautifully Responsive**: A sleek, fully responsive UI built with Tailwind CSS, ensuring a seamless experience on both desktop and mobile.

---

## 💻 Tech Stack

* **Backend**: PHP 8.x, Laravel
* **Frontend**: Blade Templating, Tailwind CSS
* **Database**: MySQL
* **Mail Testing**: Mailtrap (Sandbox SMTP)

---

## 🚀 Quick Start Guide

Want to run EasyColoc on your own machine? Follow these simple steps!

### Prerequisites
Make sure you have PHP (>= 8.1), Composer, Node.js, NPM, and MySQL installed.

### 1. Clone & Enter the Project
```bash
git clone [https://github.com/yassinmaftah/EasyColoc.git](https://github.com/yassinmaftah/EasyColoc.git)
cd EasyColoc


2. Install Dependencies
Get the backend and frontend packages ready:

composer install
npm install
npm run build

3. Setup the Environment
Copy the example environment file:

cp .env.example .env

Open the .env file and plug in your local database credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=easycoloc_db
DB_USERNAME=root
DB_PASSWORD=your_password

Configure Mailtrap for testing invitations:

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=ecb4f55f78ee9e
MAIL_PASSWORD=your_mailtrap_password

4. GLaunch!

php artisan serve

🎉 You're all set! Open http://localhost:8000 in your browser.

.

📸 How to Use It

Sign Up: Register as a new user.
Be the Boss: Create a new colocation (you automatically become the Owner).
Grow the House: Invite your roommates via the dashboard using their email addresses.
Log Expenses: Add shared expenses and watch the app calculate who owes what.
Settle Up: Use the "Mark as Paid" buttons when debts are cleared!


📄 License
Distributed under the MIT License. See LICENSE for more information.

🤝 Let's Connect!
Built with ❤️ by Yassine Maftah – Full-Stack Web Developer.

LinkedIn: https://www.linkedin.com/in/yassine-maftah-b5793933b/
GitHub: https://github.com/yassinmaftah

If you found this project helpful or interesting, please consider giving it a ⭐!

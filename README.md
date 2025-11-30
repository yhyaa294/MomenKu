# 🚀 MomenKu - Viral Micro-Website Builder

![MomenKu Banner](https://via.placeholder.com/1200x400?text=MomenKu+Dashboard+Preview)
> *Create unforgettable digital memories in seconds. No coding required.*

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel" />
  <img src="https://img.shields.io/badge/Livewire-3.x-4E56A6?style=for-the-badge&logo=livewire" />
  <img src="https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css" />
  <img src="https://img.shields.io/badge/Status-MVP_Ready-success?style=for-the-badge" />
</p>

## 📖 About The Project

**MomenKu** is a SaaS (Software as a Service) platform designed to solve a simple yet universal problem: **"Boring Greetings"**. Instead of sending a plain text "Happy Birthday" on WhatsApp, MomenKu allows users to generate stunning, interactive, and personalized micro-websites for their loved ones.

Built with a **Mobile-First** approach for Gen-Z users, featuring a high-conversion **Freemium Business Model**.

### ✨ Key Features
* **🎨 No-Code Page Builder:** Drag & drop interface to customize messages, photos, and music.
* **📱 Real-time Mobile Preview:** Desktop users get a live iPhone-frame preview while editing (Split-Screen Layout).
* **🎉 Interactive Themes:** Includes Confetti explosions, Dark Romantic mode, and Clean Minimal styles.
* **🔒 Freemium Mechanics:**
    * *Free:* Basic templates, limited photos, watermark.
    * *Premium:* Custom music upload, unlimited photos, password protection, permanent link.
* **💸 Payment Integration (Simulated):** Integrated flow for QRIS/E-Wallet payments (Tripay Logic).

## 🛠️ Tech Stack

* **Framework:** [Laravel 11](https://laravel.com)
* **Fullstack Interaction:** [Livewire 3](https://livewire.laravel.com) (SPA-like feel without complexity)
* **Styling:** [Tailwind CSS](https://tailwindcss.com) + Custom "Gen-Z" Aesthetic Config
* **Scripting:** Alpine.js (for lightweight interactions like music players)
* **Database:** MySQL

## 🚀 Getting Started

Follow these steps to run the project locally:

### Prerequisites
* PHP >= 8.2
* Composer
* Node.js & NPM

### Installation

1.  **Clone the repository**
    ```bash
    git clone [https://github.com/yhyaa294/MomenKu.git](https://github.com/yhyaa294/MomenKu.git)
    cd MomenKu
    ```

2.  **Install PHP Dependencies**
    ```bash
    composer install
    ```

3.  **Install Frontend Dependencies**
    ```bash
    npm install
    ```

4.  **Environment Setup**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Configure your database name (DB_DATABASE=momenku) in the .env file.*

5.  **Database Migration**
    ```bash
    php artisan migrate
    ```

6.  **Storage Link (Crucial for Images)**
    ```bash
    php artisan storage:link
    ```

7.  **Run the App**
    *Terminal 1 (Backend):*
    ```bash
    php artisan serve
    ```
    *Terminal 2 (Frontend Build):*
    ```bash
    npm run dev
    ```

## 📸 Screenshots

| Landing Page | Mobile Wizard | Premium Checkout |
|:---:|:---:|:---:|
| ![Landing](https://via.placeholder.com/300x200?text=Landing) | ![Mobile](https://via.placeholder.com/300x600?text=Mobile+View) | ![Checkout](https://via.placeholder.com/300x200?text=Premium+Flow) |

*(Note: Replace placeholders above with actual screenshots of your app)*

## 💡 Business Logic (Monetization)

The app uses a **Micro-Transaction model**:
1.  **Hook:** Users create a page for free.
2.  **Trigger:** When they upload >3 photos or want custom music, the system triggers a "Premium Alert".
3.  **Conversion:** A low-entry fee (e.g., IDR 10,000) encourages high volume sales via QRIS.

## 👤 Author

**Yahya**
* *AI Talent Hub Indonesia (Top 20)*
* *Fullstack Developer & Startup Enthusiast*

---
Made with ❤️ and Laravel in Indonesia.

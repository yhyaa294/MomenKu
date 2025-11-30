# MomenKu - Micro Website Builder

## Setup Instructions

Since the environment lacked PHP/Composer to run installation commands, you must perform the following steps to run the application:

1.  **Install Dependencies**:
    ```bash
    composer install
    npm install
    ```

2.  **Install Livewire**:
    ```bash
    composer require livewire/livewire
    ```

3.  **Setup Environment**:
    - Copy `.env.example` to `.env` if not done.
    - Set your database credentials in `.env`.

4.  **Run Migrations**:
    ```bash
    php artisan migrate
    ```

5.  **Link Storage**:
    ```bash
    php artisan storage:link
    ```

6.  **Authentication**:
    - The project expects Laravel Authentication. You may need to install a starter kit if not present:
      ```bash
      composer require laravel/breeze --dev
      php artisan breeze:install
      ```
    - *Note*: `routes/web.php` has `require __DIR__.'/auth.php';` commented out. Uncomment it after installing Breeze/Jetstream.

7.  **Run Server**:
    ```bash
    npm run dev
    php artisan serve
    ```

## Features Implemented

- **Database Schema**: Migrations for `pages`, `page_media`, `transactions`.
- **Models**: `Page`, `PageMedia`, `Transaction` with relationships.
- **Page Builder**: A multi-step Livewire component to create pages with photo uploads and theme selection.
- **Public Viewer**: A dynamic viewer (`/{slug}`) supporting themes (Confetti, Dark Romantic, Minimal) and music.
- **Payment Stub**: A simulated payment flow (`PaymentService` and `PaymentWebhookController`) to upgrade pages to Premium.

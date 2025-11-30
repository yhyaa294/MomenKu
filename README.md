<div align="center">
  <img src="public/images/logo-full.png" alt="MomenKu Logo" width="200"/>
  
  # 🎁 MomenKu
  
  ### *Bikin ucapan digital paling aesthetic buat doi/bestie!*
  
  [![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
  [![Livewire](https://img.shields.io/badge/Livewire-3-FB70A9?style=for-the-badge&logo=livewire&logoColor=white)](https://livewire.laravel.com)
  [![TailwindCSS](https://img.shields.io/badge/Tailwind-3-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
  [![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)
  
  [Demo](#-demo) • [Fitur](#-fitur) • [Instalasi](#-instalasi) • [Dokumentasi](#-dokumentasi)
  
  ---
</div>

## 📸 Preview

<div align="center">
  <table>
    <tr>
      <td align="center">
        <img src="https://via.placeholder.com/250x500/FF6B6B/FFFFFF?text=Landing+Page" alt="Landing Page" width="250"/>
        <br/>
        <b>Landing Page</b>
      </td>
      <td align="center">
        <img src="https://via.placeholder.com/250x500/FFA502/FFFFFF?text=Editor" alt="Editor" width="250"/>
        <br/>
        <b>Editor</b>
      </td>
      <td align="center">
        <img src="https://via.placeholder.com/250x500/6C5CE7/FFFFFF?text=Gift+Box" alt="Gift Box" width="250"/>
        <br/>
        <b>Gift Box Reveal</b>
      </td>
    </tr>
  </table>
</div>

---

## ✨ Fitur

<table>
  <tr>
    <td>🎨</td>
    <td><b>4 Color Themes</b></td>
    <td>Sunset, Ocean, Midnight, Candy</td>
  </tr>
  <tr>
    <td>🔤</td>
    <td><b>3 Font Styles</b></td>
    <td>Modern, Handwritten, Elegant</td>
  </tr>
  <tr>
    <td>📸</td>
    <td><b>3 Photo Layouts</b></td>
    <td>Carousel, Grid, Polaroid</td>
  </tr>
  <tr>
    <td>🎵</td>
    <td><b>Background Music</b></td>
    <td>Upload lagu favorit (Premium)</td>
  </tr>
  <tr>
    <td>🎉</td>
    <td><b>Confetti Effects</b></td>
    <td>Animasi saat membuka hadiah</td>
  </tr>
  <tr>
    <td>📦</td>
    <td><b>Gift Box Experience</b></td>
    <td>Tap untuk reveal pesan</td>
  </tr>
  <tr>
    <td>🔗</td>
    <td><b>Custom Links</b></td>
    <td>momenku.com/nama-kamu</td>
  </tr>
  <tr>
    <td>📱</td>
    <td><b>Mobile First</b></td>
    <td>Responsive di semua device</td>
  </tr>
</table>

---

## 🎯 User Flow

```
┌─────────────┐     ┌─────────────┐     ┌─────────────┐     ┌─────────────┐
│   Landing   │ ──▶ │   Editor    │ ──▶ │  Generate   │ ──▶ │   Share     │
│    Page     │     │  (3 Steps)  │     │    Link     │     │   Link      │
└─────────────┘     └─────────────┘     └─────────────┘     └──────┬──────┘
                                                                   │
                    ┌─────────────┐     ┌─────────────┐            │
                    │   Content   │ ◀── │  Gift Box   │ ◀──────────┘
                    │   Reveal    │     │    Tap!     │
                    └─────────────┘     └─────────────┘
```

---

## 🚀 Instalasi

### Prerequisites

| Requirement | Version |
|-------------|---------|
| PHP | 8.1+ |
| Composer | 2.0+ |
| Node.js | 18+ |
| Database | SQLite / MySQL |

### Quick Start

```bash
# 1. Clone repository
git clone https://github.com/yhyaa294/MomenKu.git
cd MomenKu

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies
npm install

# 4. Setup environment
cp .env.example .env
php artisan key:generate

# 5. Setup database (SQLite)
touch database/database.sqlite
php artisan migrate

# 6. Create storage link
php artisan storage:link

# 7. Build assets
npm run build

# 8. Start server
php artisan serve
```

> 🌐 Buka `http://localhost:8000` di browser

---

## 🎨 Customization

### Color Themes

| Theme | Preview | Gradient |
|-------|---------|----------|
| **Sunset** | 🌅 | `from-rose-400 via-orange-400 to-amber-400` |
| **Ocean** | 🌊 | `from-cyan-400 via-blue-500 to-indigo-600` |
| **Midnight** | 🌙 | `from-slate-900 via-purple-900 to-slate-800` |
| **Candy** | 🍬 | `from-pink-400 via-fuchsia-500 to-purple-600` |

### Font Styles

| Style | Font | Preview |
|-------|------|---------|
| **Modern** | Outfit | <span style="font-family: sans-serif">Aa Bb Cc</span> |
| **Handwritten** | Caveat | *Aa Bb Cc* |
| **Elegant** | Playfair Display | **Aa Bb Cc** |

### Photo Layouts

| Layout | Description |
|--------|-------------|
| 📱 **Carousel** | Horizontal swipe gallery |
| 🖼️ **Grid** | Pinterest-style masonry |
| 📷 **Polaroid** | Scattered vintage photos |

---

## 📁 Project Structure

```
momenku/
├── 📂 app/
│   ├── 📂 Http/Controllers/
│   │   └── PageController.php      # Show page logic
│   └── 📂 Livewire/
│       └── PageBuilder.php         # Main wizard component
│
├── 📂 resources/views/
│   ├── welcome.blade.php           # Landing page
│   ├── 📂 livewire/
│   │   └── page-builder.blade.php  # Editor UI
│   ├── 📂 pages/
│   │   └── show.blade.php          # Result page
│   └── 📂 components/layouts/
│       └── app.blade.php           # Main layout
│
├── 📂 public/images/               # Static assets
│   ├── logo-full.png
│   ├── empty-box.png
│   └── ...
│
├── 📂 routes/
│   └── web.php                     # Route definitions
│
└── 📂 database/migrations/         # DB schema
```

---

## 💎 Premium vs Free

| Feature | Free | Premium |
|---------|:----:|:-------:|
| Photo Upload | 3 max | ∞ Unlimited |
| Custom Music | ❌ | ✅ |
| Watermark | Yes | No |
| All Themes | ✅ | ✅ |
| All Fonts | ✅ | ✅ |
| All Layouts | ✅ | ✅ |

---

## 🛠️ Tech Stack

<div align="center">
  
| Layer | Technology |
|-------|------------|
| **Backend** | ![Laravel](https://img.shields.io/badge/Laravel_11-FF2D20?style=flat-square&logo=laravel&logoColor=white) |
| **Frontend** | ![Livewire](https://img.shields.io/badge/Livewire_3-FB70A9?style=flat-square&logo=livewire&logoColor=white) ![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=flat-square&logo=alpine.js&logoColor=black) |
| **Styling** | ![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white) |
| **Build** | ![Vite](https://img.shields.io/badge/Vite-646CFF?style=flat-square&logo=vite&logoColor=white) |
| **Database** | ![SQLite](https://img.shields.io/badge/SQLite-003B57?style=flat-square&logo=sqlite&logoColor=white) ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white) |

</div>

---

## 🚢 Deployment

### Option 1: Railway (Recommended)

[![Deploy on Railway](https://railway.app/button.svg)](https://railway.app/new)

### Option 2: Traditional Hosting

1. Upload semua file ke server
2. Point domain ke folder `/public`
3. Setup `.env` dengan database credentials
4. Run migrations: `php artisan migrate --force`

### Option 3: Docker

```bash
docker-compose up -d
```

---

## 🤝 Contributing

Contributions are welcome! 

1. Fork the repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📄 License

Distributed under the MIT License. See `LICENSE` for more information.

---

<div align="center">
  
  ### Made with 💝 by MomenKu Team
  
  ⭐ Star this repo if you find it useful!
  
  [Report Bug](https://github.com/yhyaa294/MomenKu/issues) • [Request Feature](https://github.com/yhyaa294/MomenKu/issues)
  
</div>

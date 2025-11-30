# 🎁 MomenKu

**Bikin ucapan digital paling aesthetic buat doi/bestie!**

MomenKu adalah platform untuk membuat kartu ucapan digital yang cantik dan interaktif. Kirim surprise ke orang tersayang dengan pengalaman "unboxing" yang unik!

![MomenKu Preview](public/images/logo-full.png)

---

## ✨ Fitur

- 🎨 **Customizable Themes** - Pilih warna gradient (Sunset, Ocean, Midnight, Candy)
- 🔤 **Multiple Fonts** - Modern, Handwritten, atau Elegant
- 📸 **Photo Layouts** - Carousel, Grid, atau Polaroid style
- 🎵 **Background Music** - Upload lagu favorit (Premium)
- 🎉 **Confetti Effects** - Animasi confetti saat membuka
- 📦 **Gift Box Experience** - Penerima harus "tap" kotak untuk reveal pesan
- 🔗 **Custom Links** - Buat link unik untuk setiap momen

---

## 🚀 Quick Start

### Prerequisites
- PHP 8.1+
- Composer
- Node.js 18+
- SQLite / MySQL

### Installation

```bash
# Clone repository
git clone https://github.com/yhyaa294/MomenKu.git
cd MomenKu

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
touch database/database.sqlite
php artisan migrate

# Build assets
npm run build

# Start server
php artisan serve
```

Buka `http://localhost:8000` di browser.

---

## 📱 User Flow

```
Landing Page → Create Page → Customize → Generate Link → Share
                                                           ↓
                              Recipient opens → Tap Gift Box → Reveal Content!
```

1. **Landing Page** (`/`) - Hero section dengan CTA
2. **Create** (`/create`) - Form wizard 3 langkah
3. **Result** (`/{slug}`) - Halaman hasil dengan gift box unboxing

---

## 🛠️ Tech Stack

- **Backend:** Laravel 11
- **Frontend:** Livewire 3, Alpine.js, Tailwind CSS
- **Database:** SQLite (dev) / MySQL (prod)
- **Build:** Vite

---

## 📁 Project Structure

```
momenku/
├── app/
│   ├── Livewire/
│   │   └── PageBuilder.php      # Main form component
│   └── Http/Controllers/
│       └── PageController.php   # Show page logic
├── resources/views/
│   ├── welcome.blade.php        # Landing page
│   ├── livewire/
│   │   └── page-builder.blade.php
│   └── pages/
│       └── show.blade.php       # Result page
├── public/images/               # Assets
└── routes/web.php               # Routes
```

---

## 🎨 Customization Options

### Color Themes
| Theme | Gradient |
|-------|----------|
| Sunset | Rose → Orange → Amber |
| Ocean | Cyan → Blue → Indigo |
| Midnight | Slate → Purple |
| Candy | Pink → Fuchsia → Purple |

### Font Styles
| Style | Font Family |
|-------|-------------|
| Modern | Outfit |
| Handwritten | Caveat |
| Elegant | Playfair Display |

### Photo Layouts
| Layout | Description |
|--------|-------------|
| Carousel | Horizontal swipe gallery |
| Grid | Pinterest-style masonry |
| Polaroid | Scattered photo effect |

---

## 💎 Premium Features

- Unlimited photo uploads (Free: max 3)
- Custom background music
- No watermark

---

## 🚢 Deployment

### Vercel (Serverless)
Project sudah dikonfigurasi untuk Vercel. Cukup connect repository dan deploy.

### Traditional Hosting
1. Upload semua file ke server
2. Point domain ke `/public`
3. Setup `.env` dengan database credentials
4. Run `php artisan migrate`

---

## 📄 License

MIT License - Free to use and modify!

---

## 🤝 Contributing

Pull requests welcome! Untuk perubahan besar, buka issue dulu untuk diskusi.

---

Made with 💝 by MomenKu Team

# 🎵 Radio Station Management System
## 📸 Screenshots

### Home Page
![Home Page](screenshots/home-page.png)
### Category View
![Category View](screenshots/category-view.png)
### Audio Player
![Audio Player](screenshots/audio-player.png)
### Audio List
![Audio List](screenshots/audio-list.png)

A simple and modern web application for managing online radio stations, built with Laravel. This system provides comprehensive audio management, dynamic playback features, and an intuitive admin interface.

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![PHP Version](https://img.shields.io/badge/PHP-8.2+-green.svg)
![Laravel Version](https://img.shields.io/badge/Laravel-12.x-red.svg)

## ✨ Features

### 🎧 Audio Management
- Upload and manage audio files with automatic duration calculation
- Organize audio content with categories
- Automatic audio duration calculation using getID3

## 🚀 Installation

1. Clone the repository:
```bash
git clone https://github.com/mabdusshakur/RadioStation.git
```

2. Install dependencies:
```bash
composer install
npm install
```

3. Configure environment:
```bash
cp .env.example .env
php artisan key:generate
```

4. Set up database:
```bash
php artisan migrate
php artisan db:seed
```

5. Link storage:
```bash
php artisan storage:link
```

## 🔧 Configuration

1. Configure your database in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

2. Configure file storage in `config/filesystems.php`
3. Set up audio processing options in `.env`

## 🏃‍♂️ Running the Application

1. Start the development server:
```bash
php artisan serve
```

2. Compile assets:
```bash
npm run dev
```
## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License.

## 👨‍💻 Author

**M. Abdus Shakur**
- GitHub: [@mabdusshakur](https://github.com/mabdusshakur)

## 🙏 Acknowledgments

- Laravel Team for the amazing framework
- All contributors who helped shape this project
- The open-source community for their invaluable tools

---
Made with ❤️ by [Shakur](https://github.com/mabdusshakur)

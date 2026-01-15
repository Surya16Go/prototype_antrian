# Contributing to Prototype Antrian

Terima kasih telah tertarik untuk berkontribusi ke project ini! 🎉

## 📋 Daftar Isi

- [Code of Conduct](#code-of-conduct)
- [Cara Berkontribusi](#cara-berkontribusi)
- [Development Setup](#development-setup)
- [Coding Standards](#coding-standards)
- [Commit Messages](#commit-messages)
- [Pull Request Process](#pull-request-process)

## Code of Conduct

Project ini mengadopsi [Contributor Covenant Code of Conduct](https://www.contributor-covenant.org/). Dengan berpartisipasi, Anda diharapkan untuk mematuhi kode etik ini.

## Cara Berkontribusi

### 🐛 Melaporkan Bug

1. Gunakan [GitHub Issues](../../issues) untuk melaporkan bug
2. Gunakan template **Bug Report** yang tersedia
3. Sertakan langkah reproduksi yang jelas
4. Sertakan screenshots jika memungkinkan

### 💡 Mengusulkan Fitur

1. Gunakan [GitHub Issues](../../issues) untuk mengusulkan fitur
2. Gunakan template **Feature Request** yang tersedia
3. Jelaskan use case dan manfaat fitur yang diusulkan

### 🔧 Kontribusi Kode

1. Fork repository ini
2. Buat branch baru dari `prototype`
3. Lakukan perubahan Anda
4. Submit Pull Request

## Development Setup

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js >= 16
- MySQL / PostgreSQL / SQLite

### Installation

```bash
# Clone repository
git clone https://github.com/YOUR_USERNAME/prototype_antrian.git
cd prototype_antrian

# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Build assets
npm run build

# Start development server
php artisan serve
```

### Running Tests

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage

# Run specific test file
php artisan test tests/Feature/ExampleTest.php
```

## Coding Standards

### PHP Style Guide

Project ini menggunakan [Laravel Pint](https://laravel.com/docs/pint) untuk code style. Pastikan kode Anda sesuai dengan style guide sebelum commit:

```bash
# Check code style
./vendor/bin/pint --test

# Fix code style
./vendor/bin/pint
```

### Naming Conventions

| Type | Convention | Example |
|------|------------|---------|
| Classes | PascalCase | `QueueController` |
| Methods | camelCase | `getLatestQueue()` |
| Variables | camelCase | `$queueNumber` |
| Constants | UPPER_SNAKE_CASE | `MAX_QUEUE_SIZE` |
| Database Tables | snake_case (plural) | `queue_items` |
| Database Columns | snake_case | `created_at` |

### File Structure

```
app/
├── Enums/           # Enum classes
├── Exceptions/      # Custom exceptions
├── Http/
│   ├── Controllers/ # HTTP controllers
│   ├── Middleware/  # HTTP middleware
│   └── Requests/    # Form requests
├── Models/          # Eloquent models
├── Services/        # Business logic services
└── Traits/          # Reusable traits
```

## Commit Messages

Kami menggunakan [Conventional Commits](https://www.conventionalcommits.org/) specification:

### Format

```
<type>(<scope>): <description>

[optional body]

[optional footer]
```

### Types

| Type | Description |
|------|-------------|
| `feat` | Fitur baru |
| `fix` | Bug fix |
| `docs` | Perubahan dokumentasi |
| `style` | Perubahan yang tidak mempengaruhi kode |
| `refactor` | Refactoring kode |
| `perf` | Peningkatan performa |
| `test` | Penambahan/perbaikan tests |
| `chore` | Maintenance tasks |

### Examples

```bash
feat(queue): add ability to skip queue number
fix(auth): resolve login session timeout
docs(readme): update installation instructions
refactor(controller): extract validation logic to request class
```

## Pull Request Process

1. **Branch Naming**: Gunakan format `type/short-description`
   - `feature/add-queue-export`
   - `fix/queue-number-overflow`
   - `docs/update-api-docs`

2. **Before Submitting**:
   - [ ] Pastikan semua tests lulus: `php artisan test`
   - [ ] Pastikan code style sesuai: `./vendor/bin/pint --test`
   - [ ] Update dokumentasi jika diperlukan

3. **PR Description**:
   - Isi template PR dengan lengkap
   - Link ke related issues
   - Tambahkan screenshots untuk perubahan UI

4. **Review Process**:
   - PR membutuhkan minimal 1 approval
   - CI checks harus lulus
   - Resolve semua review comments

## 🙏 Terima Kasih!

Kontribusi Anda sangat berarti untuk project ini. Jika ada pertanyaan, jangan ragu untuk membuka issue atau menghubungi maintainer.

---

Happy Coding! 🚀

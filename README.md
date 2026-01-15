# Prototype Antrian

Sistem antrian digital berbasis Laravel untuk manajemen antrian pelayanan.

## Requirements

- PHP >= 8.1
- Composer
- Node.js >= 16
- MySQL / PostgreSQL / SQLite

## Installation

```bash
# Clone repository
git clone <repository-url>
cd prototype_antrian

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate

# Build assets
npm run build

# Run server
php artisan serve
```

## API Endpoints

### Public (Pengunjung)

| Method | URL | Deskripsi |
|--------|-----|-----------|
| GET | `/queue` | Halaman ambil nomor antrian |
| POST | `/queue` | Submit nomor antrian baru |
| GET | `/queue/print` | Cetak struk antrian |
| GET | `/get-latest-queue` | Polling status antrian |

### Admin (Petugas)

| Method | URL | Deskripsi |
|--------|-----|-----------|
| GET | `/queues` | Dashboard antrian |
| GET | `/queues/{id}` | Proses antrian (ubah ke processing) |
| PUT | `/queues/{id}` | Selesaikan antrian (ubah ke completed) |

## Queue Status Flow

```
pending → processing → completed
                    → uncompleted
```

## Testing

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage
```

## Code Style

```bash
# Check code style
./vendor/bin/pint --test

# Fix code style
./vendor/bin/pint
```

## Project Structure

```
app/
├── Enums/
│   └── QueueStatus.php          # Status antrian (enum)
├── Http/
│   ├── Controllers/
│   │   ├── QueueController.php  # Public queue endpoints
│   │   └── AdminQueueController.php # Admin endpoints
│   └── Requests/
│       └── StoreQueueRequest.php # Validation rules
├── Models/
│   └── Queue.php                # Queue model dengan scopes
```

## License

MIT License

# Security Policy

## Supported Versions

Berikut adalah versi yang saat ini mendapat dukungan security updates:

| Version | Supported          |
| ------- | ------------------ |
| prototype (dev) | :white_check_mark: |

## Reporting a Vulnerability

Jika Anda menemukan kerentanan keamanan dalam project ini, **mohon jangan membuka issue publik**.

### Cara Melaporkan

1. **Email**: Kirim laporan ke [email maintainer yang aman]
2. **GitHub Security Advisories**: Gunakan fitur [Security Advisories](../../security/advisories/new) GitHub

### Informasi yang Diperlukan

Dalam laporan Anda, mohon sertakan:

- Deskripsi kerentanan
- Langkah-langkah untuk mereproduksi
- Dampak potensial
- Saran perbaikan (jika ada)

### Response Timeline

| Action | Timeline |
|--------|----------|
| Acknowledgment | 48 jam |
| Initial Assessment | 7 hari |
| Fix Development | 14-30 hari (tergantung severity) |
| Public Disclosure | Setelah fix dirilis |

### Severity Levels

| Level | Description | Response Time |
|-------|-------------|---------------|
| 🔴 Critical | RCE, SQL Injection, Auth Bypass | 24-48 jam |
| 🟠 High | XSS, CSRF, Sensitive Data Exposure | 7 hari |
| 🟡 Medium | Information Disclosure, DoS | 14 hari |
| 🟢 Low | Best Practice Violations | 30 hari |

## Security Best Practices

### Untuk Developers

1. **Dependencies**
   - Selalu update dependencies ke versi terbaru
   - Jalankan `composer audit` dan `npm audit` secara rutin
   - Review Dependabot alerts

2. **Environment Variables**
   - Jangan commit `.env` file
   - Gunakan secrets untuk data sensitif
   - Rotasi credentials secara berkala

3. **Input Validation**
   - Validasi semua input user
   - Gunakan Form Requests untuk validation
   - Sanitize output untuk mencegah XSS

4. **Authentication**
   - Gunakan Laravel Sanctum untuk API auth
   - Implementasi rate limiting
   - Log authentication attempts

### Untuk Users

1. Selalu gunakan versi terbaru
2. Konfigurasi firewall dengan benar
3. Gunakan HTTPS di production
4. Backup database secara rutin

## Acknowledgments

Kami berterima kasih kepada security researchers yang telah membantu meningkatkan keamanan project ini:

<!-- Daftar kontributor security akan ditambahkan di sini -->

---

Terima kasih telah membantu menjaga keamanan Prototype Antrian! 🔒

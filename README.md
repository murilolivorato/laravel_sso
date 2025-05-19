# Laravel SSO Server (Auth Provider)

This is the **SSO (Single Sign-On) Server** for Laravel applications. It manages user authentication and securely issues tokens for connected client applications.

📖 [Step-by-step tutorial on Medium](https://medium.com/@murilolivorato/implementing-single-sign-on-sso-with-laravel-step-by-step-c8cdf093b78a)

---

## 🚀 Setup

### 1. Clone the repo

```bash
git clone https://github.com/yourusername/sso-server.git
cd sso-server
```

### 2. Install dependencies

```bash
composer install
```

### 3. Set up environment

Copy `.env.example` and configure:

```bash
cp .env.example .env
php artisan key:generate
```

Update the `.env` file with your database and encryption key:

```env
APP_URL=http://sso-server.test
DB_DATABASE=sso
DB_USERNAME=root
DB_PASSWORD=

SSO_ENCRYPTION_KEY=base64:YourGeneratedKeyHere
```

### 4. Run migrations

```bash
php artisan migrate --seed
```

---

## 📌 How it Works

- Provides login and logout endpoints
- Issues encrypted tokens to client apps
- Client apps call a `/user` endpoint with the token to retrieve user data

---

## 📂 Key Endpoints

- `GET /login`: Login page
- `POST /login`: Handles login
- `GET /logout`: Logs out user
- `POST /sso/token`: Returns user data based on encrypted token

---

## 🛡 Security

- Tokens are encrypted using Laravel’s Crypt
- Always use HTTPS in production
- The encryption key must match across all apps

---

## 👨‍💻 Author

**Murilo Livorato**  
🔗 [Medium Article](https://medium.com/@murilolivorato/implementing-single-sign-on-sso-with-laravel-step-by-step-c8cdf093b78a)

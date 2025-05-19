# Laravel SSO Server (Auth Provider)

This is the **SSO (Single Sign-On) Server** for Laravel applications. It manages user authentication and securely issues tokens for connected client applications.

📖 [Step-by-step tutorial on Medium](https://medium.com/@murilolivorato/implementing-single-sign-on-sso-with-laravel-step-by-step-c8cdf093b78a)

<p align="center">
<img src="https://miro.medium.com/v2/resize:fit:700/1*kFA_UNGQ2kEliPHGHVw7CQ.png" alt="Login Page" />
</p>

Laravel provides solutions for SSO (Single Sign-On) authentication with Laravel Passport , enabling users to access multiple applications with a single set of credentials, making it easy to implement a robust and secure SSO solution.

I shared my solution at this code .

## What I did 

I created 2 Laravel projects and I used Laravel Passport for OAuth2 authorization .

The Auth project — is responsible to allows and centralize those users .
The Supervisor project — it is the backend for the adminstrator area for supervisor users .

<p align="center">
<img src="https://miro.medium.com/v2/resize:fit:674/1*NBrj-Uh_RVEiTtphwxNd5w.png" alt="Login Page" />
</p>


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
🔗 [Medium Article](https://medium.com/@murilolivorato/implementing-single-sign-on-sso-with-laravel-step-by-step-c8cdf093b78)



## 📸 Screenshots

### Login Page
![Login Page](https://miro.medium.com/v2/resize:fit:700/1*_wY6UPR2uUZ0hZcwlVEvjQ.png)

### Admin Area
![Admin Area](https://miro.medium.com/v2/resize:fit:700/1*x5TXkOMByszt5MH90OgqAA.png)

### Access Area
![Access Area](https://miro.medium.com/v2/resize:fit:700/1*XcGOi7oKoFVUUWXGtSAFXg.png)



<div align="center">
  <h3>⭐ Star This Repository ⭐</h3>
  <p>Your support helps us improve and maintain this project!</p>
  <a href="https://github.com/murilolivorato/laravel_sso/stargazers">
    <img src="https://img.shields.io/github/stars/murilolivorato/laravel_sso?style=social" alt="GitHub Stars">
  </a>
</div>




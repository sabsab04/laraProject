<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<title>UniFun - Registrati</title>
<style>
body { background-color: #1a1a1a; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
.register-container { display: flex; width: 850px; height: 600px; border-radius: 12px; overflow: hidden; }
.register-left { background-color: #7b2d3e; background-image: radial-gradient(ellipse at 30% 50%, #5a1e2e 0%, transparent 60%), radial-gradient(ellipse at 70% 20%, #9b3d52 0%, transparent 50%); width: 45%; display: flex; align-items: center; justify-content: center; }
.register-left h1 { color: white; font-size: 80px; font-weight: 900; line-height: 1; text-align: center; }
.register-right { background-color: #fdf0f0; width: 55%; padding: 50px 40px; display: flex; flex-direction: column; justify-content: center; }
.register-right h2 { font-size: 32px; font-weight: 900; margin-bottom: 20px; }
.form-card { background: white; border-radius: 12px; padding: 25px; }
.form-group { margin-bottom: 15px; }
.form-group label { display: block; color: #7b2d3e; margin-bottom: 6px; }
.form-group input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; box-sizing: border-box; }
.btn-register { width: 100%; padding: 14px; background-color: #7b2d3e; color: white; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; margin-top: 5px; }
.login-link { text-align: center; margin-top: 15px; }
.login-link a { color: #7b2d3e; text-decoration: underline; }
.error-message { color: red; font-size: 13px; margin-bottom: 10px; }
</style>
</head>
<body>
<div class="register-container">
<div class="register-left">
<h1>BEN<br>VE<br>NUTO</h1>
</div>
<div class="register-right">
<h2>Registrati</h2>
@if ($errors->any())
<div class="error-message">{{ $errors->first() }}</div>
@endif
<div class="form-card">
<form method="POST" action="/register">
@csrf
<div class="form-group">
<label>Nome</label>
<input type="text" name="name" placeholder="Enter your name" required>
</div>
<div class="form-group">
<label>Cognome</label>
<input type="text" name="surname" placeholder="Enter your surname" required>
</div>
<div class="form-group">
<label>Email</label>
<input type="email" name="email" placeholder="Enter your email" required>
</div>
<div class="form-group">
<label>Password</label>
<input type="password" name="password" placeholder="Enter your password" required>
</div>
<button type="submit" class="btn-register">Registrati</button>
</form>
<div class="login-link">
<a href="/login">Hai già un account? Log in</a>
</div>
</div>
</div>
</div>
</body>
</html>
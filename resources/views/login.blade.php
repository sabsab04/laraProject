<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<title>UniFun - Accedi</title>
<style>
body { background-color: #1a1a1a; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
.login-container { display: flex; width: 850px; height: 500px; border-radius: 12px; overflow: hidden; }
.login-left { background-color: #7b2d3e; width: 45%; display: flex; align-items: center; justify-content: center; }
.login-left h1 { color: white; font-size: 80px; font-weight: 900; line-height: 1; text-align: center; }
.login-right { background-color: #fdf0f0; width: 55%; padding: 50px 40px; display: flex; flex-direction: column; justify-content: center; }
.login-right h2 { font-size: 32px; font-weight: 900; margin-bottom: 30px; }
.form-group { margin-bottom: 20px; }
.form-group label { display: block; color: #7b2d3e; margin-bottom: 6px; }
.form-group input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; box-sizing: border-box; }
.btn-login { width: 100%; padding: 14px; background-color: #7b2d3e; color: white; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; }
.register-link { text-align: center; margin-top: 15px; }
.register-link a { color: #7b2d3e; text-decoration: underline; }
.error-message { color:red; font-size: 13px; margin-bottom: 10px; }
</style>
</head>
<body>
<div class="login-container">
<div class="login-left">
<h1>BEN<br>VE<br>NUTO</h1>
</div>
<div class="login-right">
<h2>Accedi</h2>
@if ($errors->any())
<div class="error-message">{{ $errors->first('username') }}</div>
@endif
<form method="POST" action="/login">
@csrf
<div class="form-group">
<label>Nome utente</label>
<input type="text" name="username" required>
</div>
<div class="form-group">
<label>Password</label>
<input type="password" name="password" required>
</div>
<button type="submit" class="btn-login">Accedi</button>
</form>
<div class="register-link">
<a href="/register">Non hai un account? Registrati</a>
</div>
</div>
</div>
</body>
</html>
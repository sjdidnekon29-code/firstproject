<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register Page</title>

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family: 'Segoe UI', sans-serif;
}

/* 🌈 BACKGROUND ANIMATION */
body{
  min-height:100vh;
  display:flex;
  justify-content:center;
  align-items:center;
  background: linear-gradient(-45deg, #0f172a, #111827, #1e293b, #0b1220);
  background-size:400% 400%;
  animation: bg 10s ease infinite;
  overflow:hidden;
}

@keyframes bg{
  0%{background-position:0% 50%}
  50%{background-position:100% 50%}
  100%{background-position:0% 50%}
}

/* FLOATING GLOW */
body::before,
body::after{
  content:"";
  position:absolute;
  width:300px;
  height:300px;
  border-radius:50%;
  filter: blur(90px);
  opacity:0.4;
  z-index:-1;
  animation: float 8s infinite alternate;
}

body::before{
  background:#6366f1;
  top:10%;
  left:10%;
}

body::after{
  background:#22c55e;
  bottom:10%;
  right:10%;
  animation-delay:2s;
}

@keyframes float{
  from{transform:translateY(0px) scale(1);}
  to{transform:translateY(-40px) scale(1.2);}
}

/* CONTAINER */
.login-container{
  width:360px;
  padding:30px;
  border-radius:20px;
  background: rgba(255,255,255,0.06);
  backdrop-filter: blur(12px);
  border:1px solid rgba(255,255,255,0.1);
  box-shadow:0 20px 60px rgba(0,0,0,0.5);

  animation: fadeIn 1s ease;
}

@keyframes fadeIn{
  from{opacity:0; transform:translateY(30px) scale(0.9);}
  to{opacity:1; transform:translateY(0) scale(1);}
}

h2{
  text-align:center;
  color:#fff;
  margin-bottom:20px;
  font-size:28px;
}

/* FORM */
.form-group{
  margin-bottom:15px;
}

label{
  display:block;
  margin-bottom:6px;
  color:#94a3b8;
  font-size:14px;
}

input{
  width:100%;
  padding:12px;
  border-radius:10px;
  border:1px solid rgba(255,255,255,0.1);
  outline:none;
  background: rgba(255,255,255,0.05);
  color:#fff;
  transition:0.3s;
}

input:focus{
  border-color:#6366f1;
  box-shadow:0 0 10px rgba(99,102,241,0.4);
  transform:scale(1.02);
}

/* BUTTON */
button{
  width:100%;
  padding:12px;
  margin-top:10px;
  border:none;
  border-radius:10px;
  background: linear-gradient(90deg,#6366f1,#8b5cf6);
  color:#fff;
  font-size:16px;
  font-weight:bold;
  cursor:pointer;
  transition:0.3s;
}

button:hover{
  transform:scale(1.05);
  box-shadow:0 10px 25px rgba(99,102,241,0.5);
}

button:active{
  transform:scale(0.98);
}

/* LINK */
a{
  display:block;
  text-align:center;
  margin-top:15px;
  color:#94a3b8;
  text-decoration:none;
}

a:hover{
  color:#fff;
}

/* ERROR FEEDBACK */
input:invalid{
  border-color:#f59e0b;
}
</style>
</head>

<body>

<div class="login-container">
  <h2>Register</h2>

  <form action="{{ route('registers') }}" method="POST">
    @csrf

    <div class="form-group">
      <label>Name:</label>
      <input type="text" name="name" required>
    </div>

    <div class="form-group">
      <label>Email:</label>
      <input type="email" name="email" required>
    </div>

    <div class="form-group">
      <label>Password:</label>
      <input type="password" id="password" name="password" required>
    </div>

    <div class="form-group">
      <label>Confirm Password:</label>
      <input type="password" id="password_confirmation" name="password_confirmation" required>
    </div>

    <button type="submit">Register</button>
  </form>

  <a href="{{ route('login') }}">Switch to Login</a>
</div>

<script>
const password = document.getElementById('password');
const confirmPassword = document.getElementById('password_confirmation');

confirmPassword.addEventListener('input', function () {
  if (password.value !== confirmPassword.value) {
    confirmPassword.setCustomValidity("Passwords do not match");
  } else {
    confirmPassword.setCustomValidity('');
  }
});
</script>

</body>
</html>
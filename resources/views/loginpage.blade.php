<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>

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
  animation: bgMove 10s ease infinite;
  overflow:hidden;
}

@keyframes bgMove{
  0%{background-position:0% 50%}
  50%{background-position:100% 50%}
  100%{background-position:0% 50%}
}

/* 🔵 FLOATING GLOW ORBS */
body::before,
body::after{
  content:"";
  position:absolute;
  width:320px;
  height:320px;
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

/* LOGIN CONTAINER */
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

/* DEMO TEXT */
.login-container p{
  text-align:center;
  color:#94a3b8;
  font-size:13px;
  margin-bottom:10px;
}

/* TITLE */
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

/* INPUT STYLE */
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

/* LINKS */
a{
  display:block;
  text-align:center;
  margin-top:12px;
  color:#94a3b8;
  text-decoration:none;
  transition:0.3s;
}

a:hover{
  color:#fff;
  transform:scale(1.05);
}
</style>

</head>

<body>

<div class="login-container">

  <p>teacher@email.com</p>
  <p>student@email.com</p>
  <h2>Login</h2>

  <form action="{{ route('logins') }}" method="POST">
    @csrf

    <div class="form-group">
      <label>Email:</label>
      <input type="email" id="email" name="email" required>
    </div>

    <div class="form-group">
      <label>Password:</label>
      <input type="password" id="password" name="password" required>
    </div>

    <button type="submit">Login</button>
  </form>

  <a href="{{ route('register') }}">Switch to Register</a>
  {{-- <a href="{{ route('studentdashboard') }}">Back to Student Dashboard</a> --}}

</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Classes</title>

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:Arial, Helvetica, sans-serif;
}

body{
  min-height:100vh;
  display:flex;
  background:linear-gradient(-45deg,#0f172a,#111827,#1e293b,#0b1220);
  background-size:400% 400%;
  animation:bgMove 10s ease infinite;
  color:#e2e8f0;
}

/* BACKGROUND ANIMATION */
@keyframes bgMove{
  0%{background-position:0% 50%}
  50%{background-position:100% 50%}
  100%{background-position:0% 50%}
}

/* GLOW EFFECT */
body::before,
body::after{
  content:"";
  position:fixed;
  width:300px;
  height:300px;
  border-radius:50%;
  filter:blur(80px);
  z-index:-1;
  opacity:0.4;
}

body::before{
  background:#6366f1;
  top:10%;
  left:10%;
}

body::after{
  background:#f59e0b;
  bottom:10%;
  right:10%;
}

/* SIDEBAR (same as first page) */
.sidebar{
  width:260px;
  min-height:100vh;
  background:rgba(15,23,42,0.9);
  backdrop-filter:blur(10px);
  padding:25px 20px;
  box-shadow:10px 0 30px rgba(0,0,0,0.4);
  position:sticky;
  top:0;
}

.logo{
  font-size:24px;
  font-weight:bold;
  text-align:center;
  margin-bottom:40px;
  color:#fff;
}

.menu{
  list-style:none;
}

.menu li{
  margin:14px 0;
}

.menu a{
  display:block;
  text-decoration:none;
  padding:12px 15px;
  border-radius:12px;
  color:#94a3b8;
  transition:0.3s ease;
}

.menu a:hover{
  background:rgba(99,102,241,0.15);
  color:#fff;
  transform:translateX(5px);
}

.menu .active{
  background:linear-gradient(90deg,#6366f1,#8b5cf6);
  color:#fff;
}

/* MAIN */
.main{
  flex:1;
  padding:30px;
}

/* CLASS CARD */
.class-container{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
  gap:20px;
}

.class-card{
  background:rgba(255,255,255,0.06);
  border:1px solid rgba(255,255,255,0.1);
  border-radius:16px;
  padding:20px;
  backdrop-filter:blur(12px);
  transition:0.3s ease;
}

.class-card:hover{
  transform:translateY(-6px);
  box-shadow:0 20px 40px rgba(0,0,0,0.4);
}

.class-card p{
  font-size:18px;
  margin-bottom:10px;
}

.class-card a{
  display:inline-block;
  text-decoration:none;
  color:#fff;
  background:linear-gradient(90deg,#6366f1,#8b5cf6);
  padding:8px 12px;
  border-radius:10px;
  font-size:14px;
}

/* MOBILE */
@media(max-width:768px){
  body{
    flex-direction:column;
  }

  .sidebar{
    width:100%;
    min-height:auto;
  }

  .main{
    padding:15px;
  }
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

  <div class="logo">🎓 Student Panel</div>

  <ul class="menu">

    <li>
      <a href="{{ route('studentdashboard') }}">Dashboard</a>
    </li>

    <li>
      <a href="{{ route('student.class', Auth::id()) }}" >Classes</a>
    </li>

    <li>
      <a href="{{ route('student.class_', Auth::id()) }}" class="active">Attendance</a>
    </li>

    <li>
      <a href="{{ route('assignments.student', Auth::id()) }}">Assignments</a>
    </li>

    <li>
      <a href="{{ route('messages.student', Auth::id()) }}">Messages</a>
    </li>

   <li><a href="{{ route('login') }}" >
        Logout
      </a></li>

  </ul>

</div>

<!-- MAIN -->
<div class="main">

  <h1 style="margin-bottom:20px;">My Classes</h1>

  <div class="class-container">

    @foreach ($classes as $item)
      <div class="class-card">
        <p>{{ $item->class_name }}</p>

        <a href="{{ route('attendance.student', $item->id) }}">
          Attendance
        </a>
      </div>
    @endforeach

  </div>

</div>

</body>
</html>
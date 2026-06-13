<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Class Details</title>

<style>

/* ================= ROOT ================= */
:root{
  --primary:#6366f1;
  --text:#e5e7eb;
  --muted:#94a3b8;
  --border:rgba(255,255,255,0.08);
  --card:rgba(255,255,255,0.06);
}

/* ================= RESET ================= */
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:Arial, sans-serif;
}

/* ================= BODY ================= */
body{
  min-height:100vh;
  display:flex;

  background:linear-gradient(-45deg,#0f172a,#111827,#1e293b,#0b1220);
  background-size:400% 400%;
  animation:bgMove 10s ease infinite;

  color:var(--text);
}

/* background animation */
@keyframes bgMove{
  0%{background-position:0% 50%}
  50%{background-position:100% 50%}
  100%{background-position:0% 50%}
}

/* glow orbs */
body::before,
body::after{
  content:"";
  position:fixed;
  width:280px;
  height:280px;
  border-radius:50%;
  filter:blur(90px);
  opacity:0.3;
  z-index:-1;
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
}

/* ================= SIDEBAR ================= */
.sidebar{
  width:260px;
  min-width:260px;
  height:100vh;
  position:sticky;
  top:0;

  background:rgba(15,23,42,0.92);
  backdrop-filter:blur(12px);
  border-right:1px solid var(--border);

  padding:25px 18px;
}

.logo{
  font-size:22px;
  font-weight:800;
  margin-bottom:35px;
}

.menu{
  list-style:none;
}

.menu li{
  margin:10px 0;
}

.menu a{
  display:block;
  padding:12px 14px;
  border-radius:12px;
  text-decoration:none;
  color:var(--muted);
  transition:0.25s;
}

.menu a:hover{
  background:rgba(99,102,241,0.12);
  color:#fff;
  transform:translateX(6px);
}

.menu a.active{
  background:linear-gradient(90deg,#6366f1,#8b5cf6);
  color:#fff;
  transform:translateX(6px);
}

/* ================= MAIN ================= */
.main{
  flex:1;
  padding:30px;
}

/* ================= CONTAINER ================= */
.container{
  max-width:800px;
  margin:auto;

  background:var(--card);
  border:1px solid var(--border);
  border-radius:18px;
  padding:25px;

  backdrop-filter:blur(12px);
  animation:fadeIn 0.8s ease;
}

@keyframes fadeIn{
  from{opacity:0; transform:translateY(20px);}
  to{opacity:1; transform:translateY(0);}
}

/* back link */
.back-link{
  display:inline-block;
  margin-bottom:15px;
  color:var(--muted);
  text-decoration:none;
  transition:0.3s;
}

.back-link:hover{
  color:#fff;
}

/* title */
h2{
  text-align:center;
  margin-bottom:20px;
  font-size:26px;
}

/* class box */
.class-box{
  margin-top:15px;
  padding:18px;

  background:rgba(255,255,255,0.04);
  border:1px solid var(--border);
  border-radius:14px;

  display:flex;
  justify-content:space-between;
  align-items:center;

  transition:0.3s;
}

.class-box:hover{
  transform:translateY(-5px);
  background:rgba(99,102,241,0.08);
}

.class-box h3{
  font-size:18px;
}

/* button */
.btn{
  padding:10px 14px;
  border-radius:10px;

  text-decoration:none;
  font-size:13px;
  font-weight:bold;

  background:linear-gradient(90deg,#6366f1,#8b5cf6);
  color:white;

  transition:0.3s;
}

.btn:hover{
  transform:scale(1.05);
}

/* empty */
.empty{
  text-align:center;
  margin-top:20px;
  color:#f87171;
}

/* ================= MOBILE ================= */
@media(max-width:768px){
  body{
    flex-direction:column;
  }

  .sidebar{
    width:100%;
    height:auto;
    position:relative;
  }

  .main{
    padding:15px;
  }

  .class-box{
    flex-direction:column;
    gap:10px;
    text-align:center;
  }
}

</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

  <div class="logo">🎓 Teacher Panel</div>

  <ul class="menu">
    <li><a href="{{ route('teacherdashboard') }}">Dashboard</a></li>
     <li><a href="{{ route('viewclass') }}">Classes</a></li>
    <li><a href="{{ route('attendance.nameofclass', Auth::id()) }}">Attendance</a></li>
    <li><a href="{{ route('assignments.nameclass', Auth::id()) }}" class="active">Assignments</a></li>
    <li><a href="{{ route('submissions.view') }}">Messages</a></li>
    <li><a href="{{ route('login') }}" >
        Logout
      </a></li>
  </ul>

</div>

<!-- MAIN -->
<div class="main">

  <div class="container">

    <a class="back-link" href="{{ route('teacherdashboard') }}">
      ← Back to Dashboard
    </a>

    <h2>Class Details</h2>

    @if($classes->count() > 0)

        @foreach($classes as $class)

            <div class="class-box">

                <h3>{{ $class->class_name }}</h3>

                <a class="btn" href="{{ route('assignments.create', $class->id) }}">
                    Add Assignment
                </a>

            </div>

        @endforeach

    @else

        <div class="empty">
            No class found
        </div>

    @endif

  </div>

</div>

</body>
</html>
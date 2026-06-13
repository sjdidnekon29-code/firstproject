<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Class</title>

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

/* GLOW */
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

/* SIDEBAR (copied from dashboard) */
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

/* CARD CONTAINER */
.card{
  background:rgba(255,255,255,0.06);
  border:1px solid rgba(255,255,255,0.1);
  border-radius:18px;
  padding:25px;
  backdrop-filter:blur(12px);
  max-width:500px;
}

/* FORM */
input{
  width:100%;
  padding:12px;
  border-radius:10px;
  border:1px solid rgba(255,255,255,0.2);
  background:rgba(255,255,255,0.05);
  color:#fff;
  margin-top:10px;
}

button{
  margin-top:15px;
  padding:12px 18px;
  border:none;
  border-radius:10px;
  background:linear-gradient(90deg,#6366f1,#8b5cf6);
  color:#fff;
  font-weight:bold;
  cursor:pointer;
  transition:0.3s;
}

button:hover{
  transform:translateY(-2px);
}

/* CLASS LIST */
.class-list{
  margin-top:30px;
}

.class-item{
  margin-top:10px;
  padding:15px;
  border-radius:12px;
  background:rgba(255,255,255,0.05);
  border:1px solid rgba(255,255,255,0.1);
  display:flex;
  justify-content:space-between;
  align-items:center;
}

.class-item a{
  color:#6366f1;
  text-decoration:none;
  font-weight:bold;
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
      <a href="{{ route('student.class', Auth::id()) }}" class="active">Classes</a>
    </li>

    <li>
      <a href="{{ route('student.class_', Auth::id()) }}">Attendance</a>
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

  <!-- CREATE CLASS CARD -->
  <div class="card">

    <h2>Create / Join Class</h2>

    <!-- ERRORS -->
    @if ($errors->any())
      <div style="color:red; margin-top:10px;">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- SUCCESS -->
    @if (session('success'))
      <div style="color:#22c55e; margin-top:10px;">
        {{ session('success') }}
      </div>
    @endif

    <!-- FORM -->
    <form action="{{ route('Permissionclass') }}" method="POST">
      @csrf

      <input type="text" name="name" placeholder="Enter class code or name" required>

      @error('class_name')
        <div style="color:red;">
          {{ $message }}
        </div>
      @enderror

      <button type="submit">Join</button>
    </form>

  </div>

  <!-- CLASS LIST -->
  <div class="class-list">

    <h2 style="margin-top:30px;">Your Classes</h2>

    @foreach ($class as $item)
      <div class="class-item">
        <span>{{ $item->class_name }}</span>
        <a href="{{ route('subjects.class', $item->id) }}">View Class</a>
      </div>
    @endforeach

  </div>

</div>

</body>
</html>
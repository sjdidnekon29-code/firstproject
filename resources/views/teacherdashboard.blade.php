<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Teacher Dashboard</title>

<style>
:root{
  --primary:#6366f1;
  --bg1:#0f172a;
  --bg2:#111827;
  --text:#e5e7eb;
  --muted:#94a3b8;
  --border:rgba(255,255,255,0.08);
  --card:rgba(255,255,255,0.06);
}

*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Inter',sans-serif;
}

body{
  min-height:100vh;
  display:flex;
  background:linear-gradient(-45deg,#0f172a,#111827,#1e293b,#0b1220);
  background-size:400% 400%;
  animation:bgMove 10s ease infinite;
  color:var(--text);
  overflow-x:hidden;
}

@keyframes bgMove{
  0%{background-position:0% 50%}
  50%{background-position:100% 50%}
  100%{background-position:0% 50%}
}

/* glow effect */
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

/* SIDEBAR */
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
  box-shadow:0 10px 25px rgba(99,102,241,0.25);
}

/* MAIN */
.main{
  flex:1;
  padding:30px;
}

/* TOPBAR */
.topbar{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:25px;
}

.topbar h1{
  font-size:28px;
  font-weight:800;
}

.profile{
  display:flex;
  align-items:center;
  gap:15px;
  padding:10px 16px;
  border-radius:50px;
  background:rgba(255,255,255,0.06);
  border:1px solid var(--border);
}

.profile a{
  color:#fff;
  text-decoration:none;
  font-weight:500;
}

/* CARDS */
.cards{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
  gap:20px;
  margin-bottom:30px;
}

.card{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:18px;
  padding:20px;
  backdrop-filter:blur(12px);
  transition:0.3s;
}

.card:hover{
  transform:translateY(-6px);
}

.card h2{
  font-size:14px;
  color:var(--muted);
  margin-bottom:10px;
}

.card p{
  font-size:26px;
  font-weight:800;
}

/* TABLE */
.table-section{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:18px;
  padding:20px;
  backdrop-filter:blur(12px);
}

.table-section h2{
  margin-bottom:15px;
  font-size:18px;
}

table{
  width:100%;
  border-collapse:collapse;
}

th, td{
  padding:12px;
  text-align:left;
  border-bottom:1px solid var(--border);
  color:var(--text);
}

th{
  color:var(--muted);
  font-size:13px;
}

.status{
  padding:4px 10px;
  border-radius:20px;
  font-size:12px;
}

.completed{
  background:rgba(34,197,94,0.15);
  color:#22c55e;
}

.pending{
  background:rgba(245,158,11,0.15);
  color:#f59e0b;
}

/* MOBILE */
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
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

  <div class="logo">🎓 Teacher Panel</div>

  <ul class="menu">
    <li><a href="#" class="active">Dashboard</a></li>
    <li><a href="{{ route('viewclass') }}">Classes</a></li>
    

    <li>
      <a href="{{ route('attendance.nameofclass', Auth::id()) }}">
        Attendance
      </a>
    </li>

    <li>
      <a href="{{ route('assignments.nameclass', Auth::id()) }}">
        Assignments
      </a>
    </li>

    <li>
      <a href="{{ route('submissions.view') }}">
        Messages
      </a>
    </li>

    <li><a href="{{ route('login') }}" >
        Logout
      </a></li>
  </ul>

</div>

<!-- MAIN -->
<div class="main">

  <!-- TOPBAR -->
  <div class="topbar">

    <h1>Teacher Dashboard</h1>

    <div class="profile">

      <a href="{{ route('profile.teacher') }}">
        Profile
      </a>

      <span>
        {{ Auth::user()->name }}
      </span>

    </div>

  </div>

  <!-- CARDS -->
  <div class="cards">

    <div class="card">
      <h2>Total Courses</h2>
      <p>8</p>
    </div>

    <div class="card">
      <h2>Assignments</h2>
      <p>12</p>
    </div>

    <div class="card">
      <h2>Completed</h2>
      <p>5</p>
    </div>

    <div class="card">
      <h2>Attendance</h2>
      <p>92%</p>
    </div>

  </div>

  <!-- TABLE -->
  <div class="table-section">

    <h2>Recent Assignments</h2>

    <table>

      <thead>
        <tr>
          <th>Subject</th>
          <th>Assignment</th>
          <th>Due Date</th>
          <th>Status</th>
        </tr>
      </thead>

      <tbody>

        <tr>
          <td>Mathematics</td>
          <td>Algebra Worksheet</td>
          <td>May 20</td>
          <td>
            <span class="status completed">
              Completed
            </span>
          </td>
        </tr>

        <tr>
          <td>Science</td>
          <td>Physics Project</td>
          <td>May 25</td>
          <td>
            <span class="status pending">
              Pending
            </span>
          </td>
        </tr>

      </tbody>

    </table>

  </div>

</div>

</body>
</html>
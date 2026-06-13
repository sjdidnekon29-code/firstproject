<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Dashboard</title>

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
  overflow-x:hidden;
}

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

/* SIDEBAR */

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
  width:100%;
  padding:30px;
}

/* TOPBAR */

.topbar{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:30px;
  flex-wrap:wrap;
  gap:15px;
}

.topbar h1{
  font-size:30px;
  font-weight:bold;
}

/* PROFILE */

.profile{
  display:flex;
  align-items:center;
  gap:12px;
  padding:10px 16px;
  background:rgba(255,255,255,0.06);
  border-radius:50px;
  border:1px solid rgba(255,255,255,0.1);
  backdrop-filter:blur(10px);
}

.profile a{
  text-decoration:none;
  color:#fff;
  font-weight:600;
}

.profile span{
  color:#cbd5e1;
}

/* CARDS */

.cards{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
  gap:20px;
  margin-bottom:30px;
}

.card{
  background:rgba(255,255,255,0.06);
  border:1px solid rgba(255,255,255,0.1);
  border-radius:18px;
  padding:25px;
  backdrop-filter:blur(12px);
  transition:0.4s ease;
}

.card:hover{
  transform:translateY(-8px);
  box-shadow:0 20px 40px rgba(0,0,0,0.4);
}

.card h2{
  font-size:15px;
  color:#94a3b8;
  margin-bottom:10px;
}

.card p{
  font-size:34px;
  font-weight:bold;
  color:#fff;
}

/* TABLE */

.table-section{
  background:rgba(255,255,255,0.05);
  border:1px solid rgba(255,255,255,0.1);
  border-radius:18px;
  padding:25px;
  overflow-x:auto;
}

.table-section h2{
  margin-bottom:20px;
}

table{
  width:100%;
  border-collapse:collapse;
}

table th{
  text-align:left;
  padding:14px;
  color:#94a3b8;
  font-size:14px;
}

table td{
  padding:14px;
  border-bottom:1px solid rgba(255,255,255,0.08);
}

table tr:hover{
  background:rgba(99,102,241,0.08);
}

/* STATUS */

.status{
  padding:6px 12px;
  border-radius:20px;
  font-size:12px;
  font-weight:bold;
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
    min-height:auto;
    position:relative;
  }

  .main{
    padding:15px;
  }

  .topbar{
    flex-direction:column;
    align-items:flex-start;
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
      <a href="{{route('studentdashboard')}}" class="active">Dashboard</a>
    </li>

    <li><a href="{{ route('student.class' , Auth::id() ) }}">Classes</a></li>
    </li>     

    <li>
      <a href="{{ route('student.class_', Auth::id()) }}">
        Attendance
      </a>
    </li>

    <li>
      <a href="{{ route('assignments.student', Auth::id()) }}">
        Assignments
      </a>
    </li>

    <li>
      <a href="{{ route('messages.student', Auth::id()) }}">
        Messages
      </a>
    </li>

    <li>
      <a href="{{route('login')}}">logout</a>
    </li>

  </ul>

</div>

<!-- MAIN -->

<div class="main">

  <!-- TOPBAR -->

  <div class="topbar">

    <h1>Student Dashboard</h1>

    <div class="profile">

      <a href="{{ route('profile.index') }}">
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
        <p>{{ $CountClass }}</p>
    </div>

    <div class="card">
        <h2>Assignments</h2>
        <p>{{ $CountAssignment }}</p>
    </div>

    <div class="card">
        <h2>Attendance</h2>
        <p>{{ $CountAttendance }}%</p>
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

        <tr>
          <td>English</td>
          <td>Essay Writing</td>
          <td>May 28</td>
          <td>
            <span class="status completed">
              Completed
            </span>
          </td>
        </tr>

        <tr>
          <td>History</td>
          <td>World War Report</td>
          <td>June 1</td>
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
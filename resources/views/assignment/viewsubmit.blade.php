<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Submissions</title>

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
  font-family:Arial,sans-serif;
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

@keyframes bgMove{
  0%{background-position:0% 50%}
  50%{background-position:100% 50%}
  100%{background-position:0% 50%}
}

body::before,
body::after{
  content:"";
  position:fixed;
  width:280px;
  height:280px;
  border-radius:50%;
  filter:blur(90px);
  opacity:.3;
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

  background:rgba(15,23,42,.92);
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
  transition:.25s;
}

.menu a:hover{
  background:rgba(99,102,241,.12);
  color:#fff;
  transform:translateX(6px);
}

.menu a.active{
  background:linear-gradient(90deg,#6366f1,#8b5cf6);
  color:#fff;
}

/* ================= MAIN ================= */
.main{
  flex:1;
  padding:30px;
}

/* ================= HEADINGS ================= */
.page-title{
  text-align:center;
  margin-bottom:25px;
  font-size:32px;
  font-weight:bold;
}

.section-title{
  text-align:center;
  margin:30px 0 20px;
  font-size:24px;
}

/* ================= CARDS ================= */
.container,
.class-card{
  max-width:900px;
  margin:15px auto;

  background:var(--card);
  border:1px solid var(--border);
  border-radius:18px;
  padding:20px;

  backdrop-filter:blur(12px);
  transition:.3s;
}

.container:hover,
.class-card:hover{
  transform:translateY(-5px);
  background:rgba(99,102,241,.08);
}

h3{
  margin-bottom:10px;
  color:#fff;
}

p{
  color:var(--muted);
  margin:8px 0;
  line-height:1.5;
}

/* ================= BUTTONS ================= */
.btn{
  display:inline-block;
  margin-top:12px;
  padding:10px 16px;

  background:linear-gradient(90deg,#3b82f6,#6366f1);
  color:#fff;

  border:none;
  border-radius:10px;
  text-decoration:none;
  font-weight:bold;
  cursor:pointer;

  transition:.3s;
}

.btn:hover{
  transform:scale(1.05);
}

.delete-btn{
  background:linear-gradient(90deg,#ef4444,#dc2626);
}

.delete-form{
  margin-top:10px;
}

/* ================= CLASS SECTION ================= */
.class-section{
  max-width:900px;
  margin:40px auto 0;
}

.class-card{
  display:flex;
  justify-content:space-between;
  align-items:center;
}

.class-name{
  font-size:18px;
  font-weight:600;
  color:#fff;
}

/* ================= EMPTY ================= */
.empty{
  text-align:center;
  color:#f87171;
  margin-top:40px;
  font-size:18px;
}

/* ================= MOBILE ================= */
@media(max-width:768px){

  body{
    flex-direction:column;
  }

  .sidebar{
    width:100%;
    min-width:100%;
    height:auto;
    position:relative;
  }

  .main{
    padding:15px;
  }

  .class-card{
    flex-direction:column;
    gap:15px;
    text-align:center;
  }

  .container{
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
    <li><a href="{{ route('teacherdashboard') }}">Dashboard</a></li>
    <li><a href="{{ route('viewclass') }}">Classes</a></li>
    <li><a href="{{ route('attendance.nameofclass', Auth::id()) }}">Attendance</a></li>
    <li><a href="{{ route('assignments.nameclass', Auth::id()) }}">Assignments</a></li>
    <li><a class="active" href="{{ route('submissions.view') }}">Messages</a></li>
    <li><a href="{{ route('login') }}">Logout</a></li>
  </ul>

</div>

<!-- MAIN CONTENT -->
<div class="main">

  <h1 class="page-title">Student Submissions</h1>

  @if(isset($data) && count($data) > 0)

      @foreach ($data as $item)

      <div class="container">

          <h3>Student ID: {{ $item->user_id }}</h3>

          <p><strong>Assignment ID:</strong> {{ $item->assignment_id }}</p>

          <p>
              <strong>Answer:</strong>
              {{ $item->answer }}
          </p>

          @if($item->file)
              <a href="{{ asset('storage/' . $item->file) }}"
                 target="_blank"
                 class="btn">
                  View File
              </a>
          @endif

          <form action="{{ route('submissions.delete',$item->assignment_id) }}"
                method="POST"
                class="delete-form">

              @csrf
              @method('DELETE')

              <button type="submit"
                      class="btn delete-btn">
                  Clear
              </button>

          </form>

      </div>

      @endforeach

  @else

      <div class="empty">
          No submissions found.
      </div>

  @endif


  <!-- CLASSES SECTION -->
  @if(isset($classId) && count($classId) > 0)

      <div class="class-section">

          <h2 class="section-title">Classes</h2>

          @foreach ($classId as $item)

              <div class="class-card">

                  <div class="class-name">
                      {{ $item->class_name }}
                  </div>

                  <a href="{{ route('messages.teacher', $item->id) }}"
                     class="btn">
                      View Messages
                  </a>

              </div>

          @endforeach

      </div>

  @endif

</div>

</body>
</html>
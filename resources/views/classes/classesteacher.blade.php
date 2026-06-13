<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Create Class</title>

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
}

/* BACKGROUND ANIMATION */
@keyframes bgMove{
  0%{background-position:0% 50%}
  50%{background-position:100% 50%}
  100%{background-position:0% 50%}
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
}

/* MAIN LAYOUT FIX */
.main{
  flex:1;
  display:flex;
  gap:20px;
  padding:30px;
  align-items:flex-start;
  overflow:hidden;
}

/* CARD BASE */
.card{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:16px;
  padding:18px;
  backdrop-filter:blur(12px);
  box-shadow:0 10px 30px rgba(0,0,0,0.2);
}

/* LEFT COLUMN (class list) */
.main > .card:first-child{
  flex:1;
  max-height:calc(100vh - 60px);
  overflow-y:auto;
}

/* RIGHT COLUMN */
.main > .card:last-child{
  width:380px;
  flex-shrink:0;
  display:flex;
  flex-direction:column;
  gap:15px;
}

/* CLASS ITEM */
.class-item{
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:12px 0;
  border-bottom:1px solid var(--border);
  gap:10px;
}

/* INPUT */
input{
  width:100%;
  padding:12px;
  border-radius:10px;
  border:1px solid var(--border);
  background:rgba(255,255,255,0.05);
  color:#fff;
  margin-top:8px;
  outline:none;
}

input:focus{
  border-color:rgba(99,102,241,0.6);
}

/* BUTTON */
button{
  padding:10px 14px;
  border:none;
  border-radius:10px;
  background:var(--primary);
  color:white;
  cursor:pointer;
  margin-top:10px;
  transition:0.2s;
  font-weight:500;
}

button:hover{
  transform:scale(1.03);
  opacity:0.95;
}

/* DELETE BUTTON */
button[style*="ef4444"]{
  background:#ef4444 !important;
}

/* LINKS */
a{
  color:#60a5fa;
  text-decoration:none;
}

/* MESSAGES */
.error{
  color:#f87171;
  font-size:13px;
  margin-top:5px;
}

.success{
  color:#34d399;
  margin-bottom:10px;
}

/* RESPONSIVE */
@media (max-width: 900px){
  .main{
    flex-direction:column;
  }

  .main > .card:last-child{
    width:100%;
  }
}

</style>
</head>

<body>

<!-- SIDEBAR (COPIED FROM DASHBOARD) -->
<div class="sidebar">

  <div class="logo">🎓 Teacher Panel</div>

  <ul class="menu">
    <li><a href="{{ route('teacherdashboard') }}">Dashboard</a></li>
    <li><a href="{{ route('viewclass') }}" class="active">Classes</a></li>
    <li><a href="{{ route('attendance.nameofclass', Auth::id()) }}">Attendance</a></li>
    <li><a href="{{ route('assignments.nameclass', Auth::id()) }}">Assignments</a></li>
    <li><a href="{{ route('submissions.view') }}">Messages</a></li>
    <li><a href="{{ route('login') }}" >
        Logout
      </a></li>
  </ul>

</div>

<!-- MAIN CONTENT -->
<div class="main">
   <!-- left: CREATE CLASS + JOINED CLASSES -->
    <div class="card">

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <!-- CREATE CLASS -->
        <form action="{{ route('inputclass') }}" method="POST">
            @csrf

            <label>Create Class</label>
            <input type="text" name="class_name"
                   value="{{ old('class_name') }}"
                   placeholder="Enter class name" required>

            @error('class_name')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">Create</button>
        </form>

  <br>

    <!-- JOINED CLASSES -->
    <div class="card">

        <h3>Joined Classes</h3>

        @forelse($classes as $c)
            <div class="class-item">
                <div>{{ $c->class_name }}</div>
                <a href="{{ route('subjects.teacher', $c->id) }}">View</a>
            </div>
             <form action="{{ route('delete.class', $c->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button style="background:#ef4444;">Delete</button>
                    </form>
        @empty
            <p>No classes joined yet.</p>
        @endforelse

    </div>
     </div>

    <!-- right: USER CLASSES -->
    <div class="card" >
           <h1>Message</h1>
           <br>
        @foreach ($data as $item)

            <div class="class-item">
                <div>
                    <strong>User:</strong>
                    {{ $item->user->name ?? 'Unknown' }} <br>

                    <strong>Class:</strong>
                    {{ $item->name }}
                </div>

                <div style="display:flex; gap:10px;">

                    <form action="{{ route('Checkname') }}" method="POST">
                        @csrf
                        <input type="hidden" name="name"
                               value="{{ old('name', $item->name ?? '') }}">
                        <button type="submit">Accept</button>
                    </form>

                    <form action="{{ route('deletename', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button style="background:#ef4444;">Decline</button>
                    </form>

                </div>
            </div>

        @endforeach

    </div>

   
</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Assignments</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* BODY */
body {
    min-height: 100vh;
    display: flex;
    background: linear-gradient(-45deg, #0f172a, #111827, #1e293b, #0b1220);
    background-size: 400% 400%;
    animation: bgMove 12s ease infinite;
    color: #e2e8f0;
}

@keyframes bgMove {
    0% {background-position: 0% 50%;}
    50% {background-position: 100% 50%;}
    100% {background-position: 0% 50%;}
}

/* SIDEBAR */
.sidebar {
    width: 260px;
    min-height: 100vh;
    background: rgba(15,23,42,0.9);
    backdrop-filter: blur(10px);
    padding: 25px 20px;
    box-shadow: 10px 0 30px rgba(0,0,0,0.4);
    position: fixed;
    left: 0;
    top: 0;
}

.logo {
    font-size: 24px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 40px;
    color: #fff;
}

.menu {
    list-style: none;
}

.menu li {
    margin: 14px 0;
}

.menu a {
    display: block;
    text-decoration: none;
    padding: 12px 15px;
    border-radius: 12px;
    color: #94a3b8;
    transition: 0.3s;
}

.menu a:hover {
    background: rgba(99,102,241,0.15);
    color: #fff;
    transform: translateX(5px);
}

.menu .active {
    background: linear-gradient(90deg,#6366f1,#8b5cf6);
    color: #fff;
}

/* MAIN CONTAINER FIX */
.container {
    margin-left: 260px;
    width: calc(100% - 260px);
    padding: 30px;

    display: flex;
    gap: 20px;
    align-items: flex-start;
}

/* LEFT + RIGHT COLUMNS */
.left-panel,
.right-panel {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* TITLES */
h2 {
    text-align: left;
    margin-bottom: 10px;
    font-size: 26px;
    color: #fff;
}

/* CARD */
.class-box {
    padding: 18px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 14px;
    transition: 0.3s;
}

.class-box:hover {
    transform: translateY(-5px);
    background: rgba(99,102,241,0.08);
    box-shadow: 0 15px 30px rgba(0,0,0,0.3);
}

.class-box h3 {
    color: #fff;
    margin-bottom: 8px;
}

.class-box p {
    color: #cbd5e1;
    margin: 5px 0;
}

/* BUTTON */
.btn {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 14px;
    background: linear-gradient(90deg,#3b82f6,#6366f1);
    color: white;
    border-radius: 10px;
    text-decoration: none;
    font-size: 13px;
    font-weight: bold;
    transition: 0.3s;
}

.btn:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 25px rgba(59,130,246,0.3);
}

/* BACK LINK */
.back-link {
    display: inline-block;
    margin-top: 20px;
    color: #94a3b8;
    text-decoration: none;
}

.back-link:hover {
    color: #fff;
}

/* EMPTY */
.empty {
    text-align: center;
    color: #f87171;
    margin-top: 20px;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    body {
        flex-direction: column;
    }

    .sidebar {
        position: relative;
        width: 100%;
    }

    .container {
        margin-left: 0;
        width: 100%;
        flex-direction: column;
        padding: 20px;
    }
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

  <div class="logo">🎓 Student Panel</div>

  <ul class="menu">

    <li><a href="{{route('studentdashboard')}}">Dashboard</a></li>

    <li><a href="{{ route('student.class' , Auth::id() ) }}">Classes</a></li>

    <li><a href="{{ route('student.class_', Auth::id()) }}">Attendance</a></li>

    <li><a href="{{ route('assignments.student', Auth::id()) }}" class="active">Assignments</a></li>

    <li><a href="{{ route('messages.student', Auth::id()) }}">Messages</a></li>

    <li><a href="{{ route('login') }}" >
        Logout
      </a></li>

  </ul>

</div>

<!-- MAIN CONTENT -->
<div class="container" style="display:flex;">

    {{-- Assignments --}}
    <div style="margin-left:100px;">
        <h2>
            {{ optional($classname)->name ?? 'Assignment' }}
        </h2>

        @if (empty($classname))
            <p class="empty">No class found</p>
        @else

            @forelse ($assignments as $assignment)
                <div class="class-box">
                    <h3>{{ $assignment->title }}</h3>
                    <p>{{ $assignment->description }}</p>
                    <p>
                        <strong>Due Date:</strong>
                        {{ $assignment->due_date }}
                    </p>

                    <a href="{{ route('assignments.formstudent', $assignment->id) }}"
                       class="btn">
                        Submit Assignment
                    </a>
                </div>
            @empty
                <p class="empty">No assignments found</p>
            @endforelse

        @endif
    </div>

    {{-- Vertical Divider --}}
    <hr style="border:none; width:10px; background:#565683; margin:0 50px;">

    {{-- Submitted Assignments --}}
    <div style="margin-top:10px;">
        <h2>Assignment Submitted</h2>

        @forelse ($assignmentSubmitted as $item)

            <div style="margin-bottom:20px;">
                <h3>Student ID: {{ $item->user_id }}</h3>

                <p>Assignment ID: {{ $item->assignment_id }}</p>

                <p>Answer: {{ $item->answer }}</p>

                <form action="{{ route('assignments.clear', $item->id) }}"
                      method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn"
                            style="background:#ef4444; margin-top:10px;">
                        Delete Submission
                    </button>
                </form>

                <hr>
            </div>

        @empty
            <p>No submissions found.</p>
        @endforelse

    </div>

</div>

</div>

</body>
</html>
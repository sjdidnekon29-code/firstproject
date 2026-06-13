<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Student Assignments & Messages</title>

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

@keyframes bgMove{
    0%{background-position:0% 50%}
    50%{background-position:100% 50%}
    100%{background-position:0% 50%}
}

/* Glow */

body::before,
body::after{
    content:"";
    position:fixed;
    width:300px;
    height:300px;
    border-radius:50%;
    filter:blur(80px);
    opacity:.4;
    z-index:-1;
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

/* Sidebar */

.sidebar{
    width:260px;
    min-height:100vh;
    background:rgba(15,23,42,.9);
    backdrop-filter:blur(10px);
    padding:25px 20px;
    box-shadow:10px 0 30px rgba(0,0,0,.4);
}

.logo{
    font-size:24px;
    font-weight:bold;
    text-align:center;
    margin-bottom:40px;
    color:white;
}

.menu{
    list-style:none;
}

.menu li{
    margin:14px 0;
}

.menu a{
    display:block;
    padding:12px 15px;
    border-radius:12px;
    text-decoration:none;
    color:#94a3b8;
    transition:.3s;
}

.menu a:hover{
    background:rgba(99,102,241,.15);
    color:white;
    transform:translateX(5px);
}

.menu .active{
    background:linear-gradient(90deg,#6366f1,#8b5cf6);
    color:white;
}

/* Main Content */

.container{
    flex:1;
    padding:40px;
    max-width:1200px;
}

.container h2{
    color:white;
    margin-bottom:25px;
    font-size:32px;
}

/* Cards */

.class-box{
    background:rgba(255,255,255,.07);
    border:1px solid rgba(255,255,255,.1);
    border-radius:18px;
    padding:25px;
    margin-bottom:20px;
    backdrop-filter:blur(12px);
    transition:.3s;
}

.class-box:hover{
    transform:translateY(-4px);
    box-shadow:0 15px 35px rgba(0,0,0,.35);
}

.class-box h3{
    color:white;
    margin-bottom:12px;
}

.class-box p{
    color:#cbd5e1;
    line-height:1.6;
    margin-bottom:10px;
}

/* Buttons */

.btn{
    display:inline-block;
    text-decoration:none;
    padding:12px 18px;
    border-radius:10px;
    margin-top:10px;
    margin-right:10px;
    color:white;
    font-weight:bold;
    background:linear-gradient(90deg,#6366f1,#8b5cf6);
    transition:.3s;
}

.btn:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 20px rgba(99,102,241,.35);
}

.back-link{
    display:inline-block;
    margin-top:30px;
    text-decoration:none;
    padding:12px 18px;
    border-radius:10px;
    background:#334155;
    color:white;
    transition:.3s;
}

.back-link:hover{
    background:#475569;
}

/* Classes Grid */

.classes-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:20px;
}

/* Mobile */

@media(max-width:768px){

    body{
        flex-direction:column;
    }

    .sidebar{
        width:100%;
        min-height:auto;
    }

    .container{
        padding:20px;
    }

    .container h2{
        font-size:26px;
    }
}

</style>
</head>

<body>

<!-- Sidebar -->

<div class="sidebar">

    <div class="logo">🎓 Student Panel</div>

    <ul class="menu">

        <li>
            <a href="{{ route('studentdashboard') }}">
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('viewclass') }}">
                Classes
            </a>
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
            <a href="{{ route('messages.student', Auth::id()) }}" class="active">
                Messages
            </a>
        </li>

        <li>
            <a href="{{ route('login') }}">
                Logout
            </a>
        </li>

    </ul>

</div>

<!-- Main Content -->

<div class="container">

    <h2>Assignments</h2>

    @forelse ($assignments as $assignment)

        <div class="class-box">

            <h3>{{ $assignment->title }}</h3>

            <p>{{ $assignment->description }}</p>

            <p>
                <strong>Due Date:</strong>
                {{ $assignment->due_date }}
            </p>

            @if($assignment->file)
                <a href="{{ asset('storage/' . $assignment->file) }}"
                   class="btn"
                   target="_blank">
                    View File
                </a>
            @endif

            <a href="{{ route('assignments.formstudent', $assignment->id) }}"
               class="btn">
                Submit Assignment
            </a>

        </div>

    @empty

        <div class="class-box">
            <p>No assignments found.</p>
        </div>

    @endforelse

    <h2 style="margin-top:40px;">Classes</h2>

    <div class="classes-grid">

        @forelse ($classes as $class)

            <div class="class-box">

                <h3>{{ $class->class_name }}</h3>

                <a href="{{ route('messages.class', $class->id) }}"
                   class="btn">
                    View Messages
                </a>

            </div>

        @empty

            <div class="class-box">
                <p>No classes available.</p>
            </div>

        @endforelse

    </div>

    <a href="{{ route('studentdashboard') }}"
       class="back-link">
        Back to Dashboard
    </a>

</div>

</body>
</html>
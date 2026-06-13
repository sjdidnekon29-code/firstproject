<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Subjects in Class</title>

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Segoe UI', sans-serif;
}

/* 🌈 BACKGROUND */
body{
  min-height:100vh;
  background: linear-gradient(-45deg, #0f172a, #111827, #1e293b, #0b1220);
  background-size:400% 400%;
  animation: bgMove 10s ease infinite;
  color:#e2e8f0;
  padding:30px;
}

@keyframes bgMove{
  0%{background-position:0% 50%}
  50%{background-position:100% 50%}
  100%{background-position:0% 50%}
}

/* CONTAINER */
.container{
  max-width:900px;
  margin:auto;
  animation: fadeIn 1s ease;
}

@keyframes fadeIn{
  from{opacity:0; transform:translateY(30px);}
  to{opacity:1; transform:translateY(0);}
}

/* TITLE */
h1{
  text-align:center;
  font-size:32px;
  color:#fff;
  margin-bottom:25px;
}

/* SECTION HEADERS */
h3,p{
  color:#94a3b8;
  margin-bottom:10px;
}

/* SUBJECT LIST (converted to cards) */
.subjects{
  display:grid;
  grid-template-columns:repeat(auto-fit, minmax(150px, 1fr));
  gap:12px;
  margin-bottom:30px;
}

.subject-card{
  background: rgba(255,255,255,0.06);
  border:1px solid rgba(255,255,255,0.1);
  padding:15px;
  border-radius:15px;
  text-align:center;
  color:#fff;
  transition:0.4s;
  backdrop-filter: blur(10px);
  animation: cardIn 0.6s ease forwards;
  opacity:0;
}

.subject-card:nth-child(1){animation-delay:0.1s;}
.subject-card:nth-child(2){animation-delay:0.2s;}
.subject-card:nth-child(3){animation-delay:0.3s;}
.subject-card:nth-child(4){animation-delay:0.4s;}

@keyframes cardIn{
  from{opacity:0; transform:scale(0.8);}
  to{opacity:1; transform:scale(1);}
}

.subject-card:hover{
  transform: translateY(-8px) scale(1.05);
  box-shadow:0 15px 40px rgba(0,0,0,0.5);
}

/* STUDENTS */
.students{
  display:flex;
  flex-wrap:wrap;
  gap:10px;
}

.student{
  padding:8px 14px;
  border-radius:20px;
  background: rgba(34,197,94,0.15);
  color:#22c55e;
  font-size:13px;
  transition:0.3s;
}

.student:hover{
  transform:scale(1.1);
  background: rgba(34,197,94,0.25);
}

/* DIVIDER */
hr{
  border:none;
  height:1px;
  background: rgba(255,255,255,0.1);
  margin:25px 0;
}

/* BACK BUTTON */
a{
  display:block;
  text-align:center;
  margin-top:20px;
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

<div class="container">

    <h1>📚 Subjects in Class</h1>

    <p>All subjects available in this class</p>

   
    {{-- STUDENTS --}}


    <hr>
{{-- USERS --}}
<h3>👨‍🎓 Students who joined this class:</h3>

<div class="students">
    @foreach($students as $student)

        <div class="student">
            <a href="{{ route('profile.studentname', $student->name) }}">
                {{ $student->name }}
                
            </a>
        </div>

    @endforeach
</div>

    <hr>

    <a href="{{ route('studentdashboard') }}">
         Back to Classes
    </a>

</div>

</body>
</html>
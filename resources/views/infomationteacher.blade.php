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

/* BACKGROUND */
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
  margin-bottom:10px;
}

p{
  text-align:center;
  color:#94a3b8;
  margin-bottom:25px;
}

/* SECTION TITLE */
h3{
  color:#cbd5f5;
  margin:15px 0;
}

/* STUDENTS LIST */
.student-list{
  display:flex;
  flex-direction:column;
  gap:10px;
}

/* checkbox item */
.student-item{
  display:flex;
  align-items:center;
  gap:10px;
  padding:10px 14px;
  border-radius:12px;
  background: rgba(255,255,255,0.06);
  border:1px solid rgba(255,255,255,0.1);
  transition:0.3s;
}

.student-item:hover{
  transform:scale(1.02);
  background: rgba(255,255,255,0.09);
}

.student-item input{
  accent-color:#22c55e;
  transform:scale(1.2);
}

/* BUTTON */
.btn {
  padding:10px 15px;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  font-size: 14px;
  font-weight: bold;
  transition: 0.3s;
  margin-top:15px;
}

.btn-update {
  background: linear-gradient(90deg,#951414,#86777a);
  color: white;
}

.btn-update:hover {
  transform: scale(1.03);
  box-shadow: 0 10px 25px rgba(149, 20, 20, 0.3);
}

/* DIVIDER */
hr{
  border:none;
  height:1px;
  background: rgba(255,255,255,0.1);
  margin:25px 0;
}

/* BACK LINK */
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

    <hr>

    <h3>👨‍🎓 Students who joined this class:</h3>

    <form action="{{ route('class.kick') }}" method="POST">
        @csrf

        <input type="hidden" name="class_id" value="{{ $class_id }}">

        <div class="student-list">
            @foreach($students as $student)
                <label class="student-item">
                    <input type="checkbox" name="student_ids[]" value="{{ $student->id }}">
                    <span>{{ $student->name }}</span>
                </label>
            @endforeach
        </div>

        <button type="submit" class="btn btn-update">
            Remove Selected
        </button>
    </form>

    <hr>

    <a href="{{ route('teacherdashboard') }}">
        Back to Classes
    </a>

</div>

</body>
</html>
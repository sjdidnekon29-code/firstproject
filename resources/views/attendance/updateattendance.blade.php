<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Attendance</title>

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
    justify-content:center;
    align-items:center;
    background:linear-gradient(-45deg,#0f172a,#111827,#1e293b,#0b1220);
    background-size:400% 400%;
    animation:bgMove 10s ease infinite;
    color:#e2e8f0;
    padding:20px;
}

/* background animation */
@keyframes bgMove{
    0%{background-position:0% 50%}
    50%{background-position:100% 50%}
    100%{background-position:0% 50%}
}

/* glow */
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

/* container */
.container{
    width:100%;
    max-width:600px;
    background:rgba(15,23,42,0.9);
    backdrop-filter:blur(12px);
    border:1px solid rgba(255,255,255,0.1);
    border-radius:16px;
    padding:25px;
    box-shadow:0 20px 40px rgba(0,0,0,0.4);
}

/* heading */
h2{
    text-align:center;
    margin-bottom:20px;
}

/* attendance card */
.attendance-info{
    background:rgba(255,255,255,0.06);
    border:1px solid rgba(255,255,255,0.1);
    padding:15px;
    border-radius:12px;
    margin-bottom:20px;
}

.attendance-info p{
    margin:6px 0;
}

/* form */
label{
    display:block;
    margin-top:10px;
    font-size:14px;
    color:#cbd5e1;
}

select{
    width:100%;
    padding:10px;
    margin-top:5px;
    border-radius:10px;
    border:none;
    background:#0f172a;
    color:#fff;
}

/* buttons */
button{
    width:100%;
    padding:10px;
    margin-top:15px;
    border:none;
    border-radius:10px;
    cursor:pointer;
    font-weight:bold;
    transition:0.3s ease;
}

button[type="submit"]{
    background:linear-gradient(90deg,#6366f1,#8b5cf6);
    color:white;
}

button[type="submit"]:hover{
    transform:translateY(-2px);
}

/* clear button */
.btn-clear{
    background:#ef4444;
    color:white;
}

.btn-clear:hover{
    background:#dc2626;
    transform:translateY(-2px);
}

/* mobile */
@media(max-width:600px){
    .container{
        padding:15px;
    }
}
</style>
</head>

<body>

<div class="container">

    @foreach($attendance as $att)
<a href="{{ route('teacherdashboard') }}">back to dashboard</a> 
    <div class="attendance-info">
        <h2>Update Attendance</h2>
        

        <p><strong>Class ID:</strong> {{ $att->class_id }}</p>
        <p><strong>Date:</strong> {{ $att->date }}</p>
        <p><strong>Subject:</strong> {{ $att->subject }}</p>
        <p><strong>Status:</strong> {{ $att->status }}</p>

        <form action="{{ route('attendance.edit', $att->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Status</label>
            <select name="status" required>
                <option value="present" {{ $att->status == 'present' ? 'selected' : '' }}>Present</option>
                <option value="absent" {{ $att->status == 'absent' ? 'selected' : '' }}>Absent</option>
                <option value="late" {{ $att->status == 'late' ? 'selected' : '' }}>Late</option>
            </select>

            <button type="submit">Update Attendance</button>
        </form>

        <form action="{{ route('attendance.clear', $att->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-clear">Clear</button>
        </form>

    </div>

    @endforeach

</div>

</body>
</html>
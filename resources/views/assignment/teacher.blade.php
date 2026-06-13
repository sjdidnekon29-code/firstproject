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

body {
    min-height: 100vh;
    padding: 30px;

    background: linear-gradient(-45deg, #0f172a, #111827, #1e293b, #0b1220);
    background-size: 400% 400%;
    animation: bgMove 12s ease infinite;

    color: #e2e8f0;
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

/* background animation */
@keyframes bgMove {
    0% {background-position: 0% 50%;}
    50% {background-position: 100% 50%;}
    100% {background-position: 0% 50%;}
}

/* glow orbs */
body::before,
body::after {
    content: "";
    position: fixed;
    width: 280px;
    height: 280px;
    border-radius: 50%;
    filter: blur(90px);
    opacity: 0.35;
    z-index: -1;
}

body::before {
    background: #6366f1;
    top: 10%;
    left: 10%;
    animation: float 8s ease-in-out infinite;
}

body::after {
    background: #f59e0b;
    bottom: 10%;
    right: 10%;
    animation: float 10s ease-in-out infinite;
}

@keyframes float {
    0% {transform: translateY(0);}
    50% {transform: translateY(-25px) scale(1.1);}
    100% {transform: translateY(0);}
}

/* container */
.container {
    width: 100%;
    max-width: 650px;

    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    backdrop-filter: blur(15px);
    border-radius: 18px;

    padding: 25px;
    box-shadow: 0 25px 70px rgba(0,0,0,0.5);

    animation: fadeIn 0.8s ease;
}

@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}

/* title */
h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 26px;
    background: linear-gradient(90deg,#fff,#94a3b8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* success message */
p {
    text-align: center;
    color: #22c55e;
    font-weight: bold;
    margin-bottom: 10px;
}

/* form labels */
label {
    display: block;
    margin-top: 10px;
    margin-bottom: 6px;
    color: #cbd5e1;
    font-size: 14px;
}

/* inputs */
input,
textarea,
select {
    width: 100%;
    padding: 12px;
    border-radius: 10px;

    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    color: #fff;

    outline: none;
    transition: 0.3s;
}

textarea {
    min-height: 100px;
    resize: none;
}

input:focus,
textarea:focus,
select:focus {
    border-color: #6366f1;
    box-shadow: 0 0 12px rgba(99,102,241,0.4);
}

/* button */
.btn {
    width: 100%;
    padding: 12px;

    border: none;
    border-radius: 10px;

    margin-top: 15px;
    cursor: pointer;

    font-weight: bold;
    font-size: 15px;

    background: linear-gradient(90deg,#3b82f6,#6366f1);
    color: white;

    transition: 0.3s;
}

.btn:hover {
    transform: scale(1.03);
    box-shadow: 0 10px 25px rgba(59,130,246,0.3);
}

/* links */
.back-link {
    display: inline-block;
    margin-top: 15px;
    color: #94a3b8;
    text-decoration: none;
    transition: 0.3s;
}

.back-link:hover {
    color: #fff;
}

/* spacing between links */
a + a {
    margin-left: 10px;
}

/* responsive */
@media(max-width:600px){
    .container {
        padding: 18px;
    }
}
</style>
</head>
<body>

<div class="container">

    <h2>Class {{ $classname }}</h2>

    @if (session('success'))
        <p style="color:green; text-align:center;">
            {{ session('success') }}
        </p>
    @endif

    <form action="{{ route('assignments.store') }}" method="POST">
        @csrf

        <label>Select Class:</label>

        <select name="class_id" required>
            <option value="{{ $class->id }}">
                {{ $classname }}
            </option>
        </select>

        <label>Assignment Title:</label>
        <input type="text" name="title" required>

        <label>Description:</label>
        <textarea name="description" required></textarea>

        <label>Due Date:</label>
        <input type="date" name="due_date" required>

        <button type="submit" class="btn">
            Create Assignment
        </button>

    </form>

    <br>

    <a href="{{ route('teacherdashboard') }}" class="back-link">
        Back to Dashboard
    </a>
    <br>
     <a href="{{ route('submissions.view') }}" class="back-link">
        View Submissions
    </a>

</div>



</body>
</html>
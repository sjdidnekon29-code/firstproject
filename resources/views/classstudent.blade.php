<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Messages</title>
</head>
<body>
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
    display: flex;
    justify-content: center;
    align-items: flex-start;

    background: linear-gradient(-45deg, #0f172a, #111827, #1e293b, #0b1220);
    background-size: 400% 400%;
    animation: bgMove 12s ease infinite;
    color: #e2e8f0;
}

/* background animation */
@keyframes bgMove {
    0% {background-position: 0% 50%;}
    50% {background-position: 100% 50%;}
    100% {background-position: 0% 50%;}
}

/* floating glow */
body::before,
body::after {
    content: "";
    position: fixed;
    width: 260px;
    height: 260px;
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

/* main container */
.container {
    width: 100%;
    max-width: 700px;

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

/* back link */
.back-link {
    display: inline-block;
    margin-bottom: 15px;
    color: #94a3b8;
    text-decoration: none;
    transition: 0.3s;
    font-size: 14px;
}

.back-link:hover {
    color: #fff;
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

/* class card */
.class-box {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    padding: 18px;
    border-radius: 14px;
    margin-bottom: 15px;

    display: flex;
    justify-content: space-between;
    align-items: center;

    transition: 0.3s;
}

.class-box:hover {
    transform: translateY(-5px);
    background: rgba(99,102,241,0.08);
    box-shadow: 0 15px 30px rgba(0,0,0,0.3);
}

.class-box h3 {
    color: #fff;
    font-size: 18px;
}

/* button */
.btn {
    padding: 10px 14px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 13px;
    font-weight: bold;

    background: linear-gradient(90deg,#6366f1,#8b5cf6);
    color: white;

    transition: 0.3s;
}

.btn:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(99,102,241,0.3);
}

/* empty state */
p {
    text-align: center;
    margin-top: 20px;
    color: #f87171;
}
</style>
    <div class="container">

    <a class="back-link" href="{{ route('studentdashboard') }}">
         Back to Dashboard
    </a>

    <h2>My Classes</h2>

    @if($classes->count() > 0)

        @foreach($classes as $class)

            <div class="class-box">

                <h3>{{ $class->name }}</h3>

                <a class="btn"
                   href="{{ route('attendance.classteacher', $class->id) }}">
                    View Attendance
                </a>

            </div>

        @endforeach

    @else

        <p style="color:red; text-align:center;">
            No classes found
        </p>

    @endif

</div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Profile</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(-45deg,#0f172a,#111827,#1e293b,#0b1220);
    background-size: 400% 400%;
    animation: bgMove 10s ease infinite;
    color: #e2e8f0;
}

@keyframes bgMove {
    0% {background-position:0% 50%}
    50% {background-position:100% 50%}
    100% {background-position:0% 50%}
}

.card {
    width: 420px;
    padding: 25px;
    border-radius: 18px;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    backdrop-filter: blur(12px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    animation: fadeIn 0.8s ease;
}

@keyframes fadeIn {
    from {opacity:0; transform:translateY(20px);}
    to {opacity:1; transform:translateY(0);}
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #fff;
}

.info {
    margin: 10px 0;
    padding: 10px;
    border-radius: 10px;
    background: rgba(255,255,255,0.04);
}

.label {
    color: #94a3b8;
    font-size: 13px;
}

.value {
    color: #fff;
    font-size: 15px;
    margin-top: 3px;
}

a {
    display: block;
    margin-top: 20px;
    text-align: center;
    color: #94a3b8;
    text-decoration: none;
    transition: 0.3s;
}

a:hover {
    color: #fff;
}
</style>
</head>

<body>

<div class="card">

    <h1> Profile</h1>

    <div class="info">
        <div class="label">Email</div>
        <div class="value">
            {{ $profile->user->email ?? 'N/A' }}
        </div>
    </div>

    <div class="info">
        <div class="label">Phone</div>
        <div class="value">
            {{ $profile->phone ?? 'N/A' }}
        </div>
    </div>

    <div class="info">
        <div class="label">Gender</div>
        <div class="value">
            {{ $profile->gender ?? 'N/A' }}
        </div>
    </div>

    <div class="info">
        <div class="label">Address</div>
        <div class="value">
            {{ $profile->address ?? 'N/A' }}
        </div>
    </div>

    <a href="{{ route('studentdashboard') }}">
        Back to Dashboard
    </a>

</div>

</body>
</html>
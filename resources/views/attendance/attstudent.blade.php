<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students In Class</title>

  
  <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 40px 20px;
    background: linear-gradient(-45deg, #0f172a, #111827, #1e293b, #0b1220);
    background-size: 400% 400%;
    animation: bgMove 12s ease infinite;
    color: #e2e8f0;
}

@keyframes bgMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.container {
    width: 100%;
    max-width: 1100px;
    background: rgba(15, 23, 42, 0.85);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #fff;
    font-size: 28px;
}

.container > a {
    display: inline-block;
    margin-bottom: 20px;
    color: #60a5fa;
    text-decoration: none;
    font-weight: bold;
}

.container > a:hover {
    color: #93c5fd;
}

table {
    width: 100%;
    border-collapse: collapse;
    overflow: hidden;
    border-radius: 12px;
    background: rgba(255,255,255,0.03);
}

thead {
    background: rgba(99, 102, 241, 0.25);
}

th {
    padding: 15px;
    color: white;
    font-weight: 600;
}

td {
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid rgba(255,255,255,0.08);
}

tbody tr:nth-child(even) {
    background: rgba(255,255,255,0.03);
}

tbody tr:hover {
    background: rgba(99,102,241,0.1);
    transition: 0.3s;
}

.present {
    color: #22c55e;
    font-weight: bold;
}

.absent {
    color: #ef4444;
    font-weight: bold;
}

.late {
    color: #f59e0b;
    font-weight: bold;
}

.total-row td {
    font-weight: bold;
    background: rgba(255,255,255,0.05);
}

@media (max-width: 768px) {
    .container {
        padding: 15px;
    }

    table {
        font-size: 14px;
    }

    th,
    td {
        padding: 10px;
    }
}
</style>
</head>
<body>

<div class="container">

    <h2>
        {{ $classname->class_name?? 'No Class Found' }}
    </h2>

    @if (!$classname)
        <p style="color:red;">Class not found</p>
    @endif

    <a href="{{ route('studentdashboard') }}">Back to dashboard</a>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Late</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>

                    <td>{{ $user->name }}</td>

                    <td style="color:green;">
                        {{ $user->present_count }}
                    </td>

                    <td style="color:red;">
                        {{ $user->absent_count }}
                    </td>

                    <td style="color:orange;">
                        {{ $user->late_count }}
                    </td>
                </tr>
            @endforeach

            <tr>
                <td colspan="5" style="text-align:center; color:#555;">
                    Total Students: {{ count($users) }}
                </td>
            </tr>

        </tbody>
    </table>
</div>
</body>
</html>
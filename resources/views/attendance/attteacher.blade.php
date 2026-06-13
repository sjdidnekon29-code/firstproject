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
    padding: 25px;

    background: linear-gradient(-45deg, #0f172a, #111827, #1e293b, #0b1220);
    background-size: 400% 400%;
    animation: bgMove 12s ease infinite;

    color: #e2e8f0;
}

/* animated background */
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
    max-width: 1400px;
    margin: auto;

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

/* success message */
p {
    text-align: center;
    margin-bottom: 10px;
    color: #22c55e;
    font-weight: bold;
}

/* back link */
a {
    display: inline-block;
    margin-bottom: 15px;
    color: #94a3b8;
    text-decoration: none;
    transition: 0.3s;
}

a:hover {
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

/* table */
table {
    width: 100%;
    border-collapse: collapse;
    overflow: hidden;
    border-radius: 12px;
}

/* header */
table th {
    background: rgba(99,102,241,0.2);
    color: #fff;
    padding: 14px;
    text-align: left;
    font-size: 14px;
}

/* rows */
table td {
    padding: 14px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
    color: #cbd5e1;
}

tr:nth-child(even) {
    background: rgba(255,255,255,0.03);
}

tr:hover {
    background: rgba(99,102,241,0.08);
    transition: 0.3s;
}

/* selects */
select {
    width: 100%;
    padding: 8px;
    border-radius: 8px;

    background: rgba(255, 252, 252, 0.05);
    border: 1px solid rgba(255,255,255,0.1);
    color: #1e1b1b;

    outline: none;
}

/* button */
button {
    padding: 8px 12px;
    border: none;
    border-radius: 8px;

    background: linear-gradient(90deg,#22c55e,#16a34a);
    color: white;

    cursor: pointer;
    font-weight: bold;
    transition: 0.3s;
}

button:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(34,197,94,0.3);
}

/* responsive */
@media(max-width:768px){
    table {
        font-size: 12px;
    }

    select, button {
        font-size: 12px;
    }
}
</style>
</head>
<body>

<div class="container">

   


   
<a href="{{ route('teacherdashboard') }}">back to view</a>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Day</th>
                <th>status</th>
             
                <th>Action</th>
            </tr>
        </thead>

     <tbody>
@foreach($users as $index => $user)
    <tr>

        <form action="{{ route('attendance.store') }}" method="POST">
            @csrf

            <td>{{ $index + 1 }}</td>
            <td>{{ $user->name }}</td>

            <td>
                <select name="subject" required>
                    <option value="">Select</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                </select>
            </td>

            <td>
                <select name="status" required>
                    <option value="present">Present</option>
                    <option value="absent">Absent</option>
                    <option value="late">Late</option>
                </select>
            </td>
            

        

            <td>
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="class_id" value="{{ $classname->id }}">
                <input type="hidden" name="date" value="{{ date('Y-m-d') }}">

                <button type="submit">Save</button>
    
                <a href="{{ route('attendance.update', $user->id) }}" class="btn">Update</a>
            
            </td>

        </form>
        

    </tr>
@endforeach
</tbody>
    </table>

    

</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Student Dashboard</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

body {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(-45deg, #0f172a, #111827, #1e293b, #0b1220);
    background-size: 400% 400%;
    animation: bgMove 12s ease infinite;
    color: #e2e8f0;
    padding: 20px;
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
    width: 280px;
    height: 280px;
    border-radius: 50%;
    filter: blur(90px);
    opacity: 0.4;
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
    50% {transform: translateY(-30px) scale(1.1);}
    100% {transform: translateY(0);}
}

/* main container */
.container {
    width: 100%;
    max-width: 600px;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    backdrop-filter: blur(15px);
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.4);
    animation: fadeIn 0.8s ease;
}

@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 26px;
    background: linear-gradient(90deg,#fff,#94a3b8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* profile info box */
.profile-info {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    padding: 18px;
    border-radius: 12px;
    margin-bottom: 20px;
    line-height: 1.6;
}

.profile-info p {
    margin: 6px 0;
    color: #cbd5e1;
}

.profile-info strong {
    color: #fff;
}

/* form styling */
form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

input,
select,
textarea {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid rgba(255,255,255,0.1);
    background: rgba(255,255,255,0.05);
    color: #fff;
    outline: none;
    transition: 0.3s;
}

input:focus,
select:focus,
textarea:focus {
    border-color: #6366f1;
    box-shadow: 0 0 10px rgba(99,102,241,0.4);
}

/* file input */
input[type="file"] {
    padding: 10px;
    background: transparent;
}

/* buttons */
.btn {
    padding: 12px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 15px;
    font-weight: bold;
    transition: 0.3s;
}

.btn-update {
    background: linear-gradient(90deg,#22c55e,#16a34a);
    color: white;
}

.btn-update:hover {
    transform: scale(1.03);
    box-shadow: 0 10px 25px rgba(34,197,94,0.3);
}

/* back link */
a {
    display: inline-block;
    margin-top: 15px;
    text-align: center;
    color: #94a3b8;
    text-decoration: none;
    transition: 0.3s;
}

a:hover {
    color: #fff;
}

/* responsive */
@media(max-width:600px){
    .container {
        padding: 20px;
    }
}
</style>
</head>
<body>

<div class="container">

    <h2>teacher Dashboard</h2>

    <!-- Student Information -->
    <div class="profile-info">
        <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Phone:</strong> {{ $profile->phone ?? 'N/A' }}</p>
        
        <p><strong>Age:</strong> {{ $profile->age ?? 'N/A   ' }}</p>
        <p><strong>Gender:</strong> {{ $profile ->gender ?? 'N/A' }}</p>
        <p><strong>Address:</strong> {{ $profile->address ?? 'N/A' }}</p>
        <p><strong>City:</strong> {{ $profile->city ?? 'N/A ' }}</p>
        <p><strong>Country:</strong> {{ $profile->country ?? 'N/A' }}</p>
        <p><strong>Bio:</strong> {{ $profile->bio ?? 'N/A' }}</p>

         
    </div>

    <!-- Edit Profile Form -->
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf

    <input type="text" name="phone" placeholder="Phone Number" value="{{ $profile->phone ?? '' }}">

    <input type="number" name="age" placeholder="Age" value="{{ $profile->age ?? '' }}">

    <select name="gender">
        <option value="Male" {{ ($profile->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
        <option value="Female" {{ ($profile->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
        <option value="Other" {{ ($profile->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
    </select>

    <input type="text" name="address" placeholder="Address" value="{{ $profile->address ?? '' }}">

    <input type="text" name="city" placeholder="City" value="{{ $profile->city ?? '' }}">

    <input type="text" name="country" placeholder="Country" value="{{ $profile->country ?? '' }}">

    <textarea name="bio" placeholder="Bio">{{ $profile->bio ?? '' }}</textarea>

    <input type="file" name="profile_image">

    <button type="submit" class="btn btn-update">
        Update Profile
    </button>
</form>

   <a href="{{ route('teacherdashboard') }}">back to dashboard</a>

</div>

</body>
</html>
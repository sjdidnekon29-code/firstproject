<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Messages</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, Helvetica, sans-serif;
}

body{
    height:100vh;
    background:linear-gradient(-45deg,#0f172a,#111827,#1e293b,#0b1220);
    background-size:400% 400%;
    animation:bgMove 10s ease infinite;
    color:white;
    overflow:hidden;
}

@keyframes bgMove{
    0%{background-position:0% 50%}
    50%{background-position:100% 50%}
    100%{background-position:0% 50%}
}

/* HEADER */
.chat-header{
    background:linear-gradient(90deg,#6366f1,#8b5cf6);
    padding:18px 25px;
    display:flex;
    align-items:center;
    gap:15px;
}

.logo{
    width:55px;
    height:55px;
    background:white;
    border-radius:50%;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:28px;
}

/* CHAT WRAPPER */
.chat-container{
    height:100vh;
    display:flex;
    flex-direction:column;
}

/* MESSAGES */
.messages{
    flex:1;
    overflow-y:auto;
    padding:20px;
    padding-bottom:120px;
}

/* MESSAGE */
.message{
    display:flex;
    justify-content:space-between;
    gap:20px;
    margin-bottom:15px;
    background:rgba(255,255,255,.08);
    border-radius:15px;
    padding:15px;
    backdrop-filter:blur(10px);
}

.message-text{ flex:1; }

.message-text p{
    font-size:16px;
    line-height:1.6;
    color:#e2e8f0;
}

.message-side{
    width:180px;
    display:flex;
    flex-direction:column;
    align-items:flex-end;
    gap:10px;
    text-align:right;
}

.sender{
    font-weight:bold;
    color:#cbd5e1;
}

.btn{
    border:none;
    color:white;
    padding:8px 12px;
    border-radius:8px;
    cursor:pointer;
    font-size:13px;
}

.copy-btn{ background:#6366f1; }
.copy-btn:hover{ background:#4f46e5; }

.delete-btn{ background:#dc2626; }
.delete-btn:hover{ background:#b91c1c; }

/* INPUT */
.chat-form{
    position:fixed;
    bottom:0;
    left:0;
    right:0;
    background:rgba(15,23,42,.95);
    backdrop-filter:blur(12px);
    padding:15px;
    border-top:1px solid rgba(255,255,255,.1);
}

.chat-form form{
    max-width:1000px;
    margin:auto;
    display:flex;
    gap:10px;
}

.chat-form textarea{
    flex:1;
    min-height:55px;
    resize:none;
    padding:12px;
    border-radius:12px;
    border:none;
    outline:none;
    background:rgba(255,255,255,.08);
    color:white;
}

.send-btn{
    padding:0 20px;
    border:none;
    border-radius:12px;
    background:linear-gradient(90deg,#6366f1,#8b5cf6);
    color:white;
    font-weight:bold;
    cursor:pointer;
}

@media(max-width:768px){
    .message{ flex-direction:column; }
    .message-side{
        width:100%;
        flex-direction:row;
        justify-content:space-between;
    }
    .chat-form form{
        flex-direction:column;
    }
    .send-btn{
        width:100%;
        height:45px;
    }
}
</style>
</head>

<body>

<div class="chat-container">

    <!-- HEADER -->
    <div class="chat-header">
        <div class="logo">🎓</div>
        <div>
            <h2>Class Messages</h2>
            <small>Class ID: {{ $class_id }}</small>
        </div>
        <div style="margin-left:auto;">
            <a href="{{ route('studentdashboard') }}" class="btn" style="background:#334155;">
                dashboard
            </a>
        </div>
    </div>

    <!-- MESSAGES -->
    <div class="messages" id="messages-container">
        @forelse($messages as $message)
        <div class="message">

            <div class="message-text">
                <p id="msg{{ $message->id }}">
                    {{ $message->message }}
                </p>
            </div>

            <div class="message-side">

                <div class="sender">
                    👤 {{ $message->name }}
                </div>

                <button class="btn copy-btn"
                        type="button"
                        onclick="copyMessage('msg{{ $message->id }}')">
                    📋 Copy
                </button>

                <form action="{{ route('messages.delete', $message->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn delete-btn"
                            onclick="return confirm('Delete message?')">
                        🗑 Delete
                    </button>
                </form>

            </div>

        </div>
        @empty
        <div class="message">
            <div class="message-text">No messages found.</div>
        </div>
        @endforelse
    </div>
</div>

<!-- INPUT -->
<div class="chat-form">
    <form action="{{ route('messages.store') }}" method="POST">
        @csrf

        <input type="hidden" name="name" value="{{ auth()->user()->name }}">
        <input type="hidden" name="class_id" value="{{ $class_id ?? '' }}">

        <textarea name="message" placeholder="Type your message..." required></textarea>

        <button type="submit" class="send-btn">Send</button>
    </form>
</div>

<script>
function copyMessage(id){
    let text = document.getElementById(id).innerText;
    navigator.clipboard.writeText(text);
}

// detect typing
let isTyping = false;
const textarea = document.querySelector("textarea[name='message']");

textarea.addEventListener("focus", () => isTyping = true);
textarea.addEventListener("blur", () => isTyping = false);
textarea.addEventListener("input", () => isTyping = true);

// auto refresh messages only (no full reload)
setInterval(() => {
    if (isTyping) return;

    fetch(window.location.href)
        .then(res => res.text())
        .then(html => {
            const doc = new DOMParser().parseFromString(html, "text/html");

            document.getElementById("messages-container").innerHTML =
                doc.getElementById("messages-container").innerHTML;
        });

}, 3000);
</script>

</body>
</html>
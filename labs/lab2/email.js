<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seth Okai - Professional Profile</title>
    <style>
        /* Add your CSS styling here */
    </style>
</head>
<body>
    <header>
        <h1>Seth Okai</h1>
        <img src="Images/headshot.jpg" alt="Seth Okai's Headshot">
        <p>Security Analyst</p>
    </header>
    <section id="contact">
        <h2>Contact Information</h2>
        <p>453 Smiley Avenue Springdale OH</p>
        <p>Phone: 513-592-9077</p>
        <p>Email: <span id="email" onclick="showhideEmail()">Show my email</span></p>
    </section>
    <section id="background">
        <h2>Background</h2>
        <h3>Education</h3>
        <p>Information Technology / Associate of Applied Business</p>
        <p>University of Cincinnati, (Blue Ash Campus) OH</p>
        <p>Pertinent Coursework: System Administration, Computer programming, Database Management, Web development</p>
        <p>2020 - 2022</p>
        <p>Cybersecurity, Data Technologies/ Bachelor of science</p>
        <p>University of Cincinnati, (Main campus) OH</p>
        <p>Pertinent Coursework: Cybercrime, Network Security, Network Infrastructure, contemporary database systems, System analysis and design.</p>
        <p>2022 - 2025</p>
    </section>
    <section id="experience">
        <h3>Work Experience</h3>
        <p>Cybersecurity College Intern</p>
        <p>Ohio Department of Administrative services.</p>
        <ul>
            <li>Conducts threat and vulnerability assessments, identifies deviations, and measures defense-in-depth effectiveness.</li>
            <li>Assists in identifying systemic security issues, preparing vulnerability reports, and supporting incident response.</li>
            <li>Supports security system monitoring, tuning, and documentation of incident response processes.</li>
            <li>May 2023 - Current</li>
        </ul>
        <p>Summer Tech Assistant/ Intern</p>
        <p>Wintonwoods Highschool Cincinnati</p>
        <ul>
            <li>Analyzed and determined an effective local technology Infrastructure.</li>
            <li>Repaired Hardware and software issues pertaining to Chromebooks.</li>
            <li>Received and attended to helpdesk tickets requested by students and staff.</li>
            <li>May, 2022 - August, 2022</li>
        </ul>
    </section>
    <section id="skills">
        <h2>Skills</h2>
        <h3>Professional Skills</h3>
        <ul>
            <li>Positivity</li>
            <li>Problem solving</li>
        </ul>
        <h3>Technical Skills</h3>
        <ul>
            <li>Teamwork</li>
            <li>Attention to detail</li>
            <li>Risk analysis</li>
            <li>Incident response</li>
            <li>Data analytics</li>
            <li>Intrusion detection</li>
        </ul>
    </section>
    <section id="projects">
        <h2>Relevant Projects</h2>
        <p>Project: Censible Chrome Extension - Best Social Impact Hack, RevolutionUC Hackathon 2023</p>
        <p>Developed a chrome extension called Censible that filters out inappropriate images and text in a browser to create a safer browsing experience for parents and children, and people with different types of fears, such as arachnophobia. Censible uses a combination of artificial intelligence and user-defined filters to detect and block unwanted content.</p>
    </section>
    <section id="certifications">
        <h2>Certifications</h2>
        <ul>
            <li>CC—Certified in Cybersecurity—(ISC)2 (2023)</li>
            <li>VMDR- Vulnerability Management Detection & Response - Qualys (2023)</li>
            <li>CASM- Cybersecurity Asset Management - Qualys (2023)</li>
        </ul>
    </section>
    <footer>
        <p>&copy; 2024 Seth Okai</p>
        <!-- Link to WAPH.html -->
        <p><a href="waph.html">Go to WAPH Site</a></p>
        <!-- Digital clock -->
        <p id="digital-clock"></p>
        <!-- Analog clock -->
        <canvas id="analog-clock" width="150" height="150" style="background-color:#999"></canvas>
        <!-- Joke API -->
        <p id="joke"></p>
    </footer>

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Digital clock using jQuery
        $(document).ready(function() {
            function updateClock() {
                var now = new Date();
                var time = now.toLocaleTimeString();
                $('#digital-clock').text(time);
            }
            setInterval(updateClock, 1000);
        });

        // Function to show/hide email
        var shown = false;
        function showhideEmail() {
            var emailSpan = document.getElementById('email');
            if (shown) {
                emailSpan.textContent = "Show my email";
                shown = false;
            } else {
                emailSpan.textContent = "okaiso@mail.uc.edu";
                shown = true;
            }
        }

        // Analog clock
        var canvas = document.getElementById("analog-clock");
        var ctx = canvas.getContext("2d");
        var radius = canvas.height / 2;
        ctx.translate(radius, radius);
        radius = radius * 0.90;
        setInterval(drawClock, 1000);
        function drawClock() {
            drawFace(ctx, radius);
            drawNumbers(ctx, radius);
            drawTime(ctx, radius);
        }
        function drawFace(ctx, radius) {
            ctx.beginPath();
            ctx.arc(0, 0, radius, 0, 2 * Math.PI);
            ctx.fillStyle = 'white';
            ctx.fill();
            var grad = ctx.createRadialGradient(0, 0, radius * 0.95, 0, 0, radius * 1.05);
            grad.addColorStop(0, '#333');
            grad.addColorStop(0.5, 'white');
            grad.addColorStop(1, '#333');
            ctx.strokeStyle = grad;
            ctx.lineWidth = radius * 0.1;
            ctx.stroke();
            ctx.beginPath();
            ctx.arc(0, 0, radius * 0.1, 0, 2 * Math.PI);
            ctx.fillStyle = '#333';
            ctx.fill();
        }
        function drawNumbers(ctx, radius) {
            var ang;
            var num;
            ctx.font = radius * 0.15 + "px arial";
            ctx.textBaseline = "middle";
            ctx.textAlign = "center";
            for (num = 1; num < 13; num++) {
                ang = num * Math.PI / 6;
                ctx.rotate(ang);
                ctx.translate(0, -radius * 0.85);
                ctx.rotate(-ang);
                ctx.fillText(num.toString(), 0, 0);
                ctx.rotate(ang);
                ctx.translate(0, radius * 0.85);
                ctx.rotate(-ang);
            }
        }
        function drawTime(ctx, radius) {
            var now = new Date();
            var hour = now.getHours();
            var minute = now.getMinutes();
            var second = now.getSeconds();
            //hour
            hour = hour % 12;
            hour = (hour * Math.PI / 6) +
                (minute * Math.PI / (6 * 60)) +
                (second * Math.PI / (360 * 60));
            drawHand(ctx, hour, radius * 0.5, radius * 0.07);
            //minute
            minute = (minute * Math.PI / 30) + (second * Math.PI / (30 * 60));
            drawHand(ctx, minute, radius * 0.8, radius * 0.07);
            // second
            second = (second * Math.PI / 30);
            drawHand(ctx, second, radius * 0.9, radius * 0.02);
        }
        function drawHand(ctx, pos, length, width) {
            ctx.beginPath();
            ctx.lineWidth = width;
            ctx.lineCap = "round";
            ctx.moveTo(0, 0);
            ctx.rotate(pos);
            ctx.lineTo(0, -length);
            ctx.stroke();
            ctx.rotate(-pos);
        }

        // Fetch joke from jokeapi every minute
        setInterval(function() {
            fetch('https://v2.jokeapi.dev/joke/Programming?type=single')
            .then(response => response.json())
            .then(data => {
                document.getElementById('joke').textContent = "Joke: " + data.joke;
            })
            .catch(error => console.error('Error fetching joke:', error));
        }, 60000); // Fetch a new joke every minute (60 seconds)
    </script>
</body>
</html>

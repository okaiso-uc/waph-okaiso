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
        <!-- Input field for email (hidden) -->
        <input type="hidden" id="emailInput" value="okaiso@mail.uc.edu">
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
        <h2>Work Experience</h2>
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
        <p id="clock"></p>
    </footer>

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include your email.js file -->
    <script src="email.js"></script>
    <!-- JavaScript for clock -->
    <script>
        // Digital clock using jQuery
        $(document).ready(function() {
            function updateClock() {
                var now = new Date();
                var time = now.toLocaleTimeString();
                $('#clock').text(time);
            }
            setInterval(updateClock, 1000);
        });
    </script>

    <!-- Function to show/hide email -->
    <script>
        // This script is already included in your email.js file.
        // If needed, you can modify the showhideEmail() function in email.js.
    </script>

    <!-- Fetch joke from jokeapi every minute -->
    <script>
        setInterval(function() {
            fetch('https://v2.jokeapi.dev/joke/Any?type=single')
            .then(response => response.json())
            .then(data => {
                console.log(data.joke);
                // Display the joke somewhere in your page
            })
            .catch(error => console.error('Error fetching joke:', error));
        }, 60000); // Fetch a new joke every minute (60 seconds)
    </script>

    <!-- Fetch weather information from weatherbit.io -->
    <script>
        fetch('https://api.weatherbit.io/v2.0/current?city=London&key=YOUR_API_KEY')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            // Process and display weather information as needed
        })
        .catch(error => console.error('Error fetching weather:', error));
    </script>

    <!-- JavaScript to remember client's last visit -->
    <script>
        // Check if localStorage is supported
        if (typeof(Storage) !== "undefined") {
            var lastVisit = localStorage.getItem("lastVisit");
            if (lastVisit === null) {
                // First-time visit
                alert("Welcome to my homepage!");
            } else {
                // Returning visitor
                alert("Welcome back! Your last visit was " + lastVisit);
            }
            // Update last visit time
            var now = new Date();
            var formattedDate = now.toLocaleString();
            localStorage.setItem("lastVisit", formattedDate);
        } else {
            // Browser doesn't support localStorage
            console.error("Sorry, your browser does not support web storage...");
        }
    </script>
</body>
</html>

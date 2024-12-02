<?php
include('../navbarFunctions.php');
include('../head.php')

?>

<nav class="navbar navbar-expand-lg" style="background-color: rgb(133, 161, 170); height: 70px;">
        <div class="container-fluid">
            <!-- Collapsible button on the left
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button> -->

            <!-- Navbar content collapses into a dropdown menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="medical_records_dash.php">Medical Records</a></li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="nurse_dash.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
    </nav>

<body>
    <!-- Welcome Message -->
    <div class="container mt-4">
        <h2 class="text-center">Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Nurse'); ?>!</h2>

        <!-- Patient List -->
        <h2>Patient List</h2>
        <ul>
            <li onclick="toggleInfo('info1')">
                Brown, Michael, ID: 089786756
                <div id="info1" class="patient-info">
                    <p class="roboto-black-italic">Michael Brown</p>
                    <p>Date of Birth: 09/18/1988</p>
                    <p>Height: 6'2"</p>
                    <p>Weight: 200lbs</p>
                    <a href="<?php echo url();?>medical_records/michael_brown.pdf" target="_blank">
                        <button class="rounded-square-button">View Medical Record</button>
                    </a>
                </div>
            </li>
            <li onclick="toggleInfo('info2')">
                Davis, Emily, ID: 987654321
                <div id="info2" class="patient-info">
                    <p class="roboto-black-italic">Emily Davis</p>
                    <p>Date of Birth: 03/10/2000</p>
                    <p>Height: 5'4"</p>
                    <p>Weight: 120lbs</p>
                    <a href="<?php echo url();?>medical_records/emily_davis.pdf" target="_blank">
                        <button class="rounded-square-button">View Medical Record</button>
                    </a>
                </div>
            </li>
            <li onclick="toggleInfo('info3')">
                Doe, John, ID: 123456789
                <div id="info3" class="patient-info">
                    <p class="roboto-black-italic">John Doe</p>
                    <p>Date of Birth: 01/15/1985</p>
                    <p>Height: 5'9"</p>
                    <p>Weight: 150lbs</p>
                    <a href="<?php echo url();?>medical_records/john_doe.pdf" target="_blank">
                        <button class="rounded-square-button">View Medical Record</button>
                    </a>
                </div>
            </li>
            <li onclick="toggleInfo('info4')">
                Green, Samuel, ID: 567474632
                <div id="info4" class="patient-info">
                    <p class="roboto-black-italic">Samuel Green</p>
                    <p>Date of Birth: 10/30/1976</p>
                    <p>Height: 5'11"</p>
                    <p>Weight: 180lbs</p>
                    <a href="<?php echo url();?>medical_records/samuel_green.pdf" target="_blank">
                        <button class="rounded-square-button">View Medical Record</button>
                    </a>
                </div>
            </li>
            <li onclick="toggleInfo('info5')">
                Johnson, Mary, ID: 314253647
                <div id="info5" class="patient-info">
                    <p class="roboto-black-italic">Mary Johnson</p>
                    <p>Date of Birth: 07/22/1992</p>
                    <p>Height: 5'5"</p>
                    <p>Weight: 135lbs</p>
                    <a href="<?php echo url();?>medical_records/mary_johnson.pdf" target="_blank">
                        <button class="rounded-square-button">View Medical Record</button>
                    </a>
                </div>
            </li>
        </ul>
    </div>

    <script>
        function toggleInfo(infoId) {
            const infoDiv = document.getElementById(infoId);
            if (infoDiv) {
                infoDiv.style.display = infoDiv.style.display === 'none' ? 'block' : 'none';
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    

    </body>
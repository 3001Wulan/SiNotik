<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/about.css'); ?>">
</head>
<body>
        <div class="about-container">
                <h1>
                        <span>A</span>
                        <span>B</span>
                        <span>O</span>
                        <span>U</span>
                        <span>T</span>
                        <span></span>
                        <span>U</span>
                        <span>S</span>
                </h1>

                        <div class="profile-cards">
                                <?php
                                        $team = [
                                                ["name" => "Cindy Arwinda Putri", "role" => "Programmer", "description" => "Developing efficient and reliable code to ensure smooth application performance.", "photo" => "assets/images/CINDY_.jpg", "instagram" => "cdyawd"],
                                                ["name" => "Wulandari Yulianis", "role" => "Project Manager", "description" => "Leading the team with exceptional project management skills.", "photo" => "assets/images/WULAN_.jpg", "instagram" => "wulan_0407"],
                                                ["name" => "Intan Salma Denaidy", "role" => "System Analyst", "description" => "Analyzing systems in depth to find optimal solutions for every project.", "photo" => "assets/images/INTAN_.jpg", "instagram" => "intansalma__"],
                                                ["name" => "Heni Yunida", "role" => "UI/UX Designer", "description" => "Creating visually appealing and user-friendly designs.", "photo" => "assets/images/HENI_.jpg", "instagram" => "heniyunidaa"],
                                                ["name" => "Sistri Mahira", "role" => "DB Administrator", "description" => "Managing and optimizing databases to ensure maximum performance and data security.", "photo" => "assets/images/MAHIRA_.jpg", "instagram" => "sistrmahira"],
                                        ];

                                        foreach ($team as $member) {
                                                echo "<div class='profile-card'>";
                                                                echo "<div class='card-image'><img src='" . base_url($member['photo']) . "' alt='" . esc($member['name']) . "'></div>";
                                                                        echo "<div class='card-content'>";
                                                                                echo "<h2>" . esc($member['name']) . "</h2>";
                                                                                echo "<h3>" . esc($member['role']) . "</h3>";
                                                                                echo "<p>" . esc($member['description']) . "</p>";
                                                                                echo "<div class='social-media'>";
                                                                                        echo "<a href='https://instagram.com/" . esc($member['instagram']) . "' target='_blank' class='instagram-link'>";
                                                                                                echo "<img src='https://upload.wikimedia.org/wikipedia/commons/9/95/Instagram_logo_2022.svg' alt='Instagram' class='instagram-icon'>";
                                                                                                echo "@" . esc($member['instagram']);
                                                                                        echo "</a>";
                                                                                echo "</div>";
                                                                        echo "</div>";
                                                echo "</div>";
                                        }
                                ?>
                        </div>
    </div>
</body>
</html>

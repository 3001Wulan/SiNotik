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
                                                ["name" => "Cindy Arwinda Putri", "role" => "Programmer", "description" => "Misterius kayak hitam, hangat kayak coklat, dan seindah bunga daisy 🖤🤎🌼.", "photo" => "assets/images/CINDY_.jpg", "instagram" => "cdyawd"],
                                                ["name" => "Wulandari Yulianis", "role" => "Project Manager", "description" => "No drama, just Wulan bringing all the chill, green vibes 💚🍃.", "photo" => "assets/images/WULAN_.jpg", "instagram" => "wulan_0407"],
                                                ["name" => "Intan Salma Denaidy", "role" => "System Analyst", "description" => "With pink energy and tulip charm—Intan membawa warna dan keceriaan di setiap langkahnya 💖🌷.", "photo" => "assets/images/INTAN_.jpg", "instagram" => "intansalma__"],
                                                ["name" => "Heni Yunida", "role" => "UI/UX Designer", "description" => "Putih itu lebih dari sekadar warna—it's Heni’s true essence 🤍🌷.", "photo" => "assets/images/HENI_.jpg", "instagram" => "heniyunidaa"],
                                                ["name" => "Sistri Mahira", "role" => "DB Administrator", "description" => "Mahira si pecinta kupu-kupu. Fly high, stay cute, just like her vibes 🦋✨.", "photo" => "assets/images/MAHIRA_.jpg", "instagram" => "sistrmahira"],
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

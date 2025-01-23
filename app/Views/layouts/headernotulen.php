<!-- Header -->
<div class="header">
    <!-- Theme Toggle -->
    <div class="theme-toggle">
        <img src="<?= base_url('assets/images/moon.png') ?>" alt="Toggle Theme" id="theme-icon">
    </div>

    <!-- User Profile -->
    <div class="user-info">
        <div class="profile-picture">
            <img src="<?= base_url('assets/images/profiles/' . $profile_picture) ?>" alt="Profile Picture" id="profile-pic">
            <div class="dropdown-menu" id="profile-dropdown">
                <div class="dropdown-item">
                    <a href="<?= base_url('notulen/profilnotulen') ?>" class="dropdown-item">
                        <img src="<?= base_url('assets/images/user.png') ?>" alt="Profil Icon">
                        Profil
                    </a>
                </div>
                <div class="dropdown-separator"></div>
                <div class="dropdown-item" id="logout-btn">
                    <img src="<?= base_url('assets/images/icount_logout.png') ?>" alt="Logout Icon">
                    Logout
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const themeIcon = document.getElementById('theme-icon');
        const body = document.body;

        // Load the theme based on local storage
        if (localStorage.getItem('theme') === 'dark') {
            body.classList.add('dark-mode');
            themeIcon.src = '<?= base_url("assets/images/sun.png") ?>';
        } else {
            themeIcon.src = '<?= base_url("assets/images/moon.png") ?>';
        }

        themeIcon.addEventListener('click', function () {
            body.classList.toggle('dark-mode');
            if (body.classList.contains('dark-mode')) {
                themeIcon.src = '<?= base_url("assets/images/sun.png") ?>';
                localStorage.setItem('theme', 'dark');
            } else {
                themeIcon.src = '<?= base_url("assets/images/moon.png") ?>';
                localStorage.setItem('theme', 'light');
            }
        });

        const profilePic = document.getElementById('profile-pic');
        const dropdownMenu = document.getElementById('profile-dropdown');

        profilePic.addEventListener('click', function () {
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });

        window.addEventListener('click', function (e) {
            if (!profilePic.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.style.display = 'none';
            }
        });

        const logoutBtn = document.getElementById('logout-btn');
        const logoutModal = document.getElementById('logout-modal');
        const closeBtn = document.querySelector('.close-btn');
        const cancelBtn = document.querySelector('.cancel-logout');
        const confirmBtn = document.querySelector('.confirm-logout');

        logoutBtn.onclick = function () {
            logoutModal.style.display = 'flex';
        };

        closeBtn.onclick = function () {
            logoutModal.style.display = 'none';
        };

        cancelBtn.onclick = function () {
            logoutModal.style.display = 'none';
        };

        confirmBtn.onclick = function () {
            window.location.href = '<?= base_url("home") ?>'; // Sesuaikan dengan URL beranda Anda
        };
    });
</script>